<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}
?>
<style type="text/css">
iframe * {
cursor: inherit !important;
}
</style>
<div class="container-fluid disable-text-selection">
  <div class="row">
    <div class="col-12">
      <div class="mb-2">
        <h1>Das Lager </h1>
        
        <div class="float-sm-right text-zero">
          <button type="button" class="btn btn-success  url notlink" data-url="lager/index.php" > <i class="glyph-icon simple-icon-arrow-left"></i></button>
        </div>
      </div>
      
      <div class="separator mb-5"></div>
    </div>
  </div>
  <div class="row">
    <div class="col align-self-start">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="mb-4">Ein Lager hinzufügen</h5>
          <form id="addform" method="post" name="form_lager" enctype="multipart/form-data">
            <input type="hidden" name="act" value="insert">
            <div class="form-row">
              <div class="form-group col-md-4 offset-md-4 lager">
                <label for="einheit_name"> Name des Lagers :</label>
                <input type="text" class="form-control" id="name" name="name" >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4 offset-md-4 einheit">
                <label for="code"> Code des Lagers :</label>
                <input type="text" class="form-control" id="code" name="code" >
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

$("#addform" ).on( "submit", function( event ) {
event.preventDefault();
var form = $( this );
$.ajax({
type: "POST",
url: "<?php echo BASE_URL.'views/lager/' ;?>controle.php",
data: new FormData(this),
dataType: 'text',
cache: false,
contentType: false,
processData: false,
success: function (data) {
if (data=="success") {
swal(
'Hinzufügen',
'Neues Lager hat hinzugefügt',
'success'
).then((result) => {
history.replaceState({},"",`<?php echo BASE_URL."lager/index.php"; ?>` );

$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/lager/index.php"; ?>`,
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