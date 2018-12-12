<?php

include('xcrud/xcrud.php');

$title = "Dashboard";
$db = Xcrud_db::get_instance();
$query_patients = 'SELECT * FROM `city`';
$db->query($query_patients);
$rows_patients = $db->result();
$count_patients = count($rows_patients);



include_once 'header.php';
?>
<!-- Theme style -->
   <style type="text/css">
   @media(max-width:500px){
    
       .small-box{
           margin-bottom: 5px;
       }
       .small-box h3{
           margin:0px;
       }
   .small-box>.inner{
       padding:0px;
   }
   .small-box>.small-box-footer{
       display:none;
   }
   }
   </style>


<div class="row">

    <div class="col-md-6">

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua-active color-palette">
            <div class="inner">
                <h3><?php echo $count_patients; ?></h3>

                <p>Patients</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="patient.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua color-palette">
            <div class="inner">
                <h3><?php echo $count_patients; ?></h3>

                <p>Today's Appoinments</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="todaysapp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
        
</div>
<!-- /.row -->


</section>
<!-- /.content -->
</div>


<script src="xcrud/plugins/jquery.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>

