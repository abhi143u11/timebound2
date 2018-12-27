<?php

require_once("classes/class.database.php");
include_once('classes/func.global.php');
require_once("classes/class.cdentry.php");
$Custid = $_GET['CustID'];
$Cityid = $_GET['CityID'];
$Modeid = $_GET['ModeID'];
$Cddate = $_GET['DateID'];
$weight = $_GET['Weight'];
$origin = $_GET['OriginID'];
$type = $_GET['Type'];
$packets = $_GET['Packets'];
$cdentry = new Ds_CDEntry();
$cdentry->set_Customerid($Custid);
$cdentry->set_Dest($Cityid);
$cdentry->set_Mode($Modeid);
$cdentry->set_Date(date('Y-m-d', strtotime($Cddate)));
if($type=="KG"){
$cdentry->set_chargeableweight($weight);
}else{
    $cdentry->set_chargeableweight($packets);
}
$cdentry->set_type($type);
$query = "select city_name from city where city_id=$origin";
$city_name;
$response = mysql_query($query);
$result = mysql_fetch_array($response);
if ($result) {

    $city_name = $result[0];
}

if ($city_name != "Vapi") {
    $cdentry->set_origin_id($origin);
}


$result = $cdentry->GetCustWtAndRate();

if (isset($result) && is_array($result) && count($result)) {
    foreach ($result as $dest) {
//echo '<option value="'.$dest['rate'].'|'.$dest['from_weight'].'-'.$dest['to_weight'].'|'.$dest['fuel_charge'].'">'.$dest['from_weight'].'-'.$dest['to_weight'].'</option>';
        $data = "" . $dest['rate'] . "|" . $dest['from_weight'] . "-" . $dest['to_weight'] . "|" . $dest['fuel_charge'];
        echo $data;
    }
}
?>