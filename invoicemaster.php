<?php

include('xcrud/xcrud.php');
$title = "Invoice Master";
$invoice_master = Xcrud::get_instance();

$db = Xcrud_db::get_instance();
$query_customers = 'SELECT * FROM `customer` ORDER BY name';
$db->query($query_customers);
$rows_customers = $db->result();



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
    
 
}


$invoice_master->table('invoice');

if (isset($_POST['btnSave'])) {
     if($_REQUEST['from_date']!="" && $_REQUEST['to_date']!=""){
         $invoice_master->where('', "DATE_FORMAT( create_date,  '%Y-%m-%d' ) BETWEEN '" . $fromdate . "' AND '" . $todate . "'");
     }
   
    
    if ($customer != "All") {
        $invoice_master->where('cust_id =', $customer);
    
     
    }
    
}
$invoice_master->relation('cust_id','customer','cust_id','name');
$invoice_master->relation('mode','service_tax','id','mode','','',true);
$invoice_master->relation('company_profile_id','company_profile','id','company_name');
$invoice_master->fields('cust_id,invoice_date,from_date, to_date, mode, adjustment_amt, cgst, sgst, igst,company_profile_id');
$invoice_master->columns('id,cust_id,invoice_date,from_date, to_date, mode, total_amount, adjustment_amt, cgst, sgst, igst, net_total, company_profile_id');
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
$invoice_master->button('plan/download/invoice.php?id={id}','Print Invoice','fa fa-file','',array('target'=>'_blank'));
$invoice_master->unset_view();
$invoice_master->unset_remove();
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

    <div class="box">
         <form class="form-inline" method="POST" >


            
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
                      

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="btnSave"></label>
                            <div class="col-md-4">
                                <button id="btnSave" name="btnSave" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                    </div>
            
        </form>
    </div>
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

<script type="text/javascript">
    $('#from_date').val("<?php if (isset($fromdate)) echo $fromdate; ?>");
                            $('#to_date').val("<?php if (isset($todate)) echo $todate; ?>");
<?php
if (isset($customer)) {
    ?>

                                $('#customer_name').val("<?php if (isset($customer)) echo $customer; ?>");
    <?php
}

?>

    
  
    $('#from_date').datepicker({
        format: "dd-mm-yyyy"
    });
    $('#to_date').datepicker({
        format: "dd-mm-yyyy"
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">
jQuery(document).on("xcrudbeforerequest", function(event, container) {
    if (container) {
        jQuery(container).find("select").select2("destroy");
    } else {
        jQuery(".xcrud").find("select").select2("destroy");
    }
});
jQuery(document).on("ready xcrudafterrequest", function(event, container) {
    if (container) {
        jQuery(container).find("select").select2();
    } else {
        jQuery(".xcrud").find("select").select2();
    }
});
jQuery(document).on("xcrudbeforedepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2("destroy");
});
jQuery(document).on("xcrudafterdepend", function(event, container, data) {
    jQuery(container).find('select[name="' + data.name + '"]').select2();
});


    jQuery('.select2').select2();
</script>