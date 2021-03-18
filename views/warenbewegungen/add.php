  <?php
if (isset($_POST['ajax'])) {
include('../../eve.php');
}



$lager = new lager();
$lagen = $lager->selectAll();

$artikel = new artikel();
$artikeln = $artikel->selectAll();


?>
<div class="container-fluid disable-text-selection">
   <div class="row">
      <div class="col-12">
         <div class="mb-2">
            <h1>Warenbewegungens </h1>
            <div class="float-sm-right text-zero">
               <button type="button" class="btn btn-success  url notlink" data-url="warenbewegungen/index.php" > <i class="glyph-icon simple-icon-arrow-left"></i></button>
            </div>
         </div>
         <div class="separator mb-5"></div>
      </div>
   </div>
   <div class="row">
      <div class="col align-self-start">
         <div class="card mb-3">
            <div class="card-body">
               <h5 class="mb-3">Neue Warenbewegungen erstellen</h5>
               <form id="addform" method="post" name="form_warenbewegungen" enctype="multipart/form-data">
                  <input type="hidden" name="act" value="insert">
                  <div class="form-row">
                  
                  <div class="form-group col-md-4 offset-md-4">
                        <label for="zeitpunkt">Zeitpunkt :</label>
                        <input type="text" class="form-control datepicker" id="zeitpunkt" name="zeitpunkt" value="<?php echo date('Y-m-d'); ?>" >
                     </div>
                   
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="code_tag">Art :</label>
                        <select class="form-control select2-single"     name="art" id="art"  >
                         
                           <option value="Wareneingang">Wareneingang</option>
                           <option value="Warenausgang">Warenausgang</option>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="id_lager">Lager :</label>
                        <select class="form-control select2-single"     name="id_lager" id="id_lager"  >
                         
                           <?php 
                              foreach ($lagen as $row) { 
                                 echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                              }?>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="id_artikel">Artikel :</label>
                        <select class="form-control select2-single"     name="id_artikel" id="id_artikel"  >
                         
                           <?php 
                              foreach ($artikeln as $row) { 
                                 echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                              }?>
                        </select>
                     </div>
                     <div class="form-group col-md-4 offset-md-4">
                        <label for="zeitpunkt">Menge :</label>
                        <input type="text" class="form-control " id="menge" name="menge" value="0" >
                     </div>
                    </div>  
                  <div class="offset-md-4 text-zero">
                     <button type="submit" class="btn btn-primary btn-lg  mr-1 ">Speichern</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">


    $( document ).ready(function() {


      $('#code_tag').each(function(index, value){
        if (value.className != 'en') {
        $(this).attr('Lang','fa');
        }
});


        $(".select2-single").select2({
            theme: "bootstrap",
            placeholder: "",
            maximumSelectionSize: 6,
            containerCssClass: ":all:"
        });


          $("input.datepicker").datepicker({
        orientation: "bottom left",
        format: 'yyyy-mm-dd',
         templates: {
            leftArrow: '<i class="simple-icon-arrow-left"></i>',
            rightArrow: '<i class="simple-icon-arrow-right"></i>'
        }
    });



    $("#addform" ).on( "submit", function( event ) {
event.preventDefault();
var form = $( this );
$.ajax({
type: "POST",
url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
data: new FormData(this),
dataType: 'text',
cache: false,
contentType: false,
processData: false,
success: function (data) {
if (data=="success") {
swal(
'Hinzufügen',
'Neues Artikel hat hinzugefügt',
'success'
).then((result) => {
history.replaceState({},"",`<?php echo BASE_URL."warenbewegungen/index.php"; ?>` );

$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/warenbewegungen/index.php"; ?>`,
context: document.body,
success: function(data) {
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
