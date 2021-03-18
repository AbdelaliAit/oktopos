<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}
$artikel=new artikel();
$id = explode('?id=',$_SERVER["REQUEST_URI"]);
$oldvalue=$artikel->selectById($id[1]);




$einheit = new einheit();
$einheits = $einheit->selectAll();

?>
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>artikel </h1>
            </div>
            
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col align-self-start">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">artikel bearbeiten</h5>
                    <form id="addform" method="post" name="form_artikel" enctype="multipart/form-data">
                        <input type="hidden" name="act" value="update">
                        <input type="hidden" name="id" value="<?php echo $id[1] ;?>">
                         <div class="form-row">
              
            
            
              <div class="form-group col-md-4 offset-md-4 artikel">
                <label for="name"> artikel Name :</label>
                <input type="text" class="form-control" value="<?php echo $oldvalue['name'] ;?>" id="name" name="name" >
              </div>

              <div class="form-group col-md-4 offset-md-4 artikel">
                <label for="code"> artikel Code :</label>
                <input type="text" class="form-control" value="<?php echo $oldvalue['code'] ;?>" id="code" name="code" >
              </div>

              <div class="form-group col-md-4 offset-md-4">
                                        <label for="id_service">Einheit :</label>
                                       <select class="form-control select2-single" name="id_einheit" id="id_einheit"  >
                                            
                                            <?php 

                                            foreach ($einheits as $row) { 

                                                if ($row->id ==$oldvalue['id_einheit']) {
                                                      echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>'; } 
                                                        else{echo '<option value="'.$row->id.'">'.$row->name.'</option>'; }
                                              
                                            }?>
                                            
                                        </select>

                                    </div>
            </div>
                        <div class="offset-md-4 text-zero">
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
url: "<?php echo BASE_URL.'views/artikel/' ;?>controle.php",
data: new FormData(this),
dataType: 'text',  // what to expect back from the PHP script, if anything
cache: false,
contentType: false,
processData: false,
success: function (data) {
if (data.indexOf("success")>=0) {

swal(
'Änderung',
'artikel wurde geändert',
'success'
).then((result) => {
$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/artikel/index.php";?>`,
context: document.body,
success: function(data) {
history.replaceState({},"",`<?php echo BASE_URL."artikel/index.php";?>` );
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