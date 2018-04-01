<?php require_once('../includes/general-includes.php'); 
class Admin_Login extends DataBase
{ 
	function All_Admin_Login()
	{
		$get_user_id = Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID);
		$get_user_name = Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_NAME);
		$check_user = $this->Check_User_Exitsindb(DB_PREFIX."usr",'usrId',$get_user_id);
		if(!empty($get_user_id) or (!empty($get_user_name)) && ($check_user == 1))
		{
			Common_Nijsol_Class::Redirect_To(LOGIN_URL.'dashboard.php');
		}
?>
<!doctype html>
<html class="no-js" lang="">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110570265-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110570265-1');
</script>

	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo SITE_NAME;?></title>
	<meta name="description" content="...">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/app.min.css">
	
	<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    
</head>
<body class="page-login">
	<div class="loginContentWrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
					<form class="form-signin" method="post" action="login-db.php">
                    <input type="hidden" name="type" value="login">
						<div class="form-group">
							<input type="email" name="usrUserName" id="usrUserName" class="form-control simple-form-control" placeholder="Email" required>
							<i class="fa fa-envelope"></i>
						</div>
						<div class="form-group">
							<input type="password" id="usrPassword" name="usrPassword" class="form-control simple-form-control" placeholder="Password" required>
							<i class="fa fa-lock"></i>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-orange submit">Log In</button>
						</div>
					</form>
					<!--<ul class="more">
						<li><a href="sign-up.html" title="#">Register</a></li>
						<li><a href="forgot-password.html" title="#">Forgotten password</a></li>
					</ul>-->
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script src="<?php echo SITE_URL;?>assets/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo SITE_URL;?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo SITE_URL;?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo SITE_URL;?>assets/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation -->
    <script src="<?php echo SITE_URL;?>assets/plugins/jquery-validation/additional-methods.min.js"></script> <!-- Form Validation Additional Methods - OPTIONAL -->
	<script src="<?php echo SITE_URL;?>js/login.js"></script>
   
	
	<div class="visible-xs visible-sm extendedChecker"></div>
<?php include("../includes/alert.php");?>   
    </body>
</html>
<?php }

}
$admin_login = new Admin_Login();	
$admin_login->All_Admin_Login();
?>