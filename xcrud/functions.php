<?php

function cdentry($postdata, $primary, $xcrud) {
    //$postdata->set('password', sha1( $postdata->get('password') ));

    $db = Xcrud_db::get_instance();
    $db->query('SELECT `value` FROM `service_tax` WHERE `id` = ' . $postdata->get('mode'));

    $servicetax = $db->result();
    $servicetaxrate = $servicetax[0]['value'];

    $cdentrydate = date('Y-m-d', strtotime($postdata->get('date')));
    $cust_id = $postdata->get('customer_id');
    $dest = $postdata->get('dest');
    $mode = $postdata->get('mode');
    $chargeable_weight = $postdata->get('chargeable_weight');
    $type = $postdata->get('category');
    $topay = $postdata->get('to_pay');
    $pick_delivery = $postdata->get('pick_delivery');
    $other_chrgs = $postdata->get('other_chrgs');
    $doc_charge = $postdata->get('doc_charge');
    $octrio_charge = $postdata->get('octrio_charge');
    $freight = $postdata->get('freight');

 $chargeable_weight = number_format($chargeable_weight,0);
    $query1 = "SELECT `from_weight`,`to_weight`,rate,fuel_charge  FROM `rate_master` WHERE ";
    $query1 .= "'" . $cdentrydate . "' BETWEEN wef_from_date AND CURDATE() AND cust_id=" . $cust_id . " AND city_id=" . $dest . " AND mode_id=" . $mode;
    $query1 .= " AND " . $chargeable_weight . " BETWEEN from_weight AND to_weight AND type = '" . $type . "'";

    $db->query($query1);
    $customerrate = $db->result();
    $customer_rate = $customerrate[0]['rate'];
    $fuelscharge = $customerrate[0]['fuel_charge'];


    //Setting Service Tax
    $postdata->set('service_tax_value', $servicetaxrate);
    //Setting Customer Rate
    $postdata->set('cust_rate', $customer_rate);
    //Setting Fuel Surcharge Value
    $postdata->set('fuel_value', $fuelscharge);
    $netamount = $customer_rate * $chargeable_weight;
    $fuelcharges = ceil(($fuelscharge * $netamount) / 100);
    //Setting Fuel  charge Value
    $postdata->set('fuel_charges', $fuelcharges);
    $grandtotal = $netamount + $other_chrgs + $topay + $fuelcharges + $freight + $pick_delivery + $doc_charge + $octrio_charge;
    
    //Setting Net Amount
    $postdata->set('net_amount', $grandtotal);

   $servicetaxamount = ceil(($servicetaxrate * $grandtotal) / 100);
    $total = $grandtotal + $servicetaxamount;

    $postdata->set('service_tax_amount', $servicetaxamount);
    $postdata->set('total_amount', $total);
}

function invoice($postdata, $primary, $xcrud) {
    //$postdata->set('password', sha1( $postdata->get('password') ));
    $mode = $postdata->get('mode');
    $from_date = date("Y-m-d", strtotime($postdata->get('from_date')));
    $to_date = date("Y-m-d", strtotime($postdata->get('to_date')));
    $cust_id1 = $postdata->get('cust_id');
    $cust_id = $postdata->get('cust_id');
    $adjustment = $postdata->get('adjustment_amt');
    $query = "SELECT ROUND(sum(`total_amount`),2) AS amount,GROUP_CONCAT(consiment_no ORDER BY consiment_no ASC SEPARATOR ',') as cdentry "
            . " FROM `courier_entry` a WHERE ";
    if ($from_date != "" && $to_date != "") {
        $query .= " a.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
    }
    if ($cust_id != "") {
        $query .= " AND a.customer_id=" . $cust_id;
    }
    if (strlen($mode) <= 0) {
        $mode = 0;
    } else {
        $query .= " AND a.mode IN (" . $mode . ")";
    }

    $query .= " ORDER By  a.date";


    //$result = $database->query_fetch_full_result($query);



    $db = Xcrud_db::get_instance();
    $db->query($query);

    $result = $db->result();
    $total_amount = $result[0]['amount'];
    $cdentry = $result[0]['cdentry'];
    
    $net_total = $total_amount+$adjustment;
    $postdata->set('cd_entry_id', $cdentry);
    $postdata->set('total_amount', $total_amount);
    $postdata->set('net_total',$net_total);
    
    //Update Consignment number to invoiced
    
    $update_invoiced = "UPDATE `courier_entry` SET `invoiced`=1 WHERE consiment_no IN (".$cdentry.")";
    $db->query($update_invoiced);
    
}
