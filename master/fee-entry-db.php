<?php require_once "../includes/general-includes-db.php";
 require_once "fee-entry-class.php"; 	
 
 
$student_fee_entry_class= new Student_Fee_Entry_Class();
if($_POST['type']=="add"){
	 	 $result=$student_fee_entry_class->Add_Student_Fee_Entry();	 
}
?>