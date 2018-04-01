<?php require_once "../includes/general-includes-db.php";
require_once "change-password-class.php"; 	
 
$change_password_class= new Change_Password_Class();

if($_POST['type']=="edit"){
		 $result=$change_password_class->Edit_Change_Password();	 
	 }	
?>