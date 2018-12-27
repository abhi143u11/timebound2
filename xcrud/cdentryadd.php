<?php
include('xcrud/xcrud.php');
$title = "Docket Master";

$db = Xcrud_db::get_instance();
$query_customers = 'SELECT * FROM `customer`';
$db->query($query_customers);
$rows_customers = $db->result();

$query_mode = 'SELECT * FROM `service_tax`';
$db->query($query_mode);
$rows_modes = $db->result();


$query_city = 'SELECT * FROM `city`';
$db->query($query_city);
$rows_city = $db->result();

$xcrud = Xcrud::get_instance();

if (isset($_POST['btnSave'])) {

    $fromdate = date('Y-m-d', strtotime($_REQUEST['from_date']));
    $todate = date('Y-m-d', strtotime($_REQUEST['to_date']));
    if ($todate == "") {
        $todate = date("Y-m-d");
    }
    $customer = $_REQUEST['customer_name'];

    if ($customer != "All") {
        $customer = trim($_REQUEST['customer_name']);
    }
    
    $mode = $_REQUEST['mode'];
    if ($mode != "All") {
        $mode = $_REQUEST['mode'];
    }

    $city = $_REQUEST['city'];
    if ($city != "All") {
        $city = $_REQUEST['city'];
    }
}





$xcrud->table('courier_entry');
if (isset($_POST['btnSave'])) {
     if($_REQUEST['from_date']!="" && $_REQUEST['to_date']!=""){
         $xcrud->where('', "DATE_FORMAT( date,  '%Y-%m-%d' ) BETWEEN '" . $fromdate . "' AND '" . $todate . "'");
     }
    
    if ($city != "All") {
        $xcrud->where('dest =', $city);
        
        
    }
    
    if ($mode != "All") {
        $xcrud->where('',"mode LIKE '%".$mode."%'");
       
    }
    
    if ($customer != "All") {
        $xcrud->where('customer_id =', $customer);
    
     
    }
    
}

//print_r($mode);
//$xcrud->columns('name, gst_no, contact_person, phone, mobile, email, branch, city, state, pin, status');
//$xcrud->change_type('category', 'select', '', array('KG' => 'KG', 'Packets' => 'Packets'));
$xcrud->relation('customer_id', 'customer', 'cust_id', 'name');
$xcrud->relation('category', 'category', 'category_name', 'category_name');
$xcrud->relation('mode', 'service_tax', 'id', 'mode');
$xcrud->relation('origin_id', 'city', 'city_id', 'city_name');
$xcrud->relation('dest', 'city', 'city_id', 'city_name');
$xcrud->fields('consiment_no,date,customer_id, consignee,origin_id, dest, mode,category, packets,  actual_weight, chargeable_weight,  freight, fuel_charges, fuel_value, to_pay, pick_delivery, other_chrgs, other_charge_name, doc_charge, octrio_charge');
$xcrud->columns('consiment_no,date,customer_id, consignee,origin_id, dest, mode,category, packets, actual_weight, chargeable_weight,  freight, fuel_charges, fuel_value, to_pay, pick_delivery, other_chrgs, other_charge_name, doc_charge, octrio_charge, net_amount, service_tax_value, service_tax_amount, total_amount');
$xcrud->label('octrio_charge', 'Labour Charges');
$xcrud->label('consiment_no','Con. No.');
$xcrud->label('packets','Pkts');
$xcrud->label('packets','Pkts');
$xcrud->label('actual_weight','Ac Wt.');
$xcrud->label('chargeable_weight','Ch Wt./Packets');
$xcrud->label('packets','Pkts');
$xcrud->label('freight','Frgt');
$xcrud->label('to_pay','Tpay');
$xcrud->label('customer_id', 'Customer Name');
$xcrud->unset_remove();
$xcrud->sum('packets, from_weight, to_weight, actual_weight, chargeable_weight,  freight, fuel_charges, fuel_value, to_pay, pick_delivery, other_chrgs, other_charge_name, doc_charge, octrio_charge, net_amount, service_tax_value, service_tax_amount, total_amount');
$xcrud->table_name($title);
$xcrud->field_callback('freight','add_input_text');


$xcrud->before_insert('cdentry');
$xcrud->before_update('cdentry');
include_once 'header.php';
?>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<style type="text/css">
    .dataTables_filter input {
        width:600px !important;


    }
    #example2_filter{
        text-align: left !important;
    }

    .select2{
        max-width: 400px !important;
    }
    .form-horizontal .control-label,.table>thead:first-child>tr:first-child>th {

        text-transform: uppercase;
    }
</style>
<div class="row">

    <div class="col-md-12">
        <form class="form-inline" method="POST" >


            <div class="box">
                <div class="box-header">
                    <div class="row">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="from_date">From</label>  
                            <div class="col-md-4">
                                <input id="from_date" name="from_date" type="text" placeholder="dd-mm-yyyy" class="form-control input-md" value="">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="to_date">To</label>  
                            <div class="col-md-4">
                                <input id="to_date" name="to_date" type="text" placeholder="dd-mm-yyyy" class="form-control input-md" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label" for="mode">Mode</label>
                            <div class="col-md-4">
                                <select id="mode" name="mode" class="form-control">
                                    <option>All</option>
                                    <?php foreach ($rows_modes as $modes) { ?>
                                        <option value="<?php echo $modes['id']; ?>"><?php echo $modes['mode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="customer_name">Customer</label>
                            <div class="col-md-4">
                                <select id="customer_name" name="customer_name" class="form-control select2">
                                    <option>All</option>
                                    <?php foreach ($rows_customers as $customers) { ?>
                                        <option value="<?php echo $customers['cust_id']; ?>"><?php echo $customers['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="customer_name">City</label>
                            <div class="col-md-4">
                                <select id="city" name="city" class="form-control select2">
                                    <option>All</option>
                                    <?php foreach ($rows_city as $citys) { ?>
                                        <option value="<?php echo $citys['city_id']; ?>"><?php echo $citys['city_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="invoice">Invoice</label>
                            <div class="col-md-1">
                                <select id="invoice" name="invoice" class="form-control">
                                    <option value="All" >All</option>
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>

                                </select>
                            </div>
                        </div>



                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="btnSave"></label>
                            <div class="col-md-4">
                                <button id="btnSave" name="btnSave" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-12">
        <div class="box">
            <?php
            echo $xcrud->render();
//var_dump($xcrud);
            ?>
        </div>
    </div><!-- /.col -->
    <!-- ./col -->
</div>





<!-- ./col -->
</div>
<!-- /.row -->


</section>
<!-- /.content -->
</div>


<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo $version; ?>
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://digitalsense.in">Digital Sense</a>.</strong> All rights
    reserved.
</footer>


<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<script type="text/javascript">