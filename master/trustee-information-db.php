<?php require_once "../includes/general-includes-db.php";
 require_once "trustee-information-class.php"; 	
 
 
$trustee_information_class= new Trustee_Information_Class();
if($_POST['type']=="add"){
	 	 $result=$trustee_information_class->Add_Trustee_Information();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$trustee_information_class->Edit_Trustee_Information();	 
	 }	
?>