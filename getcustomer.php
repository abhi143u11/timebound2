<?php
include('xcrud/xcrud.php');
$customerid = $_GET['CustID'];

$db = Xcrud_db::get_instance();
$query_origincity = 'SELECT DISTINCT(rate_master.origin_id),c1.city_name as orgcity,c1.city_id as orgcityid FROM `rate_master`
LEFT JOIN city c1 ON c1.city_id = rate_master.origin_id 
WHERE `cust_id` = '.$customerid;
$db->query($query_origincity);
$origincities = $db->result();

$orgcty ="";
foreach ($origincities as $orgcity){

    $orgcty .= "<option value='".$orgcity['origin_id']."'>".$orgcity['orgcity']."</option>";
}





$query_destcity = 'SELECT DISTINCT(rate_master.city_id),c1.city_name as orgcity,c1.city_id as orgcityid FROM `rate_master`
LEFT JOIN city c1 ON c1.city_id = rate_master.city_id 
WHERE `cust_id` = '.$customerid;
$db->query($query_destcity);
$destcities = $db->result();

$descty ="";
foreach ($destcities as $descity){

    $descty .= "<option value='".$descity['city_id']."'>".$descity['orgcity']."</option>";
}

$mode = "";

$query_mode = 'SELECT DISTINCT(mode_id),service_tax.mode,service_tax.value FROM `rate_master`
LEFT JOIN service_tax ON service_tax.id = rate_master.mode_id
WHERE `cust_id` = '.$customerid;
$db->query($query_mode);
$modes = $db->result();
$mody = "";
foreach ($modes as $mode){

    $mody .= "<option value='".$mode['mode_id']."'>".$mode['mode']."</option>";
}


$query_cat = 'SELECT DISTINCT(type) FROM `rate_master`
WHERE `cust_id` = '.$customerid;
$db->query($query_cat);
$cats = $db->result();
$caty = "";
foreach ($cats as $cat){

    $caty .= "<option value='".$cat['type']."'>".$cat['type']."</option>";
}

$data = $orgcty."|".$descty."|".$mody."|".$caty;
echo $data;

?>