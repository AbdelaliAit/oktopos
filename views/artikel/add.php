<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}




$einheit = new einheit();
$einheits = $einheit->selectAll();


?>

<div class="container-fluid disable-text-selection">
  <div class="row">
    <div class="col-12">
      <div class="mb-2">
        <h1>Das Artikel </h1>
        
        <div class="float-sm-right text-zero">
          <button type="button" class="btn btn-success  url notlink" data-url="artikel/index.php" > <i class="glyph-icon simple-icon-arrow-left"></i></button>
        </div>
      </div>
      
      <div class="separator mb-5"></div>
    </div>
  </div>
  <div class="row">
    <div class="col align-self-start">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="mb-4">Ein Artikel hinzufügen</h5>
          <form id="addform" method="post" name="form_Artikel" enctype="multipart/form-data">
            <input type="hidden" name="act" value="insert">
            <div class="form-group col-md-4 offset-md-4 ">
            
                <label for="einheit_name"> Name des Artikels :</label>
                <input type="text" class="form-control" id="name" name="name" >
              
            </div>

            <div class="form-group col-md-4 offset-md-4">
            
                <label for="code"> Code des Artikels :</label>
                <input type="text" class="form-control" id="code" name="code" >
             
            </div>
            <div class="form-group col-md-4 offset-md-4">
                                        <label for="id_entrepot">Einheit :</label>
                                       <select class="form-control select2-single" name="id_einheit" id="id_einheit"  >
                                            
                                            <?php 

                                            foreach ($einheits as $row) { 
                                               echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                            }?>
                                            
                                        </select>

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
url: "<?php echo BASE_URL.'views/artikel/' ;?>controle.php",
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
history.replaceState({},"",`<?php echo BASE_URL."artikel/index.php"; ?>` );

$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/artikel/index.php"; ?>`,
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