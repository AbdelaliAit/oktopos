<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}

$_SESSION['LIMIT'] = 10 ;
 $limit = $_SESSION['LIMIT'];
/*if($_GET['datatables_length']!='')
{
  $_SESSION['LIMIT'] = $_GET['datatables_length'];
}*/
$page = 'warenbewegungen';

$warenbewegungen = new warenbewegungen();

 $query = $warenbewegungen->selectQuery("SELECT 
 wbn.*,lager.name as lager,artikel.name as artikel,einheit.name as einheit
 FROM warenbewegungen wbn 
 join artikel  on artikel.id = wbn.id_artikel
 join lager  on lager.id  = wbn.id_lager
 join einheit  on einheit.id  = artikel.id_einheit

 order by wbn.zeitpunkt asc LIMIT 10");

 $queryNum = $warenbewegungen->selectQuery("SELECT COUNT(*) as numrows FROM warenbewegungen ");

 
 



 $pagConfig = array(
        'totalRows' =>$queryNum[0]->numrows,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
     );
         
 $pagination = new Pagination($pagConfig);




$lager = new lager();
$lagen = $lager->selectAll();


$artikel = new artikel();
$artikeln = $artikel->selectAll();



$einheit = new einheit();
$einheits = $einheit->selectAll();



?>
<style>
.loadingex{
 display:inline-block;
    width:30px;
    margin-top:15px;
    height:30px;
    border:2px solid rgba(20,83,136,.2);
    border-radius:50%;
    border-top-color:#ED1D25;
    animation:b 1s ease-in-out infinite;
    -webkit-animation:b 1s ease-in-out infinite;
    display:none
}
</style>
<div class="container-fluid disable-text-selection">
<div class="row">
   <div class="col-12">
      <div class="mb-2">
         <h1>List Warenbewegungen </h1>
         <div class="float-sm-right text-zero">
            <button type="button" class="btn btn-primary btn-lg  mr-1 url notlink" data-url="warenbewegungen/add.php" >Hinzufügen</button>
         </div>
      </div>
      <div class="separator mb-5"></div>
   </div>
</div>
<div class="row">
<div class="col-xl-12 col-lg-12 mb-4">
   <div class="card h-100">
      <div class="card-body">
         <form id="addform" target="_blank" method="post" name="form_warenbewegungen" action="<?php echo BASE_URL.'views/warenbewegungen/excel.php'?>" enctype="multipart/form-data">
            <div class="form-row">
               <div class="form-group   col-md-2">
                  <label> &nbsp;&nbsp;Stichwort : </label>
                  <input type="text" id="keywords"class="form-control" placeholder="Suche mit Schlüsselwort" onkeyup="searchFilter()"/>
               </div>
               <div class="form-group col-md-2">
                  <label for="limit">limit :</label>
                  <select class="form-control select2-single"   name="limit" id="limit"  >
                     <option value="10">10</option>
                     <option value="25">25</option>
                     <option value="50">50</option>
                     <option value="100">100</option>
                     <option value="200">200</option>
                     <option value="500">500</option>
                     <option value="1000">1000</option>
                     <option value="10000">10000</option>
                  </select>
               </div>

               <div class="form-group col-md-2">
                  <label for="code_tag">Art :</label>
                  <select class="form-control select2-single"     name="art" id="art"  >
                     <option value="0">alle</option>
                     <option value="Wareneingang">Wareneingang</option>
                     <option value="Warenausgang">Warenausgang</option>
                  </select>
               </div>
               <div class="form-group col-md-2">
                  <label for="id_client">Lager :</label>
                  <select class="form-control select2-single"     name="id_lager" id="id_lager"  >
                     <option value="0">alle</option>
                     <?php 
                        foreach ($lagen as $row) { 
                           echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }?>
                  </select>
               </div>
              
               <div class="form-group col-md-2">
                  <label for="id_client">Einheit :</label>
                  <select class="form-control select2-single"     name="id_einheit" id="id_einheit"  >
                     <option value="0">alle</option>
                     <?php 
                        foreach ($einheits as $row) { 
                           echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }?>
                  </select>
               </div>
               
            </div>
            <div class="row">
               <div class="form-group col-md-3">
                  <label for="date_DES_1">Zeitraums Von :</label>
                  <input type="text" class="form-control datepicker filter" id="zeitpunkt_von" name="zeitpunkt_von"  >
               </div>
               <div class="form-group col-md-3">
                  <label for="date_DES_2">Zeitraums bis :</label>
                  <input type="text" class="form-control datepicker filter" id="zeitpunkt_bis" name="zeitpunkt_bis"  >
               </div>
               <div class="form-group col-md-2 text-zero">
                  <button onclick="searchFilter()" type="button" class="btn btn-success default btn-lg btn-block  mr-1 " style="margin-top: 25px;">Submit</button>
               </div>
               <div class="form-group col-md-2 text-zero">
                  <button id="expotexcel" type="button" class="btn btn-success default btn-lg btn-block  mr-1 " style="margin-top: 25px;">Export Excel</button>
               </div>
               <div class="form-group col-md-2 text-zero">
                  <button id="expotexceltout" type="button" class="btn btn-success default btn-lg btn-block  mr-1 " style="margin-top: 25px;">Export Tout</button>
               </div>
              
            </div>
            <div class="row">
             
               <div class="loadingex"></div>
            </div>
         </form>
         <div id="posts_content">
            <div class="table-responsive ">
               <h1>Gesamte Warenbewegungen : <?php echo $queryNum[0]->numrows ; ?></h1>
               <table class="table datatables table-striped table-bordered" id="myTable" style="width: 100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Zeitpunkt</th>
                        <th>Art</th>
                        <th>Lager</th>
                        <th>Artikel</th>
                        <th>Menge</th>
                        <th>Einheit</th>
                        <th>Aktionen</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        $i=0;
                  foreach($query as $ligne) { $i++; ?>
                     <tr>
                        <td> <?php echo $ligne->id ; ?></td>
                        <td> <?php echo $ligne->zeitpunkt ; ?></td>
                        <td> <?php echo $ligne->art; ?> </td>
                        <td> <?php echo $ligne->lager; ?> </td>
                        <td> <?php echo $ligne->artikel; ?> </td>
                        <td> <?php echo $ligne->menge; ?> </td>
                        <td> <?php echo $ligne->einheit; ?> </td>
                        <td>
                          
                           <a class="badge badge-danger mb-2 delete" data-id="<?php echo $ligne->id; ?>" style="color: white;cursor: pointer;" title="Supprimer" href='javascript:void(0)' >
                           <i class="glyph-icon simple-icon-trash" style="font-size: 15px;"></i>
                           </a>
                          
                           <a class="badge badge-warning mb-2  url notlink" data-url="warenbewegungen/update.php?id=<?php echo $ligne->id;?>" style="color: white;cursor: pointer;" title="Modifier"
                              href="javascript:void(0)">
                           <i class="glyph-icon iconsmind-Pen-5" style="font-size: 15px;"> </i>
                           </a>
                           
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
            <?php echo $pagination->createLinks(); ?>
         </div>
      </div>
   </div>
</div>
                      
            <script type="text/javascript">
            
    function searchFilter(page_num) {

       
            page_num = page_num ? page_num : 0;
            var keywords = $('#keywords').val();
            var art = $('#art').val();
            var id_lager = $('#id_lager').val();
            var id_einheit = $('#id_einheit').val();
            var zeitpunkt_von = $('#zeitpunkt_von').val();
            var zeitpunkt_bis = $('#zeitpunkt_bis').val();
            var limit = $('#limit').val();
            

             $('#posts_content').html('<div class="loading"></div>');


            $.ajax({
                type: 'POST',
                  url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
                data: {


               

                "act":"pagination",
                "keywords":keywords,
                "page":page_num,
                "limit":limit,
                "art" : art,
                "id_lager" : id_lager,
                "id_einheit" : id_einheit,
                "zeitpunkt_von" : zeitpunkt_von,
                "zeitpunkt_bis" : zeitpunkt_bis,
                 },
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#posts_content').html(html);

         table =  $('#myTable').DataTable( {
                    responsive: true,
                   
                  
                    bPaginate: false, 
                    bFilter: false, 
                    bInfo: false,
                   
                      
                      
   });
         

                }
            });
        }



            $(document).ready(function () {


 

 $(".select2-single").select2({
            theme: "bootstrap",
            placeholder: "",
            maximumSelectionSize: 6,
            containerCssClass: ":all:"
        });
                $("input.datepicker").datepicker({
                     format: 'yyyy-mm-dd',
                     templates: {
                     leftArrow: '<i class="simple-icon-arrow-left"></i>',
                     rightArrow: '<i class="simple-icon-arrow-right"></i>'
                    }
                })
 $('#myTable').DataTable( {
                    responsive: true,
                   
                  
                    bPaginate: false, 
                    bFilter: false, 
                    bInfo: false,
                } );
            
            $('body').on( "click",".delete", function( event ) {
             event.preventDefault();


                    var btn = $(this);
                swal({
                 title: 'Sind Sie sicher ?',
                  text: "Sind Sie sicher, dass Sie diese Warenbewegungen löschen möchten?!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Ja, loeschen !'
                }).then((result) => {
                  if (result.value) {

                $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
                data: {act:"delete",id: btn.data('id')},
                success: function (data) {
                   
                   swal(
                      'Deleted',
                      'Ihre Datei wurde gelöscht.',
                      'success'
                    ).then((result) => {

                        btn.parents("td").parents("tr").remove();
                    });
                   
                }
            });
                    
                  }
                });
           
            });


        $('body').on( "click",".archive", function( event ) {
             event.preventDefault();


                    var btn = $(this);
                swal({
                 title: 'Sind Sie sicher?',
                  text: "Sind Sie sicher, dass Sie diese Warenbewegung archivieren möchten? ",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#145388',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Oui, Archiver!'
                }).then((result) => {
                  if (result.value) {

                $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
                data: {act:"archive",id: btn.data('id'),val:btn.data('arc')},
                success: function (data) {
                   
                               swal(
                                 "Archiviert",
                                  'Ihre Warrenbewegung wurde archiviert.',
                                  'success'
                                ).then((result) => {
                                    btn.parents("td").parents("tr").remove();
                                });
                               
                            }
                        });
                    
                  }
                });
           
            });


              $('body').on( "click",".static", function( event ) {
             event.preventDefault();

              var btn = $(this); 
                 $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>controle.php",
                data: {act:"getName",id: btn.data('id')},
                success: function (datas) {
                    var data = datas.split(';;;');
                            $('#exampleModalRight .modal-title').html("Status der Warenbewegung "+data[1]);
                            $('#idstatic').val(data[0]);
                            }
                        });

          
           
            });



              $("#expotexcel" ).on( "click", function( event ) {
            
                $( ".loadingex" ).show(); 
             var form = $( "#addform" );
             var datafrom = new FormData(document.getElementById("addform"))
             $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>excel.php",
                data: datafrom,
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                

                    var blob=new Blob([data]);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download="warenbewegungen_<?php echo date('Y-m-d') ?>.xls";
                link.click();
                $( ".loadingex" ).hide();      
                         
                                              
                }
            });
           
            });
            $("#expotexceltout" ).on( "click", function( event ) {
            

                $( ".loadingex" ).show(); 
            var form = $( "#addform" );
            var datafrom = new FormData(document.getElementById("addform"))
            $.ajax({
               type: "POST",
               url: "<?php echo BASE_URL.'views/warenbewegungen/' ;?>exceltout.php",
               data: datafrom,
               dataType: 'text',  // what to expect back from the PHP script, if anything
               cache: false,
               contentType: false,
               processData: false,
               success: function (data) {
               

                   var blob=new Blob([data]);
               var link=document.createElement('a');
               link.href=window.URL.createObjectURL(blob);
               link.download="warenbewegungen_<?php echo date('Y-m-d') ?>.xls";
               link.click();
               $( ".loadingex" ).hide();      
                        
                                             
               }
           });
          
           });

               });

            </script>