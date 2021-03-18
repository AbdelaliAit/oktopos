<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}
$lager=new lager();
$id = explode('?id=',$_SERVER["REQUEST_URI"]);
$oldvalue=$lager->selectById($id[1]);
?>
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Lager </h1>
            </div>
            
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col align-self-start">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Lager bearbeiten</h5>
                    <form id="addform" method="post" name="form_lager" enctype="multipart/form-data">
                        <input type="hidden" name="act" value="update">
                        <input type="hidden" name="id" value="<?php echo $id[1] ;?>">
                         <div class="form-row">
              
            
            
              <div class="form-group col-md-4 offset-md-4 lager">
                <label for="name"> Lager Name :</label>
                <input type="text" class="form-control" value="<?php echo $oldvalue['name'] ;?>" id="name" name="name" >
              </div>

              <div class="form-group col-md-4 offset-md-4 lager">
                <label for="code"> Lager Code :</label>
                <input type="text" class="form-control" value="<?php echo $oldvalue['code'] ;?>" id="code" name="code" >
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
dataType: 'text',  // what to expect back from the PHP script, if anything
cache: false,
contentType: false,
processData: false,
success: function (data) {
if (data.indexOf("success")>=0) {

swal(
'Änderung',
'Lager wurde geändert',
'success'
).then((result) => {
$.ajax({
method:'POST',
data: {ajax:true},
url: `<?php echo BASE_URL."views/lager/index.php";?>`,
context: document.body,
success: function(data) {
history.replaceState({},"",`<?php echo BASE_URL."lager/index.php";?>` );
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