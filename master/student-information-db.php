<?php require_once "../includes/general-includes-db.php";
 require_once "student-information-class.php"; 	
 
$student_information_class= new Student_Information_Class();
if($_POST['type']=="add"){
	 	 $result=$student_information_class->Add_Student_Information();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$student_information_class->Edit_Student_Information();	 
	 }	
?>