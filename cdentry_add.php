<?php
include('xcrud/xcrud.php');
$title = "Docket Master";

$db = Xcrud_db::get_instance();
$query_customers = 'SELECT * FROM `customer` ORDER BY name ASC';
$db->query($query_customers);
$customers = $db->result();

$query_mode = 'SELECT * FROM `service_tax`';
$db->query($query_mode);
$modes = $db->result();


$query_city = 'SELECT * FROM `city` ORDER BY city_name ASC';
$db->query($query_city);
$cities = $db->result();

$query_category = 'SELECT * FROM `category` ORDER BY category_name ASC';
$db->query($query_category);
$categories = $db->result();
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
<script
    type="text/javascript" src="plugins/angular.js"
></script>
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
        <div class="box" >
            <form class="form-horizontal" method="POST"  id="cdentryadd"  action="" name="cdentryadd" ng-app>



                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="consiment_no">CONSIGNMENT NO</label>  
                            <div class="col-md-8">
                                <input id="consiment_no" name="consiment_no" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="date">DATE</label>  
                            <div class="col-md-8">
                                <input id="cddate" name="cddate" type="text" placeholder="dd-mm-yyyy" class="form-control input-md" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="customer_name">CUSTOMER</label>
                            <div class="col-md-8">
                                <select id="customer_name" name="customer_name" class="form-control">

                                    <?php
                                    if (isset($customers) && is_array($customers) && count($customers)) {
                                        foreach ($customers as $customer) {
                                            ?>
                                            <option value="<?php echo $customer['cust_id'] ?>"><?php echo $customer['name'] ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="consiment_no">CONSIGNEE</label>  
                            <div class="col-md-8">
                                <input id="consignee" name="consignee" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="consiment_no">GATEWAY</label>  
                            <div class="col-md-8">
                                <input id="gate_way" name="gate_way" type="text" placeholder="" class="form-control input-md" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">       
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="dest">Origin</label>
                            <div class="col-md-8">
                                <select id="origin" name="origin" class="form-control">
                                    <?php
                                    if (isset($cities) && is_array($cities) && count($cities)) {

                                        foreach ($cities as $city) {
                                            if ($city['city_name'] == "Vapi") {
                                                ?>
                                                <option value="<?php echo $city['city_id'] ?>" selected="selected"><?php echo $city['city_name'] ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'] ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">       
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="dest">DESTINATION</label>
                            <div class="col-md-8">
                                <select id="dest" name="dest" class="form-control">
                                    <?php
                                    if (isset($cities) && is_array($cities) && count($cities)) {

                                        foreach ($cities as $city) {
                                            ?>
                                            <option value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mode">MODE</label>
                            <div class="col-md-8">
                                <select id="mode" name="mode" class="form-control">
                                    <option>Choose Mode</option>
                                    <?php
                                    if (isset($modes) && is_array($modes) && count($modes)) {
                                        foreach ($modes as $mode) {
                                            ?>
                                            <option value="<?php echo $mode['id'] ?>"><?php echo $mode['mode'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mode">Category</label>
                            <div class="col-md-8">
                                <select id="category" name="category" class="form-control">
                                    <option>Choose Category</option>
                                    <?php
                                    if (isset($categories) && is_array($categories) && count($categories)) {
                                        foreach ($categories as $category) {
                                            ?>
                                            <option value="<?php echo $category['category_name']; ?>"><?php echo $category['category_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="packets">PACKETS</label>  
                            <div class="col-md-8">
                                <input id="packets" name="packets" type="text" placeholder="" class="form-control input-md" value="<?php
                                if (isset($result_cdentry)) {
                                    echo $cdentry->get_Packets();
                                }
                                ?>">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="actual_weight">ACTUAL WT.</label>  
                            <div class="col-md-8">
                                <input id="actual_weight" name="actual_weight" type="text" placeholder="" class="form-control input-md" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="chargeable_weight">CHARGABLE WT.</label>  
                            <div class="col-md-8">
                                <input id="chargeable_weight" name="chargeable_weight" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="custrate">RATE</label>  
                            <div class="col-md-8">
                                <input id="custrate" name="custrate" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="net_amount">FREIGHT</label>  
                            <div class="col-md-8">
                                <input id="net_amount" name="net_amount" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fuel_charges">F.S.CHARG</label>  
                            <div class="col-md-8">
                                <input id="fuel_charges" name="fuel_charges" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="to_pay">TOPAY/FOV</label>  
                            <div class="col-md-8">
                                <input id="to_pay" name="to_pay" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pick_delivery">PICKUP/DLVRY </label>  
                            <div class="col-md-8">
                                <input id="pick_delivery" name="pick_delivery" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="doc_charge">DOC. CHARG</label>  
                            <div class="col-md-8">
                                <input id="doc_charge" name="doc_charge" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>



                    <div class="col-sm-6 col-lg-6"> 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="other_chrgs">OTHER CHRG.</label>  
                            <div class="col-md-8">
                                <input id="other_chrgs" name="other_chrgs" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6"> 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="other_chrgs">Octrio CHRG.</label>  
                            <div class="col-md-8">
                                <input id="octrio_charge" name="octrio_charge" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="service_tax_value">Total Amt</label>  
                            <div class="col-md-8"> 
                                <input id="net_total" name="net_total" type="text" placeholder="" class="form-control input-md" value="">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="service_tax_value">S. TAX VAL.</label>  
                            <div class="col-md-8"> 
                                <input id="service_tax_value" name="service_tax_value" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="service_tax_amount" >S. TAX AMT.</label>  
                            <div class="col-md-8">
                                <input id="service_tax_amount" name="service_tax_amount" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="total_amount">Net Total</label>  
                            <div class="col-md-8">
                                <input id="total_amount" name="total_amount" type="text" placeholder="" class="form-control input-md" value="" >

                            </div>
                        </div>
                    </div>



                    <div class="clearfix"></div>




                    <div class="col-sm-6 col-lg-6">
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="btnSave"></label>
                            <div class="col-md-8">
                                <button id="btnSave" name="btnSave" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</div><!-- /.col -->
<!-- ./col -->





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

<script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
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

if (isset($mode)) {
    ?>

        $('#mode').val("<?php if (isset($mode)) echo $mode; ?>");
    <?php
}
if (isset($invoice)) {
    ?>
        $('#invoice').val("<?php if (isset($invoice)) echo $invoice; ?>");
    <?php
}

if (isset($city)) {
    ?>
        $('#city').val("<?php if (isset($city)) echo $city; ?>");
<?php }
?>



    $('#from_date').datepicker({
        format: "dd-mm-yyyy"
    });
    $('#to_date').datepicker({
        format: "dd-mm-yyyy"
    });
</script>

<script type="text/javascript">
    $('#cddate').datepicker({
        format: "dd-mm-yyyy"
    });
</script>

<script type="text/javascript">

    $("#packets").bind("change", function () {
        if($("#category").val()!="KG"){

        GetWeightAndRate();
    }
    });

    $("#chargeable_weight").bind("change", function () {

        GetWeightAndRate();
    });
    $("#customer_name").bind("change", function () {
        GetCustomerData();
    });
    $("#consiment_no").bind("change", function () {
        CheckCDNO();
    });
    function CheckCDNO()
    {

        $.post("checkcdno.php", {CDNO: $("#consiment_no").val()}, function (data) {
            if (data == '1') {
                var msg = " Docket Number Already Exists";
                var cdno = $("#consiment_no").val();
                alert(cdno + msg);
                $("#cdentryadd input").prop("disabled", true);
                $("#cdentryadd select").prop("disabled", true);
                $("#consiment_no").removeAttr("disabled");

            }
            if (data == '0') {

                $("#cdentryadd input").removeAttr("disabled");
                $("#cdentryadd select").removeAttr("disabled");
                $("#consiment_no").removeAttr("disabled");
            }
        });
    }



    function GetCustomerData() {

        $.ajax({
            type: "GET",
            url: "getcustomer.php",
            data: {
                "CustID": $("#customer_name").val()
            },
            success: function (html) {

                if (html != "")
                {
                    console.log(html);
                    var data = html.split("|");
                    var origin = data[0];
                    var destination = data[1];
                    var mode = data[2];
                    var category = data[3];
                    // alert(data[0]);
                    // alert(data[1]);
                    $("#origin")
                            .find('option')
                            .remove()
                            .end()
                            .append(origin);
                    $("#dest")
                            .find('option')
                            .remove()
                            .end()
                            .append(destination);
                    $("#mode")
                            .find('option')
                            .remove()
                            .end()
                            .append(mode);
                    $("#category")
                            .find('option')
                            .remove()
                            .end()
                            .append(category);
                }
            }
        });
    }



    function GetWeightAndRate()
    {


        $.ajax({
            type: "GET",
            url: "getrate.php",
            data: {
                "CustID": $("#customer_name").val(),
                "CityID": $("#dest").val(),
                "ModeID": $("#mode").val(),
                "DateID": $("#cddate").val(),
                "OriginID": $("#origin").val(),
                "Weight": $("#chargeable_weight").val(),
                "Packets": $("#category").val(),
                "PacketsWT": $("#packets").val()
            },
            success: function (html) {

                if (html != "")
                {
                    var dat = html.split("|");

                    var rate = dat[1];
                    var fuel_s_chrg = dat[2];
                    var service_tax = dat[0];

                    $("#custrate").val(rate);
                    $("#service_tax_value").val(service_tax);
                    $("#fuel_charges").val(fuel_s_chrg);
                    if($("#category").val()!="KG"){
                     var chwt =   $("#packets").val();
                     $("#chargeable_weight").val(chwt);
                    }
                    calculatenetamount();
                    calculatefields();

                }


            }
        });
    }
    function calculatenetamount()
    {

        var chargeablewt;
        var rate;
        var result;
        var fuelscharge;
        if ($("#custrate").val() != "" && $("#chargeable_weight").val() != "")
        {
            chargeablewt = $("#chargeable_weight").val();
            rate = $("#custrate").val();

            result = parseFloat(chargeablewt) * parseFloat(rate);
        }

        if (!isNaN(result)) {
            rt = parseFloat(result).toFixed(2);
            $("#net_amount").val(rt);


            fuelscharge = $("#fuel_s_charge").val();


            if (!isNaN(fuelscharge)) {
                var fuelcharge = Math.round(((parseFloat(fuelscharge) * parseFloat(rt)) / 100)).toFixed(2);
                $("#fuel_charges").val(fuelcharge);
            }
        }

    }
    function calculatefields()
    {
        var fuel;
        var pickdelivery;
        var topay;
        var othercharges;
        var freight = 0;
        var servicetaxamt;
        var total = 0;
        var netamt;
        var servicetaxvalue;
        var doccharge;
        var net_total;
        var grand_total;
        var octrio_charge;

        if (!$("#service_tax_value").val() == "")
        {
            servicetaxvalue = $("#service_tax_value").val();
        } else
        {
            servicetaxvalue = 0;
        }

        if (!$("#net_amount").val() == "")
        {
            netamt = $("#net_amount").val();
        }
        if (!$("#pick_delivery").val() == "")
        {
            pickdelivery = $("#pick_delivery").val();

        } else
        {
            pickdelivery = 0;
        }
        if (!$("#to_pay").val() == "")
        {
            topay = $("#to_pay").val();

        } else
        {
            topay = 0;
        }
        if (!$("#other_chrgs").val() == "")
        {
            othercharges = $("#other_chrgs").val();

        } else
        {
            othercharges = 0;
        }
        if (!$("#doc_charge").val() == "")
        {
            doccharge = $("#doc_charge").val();

        } else
        {
            doccharge = 0;
        }
        if (!$("#octrio_charge").val() == "")
        {
            octrio_charge = $("#octrio_charge").val();

        } else
        {
            octrio_charge = 0;
        }



        if (!$("#fuel_charges").val() == "")
        {
            fuel = $("#fuel_charges").val();

        } else
        {
            fuel = 0;
        }

        grand_total = parseFloat(netamt) + parseFloat(othercharges) + parseFloat(topay) + parseFloat(fuel) + parseFloat(freight) + parseFloat(pickdelivery) + parseFloat(doccharge) + parseFloat(octrio_charge);

        if (!servicetaxvalue == 0)
        {
            if (!grand_total == 0)
            {
                servicetaxamt = Math.ceil(((parseFloat(servicetaxvalue) * parseFloat(grand_total)) / 100)).toFixed(2);
                total = parseFloat(netamt) + parseFloat(othercharges) + parseFloat(topay) + parseFloat(fuel) + parseFloat(freight) + parseFloat(pickdelivery) + parseFloat(servicetaxamt) + parseFloat(doccharge) + parseFloat(octrio_charge);
            }


        }
        if (!isNaN(servicetaxamt)) {
            sta = parseFloat(servicetaxamt).toFixed(2);
            $("#service_tax_amount").val(sta);

        }
        if (!isNaN(grand_total)) {
            gt = parseFloat(grand_total).toFixed(2);
            $("#net_total").val(gt);

        }
        if (!isNaN(total)) {
            tt = parseFloat(total).toFixed(2);
            $("#total_amount").val(tt);
        }
    }

    $("#net_amount").bind("change", function ()
    {
        calculatefields();
    });
    $("#net_amount").bind("focus", function ()
    {
        calculatefields();
    });
    $("#fuel_charges").bind("change", function ()
    {
        calculatefields();
    });
    $("#fuel_charges").bind("focus", function ()
    {
        calculatefields();
    });
    $("#pick_delivery").bind("change", function ()
    {
        calculatefields();
    });
    $("#pick_delivery").bind("focus", function ()
    {
        calculatefields();
    });
    $("#to_pay").bind("change", function ()
    {
        calculatefields();
    });
    $("#to_pay").bind("focus", function ()
    {
        calculatefields();

    });
    $("#other_chrgs").bind("change", function ()
    {
        calculatefields();
    });
    $("#other_chrgs").bind("focus", function ()
    {
        calculatefields();
    });
    $("#doc_charge").bind("change", function ()
    {
        calculatefields();
    });
    $("#doc_charge").bind("focus", function ()
    {
        calculatefields();
    });
    $("#octrio_charge").bind("change", function ()
    {
        calculatefields();
    });
    $("#octrio_charge").bind("focus", function ()
    {
        calculatefields();
    });
    $("#service_tax_value").bind("change", function ()
    {
        calculatefields();
    });
    $("#service_tax_value").bind("focus", function ()
    {
        calculatefields();
    });
</script>