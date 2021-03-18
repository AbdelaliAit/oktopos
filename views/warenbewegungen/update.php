<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}
$warenbewegungen=new warenbewegungen();
$id = explode('?id=',$_SERVER["REQUEST_URI"]);
$oldvalue=$warenbewegungen->selectById($id[1]);


$lager = new lager();
$lagen = $lager->selectAll();

$artikel = new artikel();
$artikeln = $artikel->selectAll();


?>
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Die Warenbewegungen </h1>
            </div>
            
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col align-self-start">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Die Warenbewegung bearbeiten</h5>
                    <form id="addform" method="post" name="form_warenbewegungen" enctype="multipart/form-data">
                        <input type="hidden" name="act" value="update">
                        <input type="hidden" name="id" value="<?php echo $id[1] ;?>">
                        <div class="form-row">
                  
                  <div class="form-group col-md-4 offset-md-4">
                        <label for="zeitpunkt">Zeitpunkt :</label>
                        <input type="text" class="form-control datepicker" id="zeitpunkt" name="zeitpunkt" value="<?php echo date('Y-m-d'); ?>" >
                     </div>
                   
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="code_tag">Art :</label>
                        <select class="form-control select2-single"     name="art" id="art"  >
                         
                           <option value="Wareneingang" <?php echo $oldvalue['art'] == "Wareneingang" ? "selected" :'' ?>  >Wareneingang</option>
                           <option value="Warenausgang" <?php echo $oldvalue['art'] == "Warenausgang" ? "selected" :'' ?>  >Warenausgang</option>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="id_warenbewegungen">Die Warenbewegung :</label>
                        <select class="form-control select2-single"     name="id_warenbewegungen" id="id_warenbewegungen"  >
                        <?php 

                                foreach ($lagen as $row) { 

                                    if ($row->id ==$oldvalue['id_lager']) {
                                        echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>'; } 
                                            else{echo '<option value="'.$row->id.'">'.$row->name.'</option>'; }
                                
                                }?>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="id_artikel">Artikel :</label>
                        <select class="form-control select2-single"     name="id_artikel" id="id_artikel"  >
                         
                        <?php 

                            foreach ($artikeln as $row) { 

                                if ($row->id ==$oldvalue['id_artikel']) {
                                    echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>'; } 
                                        else{echo '<option value="'.$row->id.'">'.$row->name.'</option>'; }
                            
                            }?>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="zeitpunkt">Menge :</label>
                        <input type="text" class="form-control " id="menge" name="menge" value="<?php echo $oldvalue['menge'] ?>" >
                     </div>
                     </div>
                        <div class=" offset-md-4 text-zero">
                            <button type="submit" class="btn btn-primary btn-lg  mr-1 " >speichern</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$( document ).ready(function() {

    $(".select2-single").select2({
            theme: "bootstrap",
            placeholder: "",
            maximumSelectionSize: 6,
            containerCssClass: ":all:"
        });

$("#addform" ).on( "submit", function( event ) {
event.preventDefault();
var form = $( this );
$.ajax({
type: "POST",
url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
data: new FormData(this),
dataType: 'text',  // what to expect back from the PHP script, if anything
cache: false,
contentType: false,
processData: false,
success: function (data) {
if (data.indexOf("success")>=0) {

swal(
'Änderung',
'warenbewegungen wurde geändert',
'success'
).then((result) => {
$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/warenbewegungen/index.php";?>`,
context: document.body,
success: function(data) {
history.replaceState({},"",`<?php echo BASE_URL."warenbewegungen/index.php";?>` );
$("#main").html( data );
}
});
});
}
else{
form.append(` <div id="alert-danger" class="alert  alert-danger alert-dismissible fade show rounded mb-0" role="alert">
    <strong>${data}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>`);
}
}
});
});

});
</script>