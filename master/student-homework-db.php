<?php require_once "../includes/general-includes-db.php";
 require_once "student-homework-class.php"; 	
 
 
$student_homework_class= new Student_Homework_Class();
if($_POST['type']=="add"){
	 	 $result=$student_homework_class->Add_Student_Homework();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$student_homework_class->Edit_Student_Homework();	 
	 }	
?>