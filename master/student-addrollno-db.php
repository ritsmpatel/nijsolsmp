<?php require_once "../includes/general-includes-db.php";
 require_once "student-addrollno-class.php"; 	
 
 
$student_addrollno_class= new Student_Addrollno_Class();
if($_POST['type']=="edit"){
	 	 $result=$student_addrollno_class->Edit_Student_Addrollno();	 
}
?>