<?php require_once "../includes/general-includes-db.php";
 require_once "user-manage-class.php"; 	
 
$user_manage_class= new User_Manage_Class();
if($_POST['type']=="add"){
	 	 $result=$user_manage_class->Add_User();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$user_manage_class->Edit_User();	 
	 }	
?>