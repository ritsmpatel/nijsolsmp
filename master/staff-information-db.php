<?php require_once "../includes/general-includes-db.php";
 require_once "staff-information-class.php"; 	
 
 
$staff_information_class= new Staff_Information_Class();
if($_POST['type']=="add"){
	 	 $result=$staff_information_class->Add_Staff_Information();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$staff_information_class->Edit_Staff_Information();	 
	 }	
?>