<?php require_once "../includes/general-includes-db.php";
 require_once "past-student-information-class.php"; 	
 
$past_student_information_class= new Past_Student_Information_Class();
if($_POST['type']=="add"){
	 	 $result=$past_student_information_class->Add_Past_Student_Information();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$past_student_information_class->Edit_Past_Student_Information();	 
	 }	
?>