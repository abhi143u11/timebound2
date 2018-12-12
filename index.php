<?php
//ob_start();
session_start();
$message = "";

include("config.ini.php");
//$show = 0 ;  // 0 = no 1 = yes

// $disclaimer = "This website disclaimer";


$cn = new mysqli(DATABASEHOST, DATABASEUSER, DATABASEPASSWORD, DATABASENAME);

if (isset($_REQUEST['login_admin'])) {

    $us = $_REQUEST['user_name'];
    $ps = md5($_REQUEST['pass_word']);

    $sel = "select * from admin where  user_name='$us' and pass_word='$ps'";
   // $sel = "select * from staff_info where  staff_name='$us' and staff_password='$ps'";
    $con = $cn->query($sel) or die($cn->error);
    
    $ft = $con->fetch_assoc();

    //$active = (int)$ft->is_active;
    if ($ft > 0) {
      
            $_SESSION['username'] = $us;
            $_SESSION['userid'] = $ft['admin_id'];
            $_SESSION['admin_type'] = $ft['admin_type'];
            $_SESSION['admin_name'] = $ft['admin_name'];
            header('location:' . $startup_app_name_admin_login);
       
    } else {
        $message = "Username and Password do not match";
    }
}


//if(isset($_SESSION['username']))
//{
//     header("location:attendees.php");
//}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $appname; ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
    
     <style>
.caja{ 
	     background-color:#E5E5E5;
		 }
.caja-a{
		 text-align:center;
		 padding-left:auto;
		 padding-right:auto;}
		 
.caja-b{
		 text-align:center;
		 padding-top:3em;
		 padding-right:auto;}
.caja-c{
		 align:center;
		
		 margin-left:auto;
		 margin-right:auto;
		 max-width:50em;
		 }
.login-box{
	margin-top:0px;
	padding-top: 0px;
	margin-top: 5em;
	margin-bottom: 5em;
	padding-bottom: 0px;
	}
	h1{
 font-size: .85em;
}
	.login-page{
        background: url(emclogin.jpg) no-repeat bottom center fixed transparent;
    height: 100%;
    width: 100%;
    background-size: cover;	 
    }
    .login-box-body, .register-box-body{
            background: rgba(255,255,255,1);
    padding: 30px 40px;
    filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#E6FFFFFF', endColorstr='#E6FFFFFF');
    z-index: 999999999;
    -webkit-box-shadow: 0 6px 6px rgba(0,0,0,0.3);
    -moz-box-shadow: 0 6px 6px rgba(0,0,0,0.3);
    box-shadow: 0 6px 6px rgba(0,0,0,0.3);
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    overflow: hidden;
    zoom: 1;
    width: 375px;
    }
	 </style>
    </head>

    <body class="login-page caja">
    <div class='caja-a'>
<div class='caja-b'>
	
   
  
		
     </div>

        <div class="login-box">
     
      <div class="login-box-body">
                         <img src="logo2.png" width="150" alt=""/>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="user_name" class="form-control" placeholder="User Name" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="pass_word" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
           
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="login_admin" id="login_admin">Sign In</button> 
            </div><!-- /.col --><a href="forgot.php">I forgot my password</a>
          </div>
        </form>
		 <?php if(isset($message)){
				 echo "<div class='text-red text-center'>$message</div>";
				 
			 }?>
			
      

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
   <div class='caja-c'>
	
   </div>
	 <footer class="footer">
        <div class="pull-right hidden-xs">
       
        </div>
          <br>    
    <b>   
        
      </footer>
</div>
</body>
</html>
