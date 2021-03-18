<?php 
 include('../../evr.php') ;

ini_set('memory_limit', '-1');

$warenbewegungen = new warenbewegungen();


$start = !empty($_POST['page']) ? $_POST['page'] : 0;
$limit = $_POST['limit'] ;

//set conditions for search
$depot_cat_sql = '';
$whereSQL = $orderSQL = '';
$keywords = $_POST['keywords'];

$art = $_POST['art'];
$id_lager = $_POST['id_lager'];
$id_einheit = $_POST['id_einheit'];
$zeitpunkt_von = $_POST['zeitpunkt_von'];
$zeitpunkt_bis = $_POST['zeitpunkt_bis'];


$date_des = '';

   if ($zeitpunkt_von !='' && $zeitpunkt_bis =="") {
      $date_des= " and DATEDIFF(wbn.zeitpunkt ,'$zeitpunkt_von')>=0 ";
   }

   if ($zeitpunkt_bis !='' && $zeitpunkt_von =="") {
      $date_des= " and DATEDIFF(wbn.zeitpunkt ,'$zeitpunkt_bis')<=0 ";
   }

   if ($zeitpunkt_von !='' && $zeitpunkt_bis !='' ) {
      $date_des= " and wbn.zeitpunkt between '$zeitpunkt_von' and '$zeitpunkt_bis' ";
   }

  $depot_cat_sql .= $date_des;

if($art != '0') {
   $depot_cat_sql .= " and wbn.art =  '$art' ";
 }


if($id_lager != '0') {
   $depot_cat_sql .= " and wbn.id_lager =  '$id_lager' ";
}

if($id_einheit != '0') {
   $depot_cat_sql .= " and artikel.id_einheit =  '$id_einheit' ";
 }




if(!empty($keywords)) {
   $whereSQL = "WHERE 1 " . $depot_cat_sql . " AND (artikel.name LIKE '%" . $keywords . "%' OR artikel.code LIKE '%" . $keywords . "%' OR lager.name LIKE '%" . $keywords . "%' OR lager.code LIKE '%" . $keywords . "%')";
} else {
   $whereSQL = "WHERE 1 " . $depot_cat_sql . " ";
}
if(!empty($sortBy)) {
   $orderSQL = " ORDER BY zeitpunkt " . $sortBy;
} else {
   $orderSQL = " ORDER BY zeitpunkt ";
}


$orderSQL = " ORDER BY id DESC ";
//get number of rows

$datalimit = "";
if($limit !=0)	$datalimit = "LIMIT $start,$limit";



   $query = $warenbewegungen->selectQuery("SELECT 
   wbn.*,lager.name as lager,artikel.name as artikel,einheit.name as einheit
   FROM warenbewegungen wbn 
   join artikel  on artikel.id = wbn.id_artikel
    join lager  on lager.id  = wbn.id_lager
   join einheit  on einheit.id  = artikel.id_einheit
   
            $whereSQL
            order by wbn.id asc $datalimit");




$queryNum = $warenbewegungen->selectQuery("SELECT 
wbn.*
FROM warenbewegungen wbn 
join artikel  on artikel.id = wbn.id_artikel
 join lager  on lager.id  = wbn.id_lager
join einheit  on einheit.id  = artikel.id_einheit
         $whereSQL
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