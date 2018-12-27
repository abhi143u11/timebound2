<?php

include('xcrud/xcrud.php');
$Custid = $_GET['CustID'];
$Cityid = $_GET['CityID'];
$Modeid = $_GET['ModeID'];
$Cddate = $_GET['DateID'];
$weight = $_GET['Weight'];
$origin = $_GET['OriginID'];
$packets = $_GET['Packets'];
$packetswt = $_GET['PacketsWT'];
if($packets!="KG"){
    $weight = $packetswt;
}
$dateofcd = date('Y-m-d', strtotime($Cddate));
$db = Xcrud_db::get_instance();


$query = "SELECT `from_weight`,`to_weight`,rate,fuel_charge,service_tax.value as servicetax  FROM `rate_master` LEFT JOIN service_tax ON rate_master.mode_id = service_tax.id WHERE ";
//$query.=" CURDATE() BETWEEN wef_from_date AND wef_to_date AND cust_id=".  $this->customerid." AND city_id=".$this->dest." AND mode_id=".$this->mode;
$query .= "'" . $dateofcd . "' BETWEEN wef_from_date AND CURDATE() "
        . "AND cust_id=" . $Custid . " "
        . "AND city_id=" . $Cityid . " "
        . "AND mode_id=" . $Modeid." "
        . "AND type= '" . $packets."' "
        . "AND origin_id = " . $origin." "
        . " AND " . $weight . " BETWEEN from_weight AND to_weight ";


$db->query($query);
$data = $db->result();

foreach ($data as $dat){

    $dat = $dat['servicetax']."|".$dat['rate']."|".$dat['fuel_charge'];
}

echo $dat;

?>