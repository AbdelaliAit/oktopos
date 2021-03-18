<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}
$einheit=new einheit();
$data=$einheit->selectAll();
?>
<div class="container-fluid disable-text-selection">
  <div class="row">
    <div class="col-12">
      <div class="mb-2">
        <h1>Einheitenliste</h1>
        <div class="float-sm-right text-zero">
          <button type="button" class="btn btn-primary btn-lg  mr-1 url notlink" data-url="einheit/add.php" >hinzufügen</button>
        </div>
        
      </div>
      
      <div class="separator mb-5"></div>
    </div>
  </div>
  <div class="row">
    
    
    
    <div class="col-xl-12 col-lg-12 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <?php if(count($data) > 0) { ?>
          
          <table class="table  responsive table-striped table-bordered table-hover" id="datatables" >
            <thead>
              <tr>
                <th scope="col" >Id</th>
                <th>Code</th>
                <th>Name</th>
                <th scope="col">Aktionen</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($data as $ligne){
              ?>
              <tr>
                <td> <?php echo $ligne->id ; ?></td>

                <td> <?php echo $ligne->code ; ?> </td>
                <td> <?php echo $ligne->name ; ?> </td>
                <td>
                 
                  <a class="badge badge-danger mb-2 delete" data-id="<?php echo $ligne->id; ?>" style="color: white;cursor: pointer;" title="Supprimer" href='javascript:void(0)' >
                    <i class="simple-icon-trash" style="font-size: 15px;"></i>
                  </a>
                  <a class="badge badge-warning mb-2  url notlink" data-url="einheit/update.php?id=<?php echo $ligne->id; ?>" style="color: white;cursor: pointer;" title="Modifier"
                    href="javascript:void(0)">
                    <i class="iconsmind-Pen-5" style="font-size: 15px;"> </i>
                  </a>
                 
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
$("input.datepicker").datepicker({
format: 'yyyy-mm-dd',
templates: {
leftArrow: '<i class="simple-icon-arrow-left"></i>',
rightArrow: '<i class="simple-icon-arrow-right"></i>'
}
})
$('#datatables').dataTable({
order: [[ 0, "desc" ]],
dom: 'Bfrtip',
buttons: [
{
extend: 'excelHtml5',
title:"Liste der Einheiten",
exportOptions: {
columns: [ 0, 1, 2,3,4,5,6 ]
}
},
{
extend: 'pdfHtml5',
title:"Liste der Einheiten",
exportOptions: {
columns: [ 0, 1, 2,3,4,5,6 ]
}
},
{
extend: 'csvHtml5',
title:"Liste der Einheiten",
exportOptions: {
columns: [ 0, 1, 2,3,4,5,6 ]
}
}
],
pageLength: 10,
language: {
paginate: {
previous: "<i class='simple-icon-arrow-left'></i>",
next: "<i class='simple-icon-arrow-right'></i>"
}
},
drawCallback: function() {
$($(".dataTables_wrapper .pagination li:first-of-type")).find("a").addClass("prev"),
$($(".dataTables_wrapper .pagination li:last-of-type")).find("a").addClass("next"),
$(".dataTables_wrapper .pagination").addClass("pagination-sm")
}
});

$('body').on( "click",".delete", function( event ) {
event.preventDefault();
var btn = $(this);
swal({
title: 'Sind Sie sicher?',
text: "Möchten Sie diese Einheit wirklich löschen? !",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Ja, löschen !'
}).then((result) => {
if (result.value) {
$.ajax({
type: "POST",
url: "<?php echo BASE_URL.'views/einheit/' ;?>controle.php",
data: {act:"delete",id: btn.data('id')},
success: function (data) {

swal(
'Löschen',
'Die Einheit wurde gelöscht ',
'success'
).then((result) => {
btn.parents("td").parents("tr").remove();
});

}
});

}
});

});

});
</script>