<?php 
 include('../../evr.php') ;

ini_set('memory_limit', '-1');

$warenbewegungen = new warenbewegungen();


   $query = $warenbewegungen->selectQuery("SELECT 
   wbn.*,lager.name as lager,artikel.name as artikel,einheit.name as einheit
   FROM warenbewegungen wbn 
   join artikel  on artikel.id = wbn.id_artikel
    join lager  on lager.id  = wbn.id_lager
   join einheit  on einheit.id  = artikel.id_einheit
   
            order by wbn.id asc ");




$queryNum = $warenbewegungen->selectQuery("SELECT 
wbn.*
FROM warenbewegungen wbn 
join artikel  on artikel.id = wbn.id_artikel
 join lager  on lager.id  = wbn.id_lager
join einheit  on einheit.id  = artikel.id_einheit
      
           order by  wbn.id asc");



$rowCount = count($queryNum);







 
$file="conteneur_".date('Y-m-d').".xls";
header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disface: attachment; filename=$file");
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 12">
<link rel=File-List href="arbo_fichiers/filelist.xml">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
</head>
<body>
<h1>Gesamte Warenbewegungen : <?php echo $rowCount ; ?></h1>
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
                    
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
</body>

</html>