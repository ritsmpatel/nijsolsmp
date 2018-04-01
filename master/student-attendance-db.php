<?php require_once "../includes/general-includes-db.php";
 require_once "student-attendance-class.php"; 	
 
 
$student_attendance_class= new Student_Attendance_Class();
if($_POST['type']=="add"){
	 	 $result=$student_attendance_class->Add_Student_Attendance();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$student_attendance_class->Edit_Student_Attendance();	 
	 }	
?>