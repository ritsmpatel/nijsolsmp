<?php require_once "../includes/general-includes.php";
 require_once "login-class.php"; 	
$login= new Login();
if($_POST['type']=="login")
{
	 $result=$login->Chack_Login();	 
}
?>