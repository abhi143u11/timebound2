<?php


if(!isset($_REQUEST['CDNO']) || empty($_REQUEST['CDNO']))
{
   echo '0'; exit();
}

$cdno = trim($_REQUEST['CDNO']); 
include('xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$query_cdno = 'SELECT * from courier_entry 
WHERE `consiment_no` = '.$cdno;
$rows_cdno = $db->query($query_cdno);
$query_cdno = $db->result();
$count_cdno = count($query_cdno);


if($count_cdno>0){
    echo '1';
    exit();
}else{
    echo '0';
}

?>