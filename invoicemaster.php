<?php

include('xcrud/xcrud.php');
$title = "Invoice Master";
$invoice_master = Xcrud::get_instance();
$invoice_master->table('invoice');
$invoice_master->relation('cust_id','customer','cust_id','name');
$invoice_master->relation('mode','service_tax','id','mode','','',true);
$invoice_master->relation('company_profile_id','company_profile','id','company_name');
$invoice_master->fields('cust_id,from_date, to_date, mode, adjustment_amt, cgst, sgst, igst,company_profile_id');
$invoice_master->columns('id,cust_id,from_date, to_date, mode, cd_entry_id, total_amount, adjustment_amt, cgst, sgst, igst, net_total, company_profile_id');
$invoice_master->order_by('id',desc);
//$invoice_master->change_type('id', 'price', '', array('prefix'=>'INV00','decimals'=>'0'));
$invoice_master->before_update('invoice');
$invoice_master->before_insert('invoice');
$invoice_master->sum('total_amount,adjustment_amt,net_total');

$invoice_master->show_primary_ai_field(true);
$invoice_master->table_name($title);

$invoice_master->label('cust_id','Customer');
$invoice_master->label('id','Invoice No.');
$invoice_master->label('cd_entry_id',"CD No's");
$invoice_master->label('company_profile_id',"Company");
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

        //echo $invoice_master->render_search();
        echo $invoice_master->render();
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