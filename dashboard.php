<?php

include('xcrud/xcrud.php');
include('class.appointment.php');
$title = "Dashboard";
$db = Xcrud_db::get_instance();
$query_patients = 'SELECT * FROM `patient_info`';
$db->query($query_patients);
$rows_patients = $db->result();
$count_patients = count($rows_patients);
$query_appointment = 'SELECT * FROM `appointment` WHERE date = CURDATE()';
$db->query($query_appointment);
$rows_appointments = $db->result();
$count_appointments= count($rows_appointments);


$appointments = new Ds_APPOINTMENT();

$app = $appointments->get_all_appointments();

include_once 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css" media="print">
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
                <h3><?php echo $count_appointments; ?></h3>

                <p>Today's Appoinments</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="todaysapp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
            <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua color-palette">
            <div class="inner">
                <h3>&nbsp;</h3>

                <p>Procedure Lists</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="procedureslist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="calendar" id="calendar"></div>
         </div><!-- /.col -->
 <!-- ./col -->
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

<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js">
</script>

<script type="text/javascript">
var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
          //defaultView: 'listDay',
           defaultView: 'listDay',
           nowIndicator: true,
           businessHours:true,
          // businessHours: true,
      header    : {
        left  : 'prev,next today',
        center: '',
        right : 'agendaDay,listDay,listWeek,listMonth'
      },
      buttonText: {
      
        listDay:"Today's Appointment",
        listWeek:'Week',
        listMonth:'Month'
        
      },
    businessHours: [ // specify an array instead
  {
    dow: [ 1, 2, 3 ,4,5], // Monday, Tuesday, Wednesday
    start: '08:00', // 8am
    end: '17:00' // 6pm
  },
  {
    dow: [ 6 ], // Thursday, Friday
    start: '09:00', // 10am
    end: '12:00' // 4pm
  }
],
      //Random default events
      events    : <?php echo $app; ?>
     
  });


</script> 