<?php
include('xcrud/xcrud.php');
$title = "Courier Entry";
$xcrud = Xcrud::get_instance();
$xcrud->table('courier_entry');

//$xcrud->columns('name, gst_no, contact_person, phone, mobile, email, branch, city, state, pin, status');
$xcrud->change_type('category','select','',array('KG'=>'KG','Packets'=>'Packets'));
$xcrud->relation('customer_id','customer','cust_id','name');
$xcrud->relation('mode','service_tax','id','mode');
$xcrud->relation('origin_id','city','city_id','city_name');
$xcrud->relation('dest','city','city_id','city_name');
$xcrud->fields('consiment_no,date,customer_id, consignee,origin_id, dest, mode,category, packets, from_weight, to_weight, actual_weight, chargeable_weight,  freight, fuel_charges, fuel_value, to_pay, pick_delivery, other_chrgs, other_charge_name, doc_charge, octrio_charge');
$xcrud->columns('consiment_no,date,customer_id, consignee,origin_id, dest, mode,category, packets, from_weight, to_weight, actual_weight, chargeable_weight,  freight, fuel_charges, fuel_value, to_pay, pick_delivery, other_chrgs, other_charge_name, doc_charge, octrio_charge, net_amount, service_tax_value, service_tax_amount, total_amount');
$xcrud->label('octrio_charge', 'Labour Charges');

$xcrud->table_name($title);
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