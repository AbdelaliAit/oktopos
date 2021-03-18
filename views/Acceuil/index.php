<?php
if (isset($_POST['ajax'])) {
include('../../evr.php');
}


$result =  connexion::getConnexion()->query( " select  count(id) as total from warenbewegungen ");
$totalwarenbewegungen  = $result->fetch(PDO::FETCH_OBJ);

$result =  connexion::getConnexion()->query( " select  count(id) as total from lager ");
$totallager  = $result->fetch(PDO::FETCH_OBJ);


$result =  connexion::getConnexion()->query( " select  count(id) as total from artikel ");
$totalartikel  = $result->fetch(PDO::FETCH_OBJ);


$result =  connexion::getConnexion()->query( " select  count(id) as total from einheit ");
$totaleinheit  = $result->fetch(PDO::FETCH_OBJ);

?>
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Dashbord</h1>
                
            </div>
            
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row ">
        
        <div class="col-xl-3 col-lg-6 mb-4">
            
            <a href="#" class="card icon-cards-row">
                <div class="card-body text-center">
                    <i class="iconsmind-Bar-Chart "></i>
                    <p class="card-text mb-0">Gesamte Warenbewegungen</p>
                    <p class="lead text-center"><?php echo $totalwarenbewegungen->total ?></p>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4">
            
            <a href="#" class="card icon-cards-row">
                <div class="card-body text-center">
                    <i class="iconsmind-Bar-Chart"></i>
                    <p class="card-text mb-0">Gesamte Artikel</p>
                    <p class="lead text-center"><?php echo $totalartikel->total ?></p>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4">
            
            <a href="#" class="card icon-cards-row">
                <div class="card-body text-center">
                    <i class="iconsmind-Bar-Chart"></i>
                    <p class="card-text mb-0">Gesamte  Lager</p>
                    <p class="lead text-center"><?php echo  $totallager->total ?> </p>
                </div>
            </a>
        </div>
                <div class="col-xl-3 col-lg-6 mb-4">
            
            <a href="#" class="card icon-cards-row">
                <div class="card-body text-center">
                    <i class="iconsmind-Bar-Chart"></i>
                    <p class="card-text mb-0">Gesamte  Einheiten</p>
                    <p class="lead text-center"><?php echo  $totaleinheit->total ?> </p>
                </div>
            </a>
        </div>
      <!--   <div class="col-xl-3 col-lg-6 mb-4">
            
            <a href="#" class="card icon-cards-row">
                <div class="card-body text-center">
                    <i class="iconsmind-Money-2"></i>
                    <p class="card-text mb-0">Chiffre d'affaires régler</p>
                    <p class="lead text-center"><?php echo  number_format( $totalreg->total , 2, '.', ' '); ?> DH</p>
                </div>
            </a>
        </div> -->
    </div>


    </div>


            <script type="text/javascript">
            
            $(document).ready(function () {


 $('#myTable').DataTable( {
                    responsive: true,
                    
                } );

             
          

           
            });

            </script>