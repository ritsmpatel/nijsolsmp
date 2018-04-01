<?php require_once "../includes/general-includes-db.php";
 require_once "time-table-class.php"; 	
 
$time_table_class= new Time_Table_Class();
if($_POST['type']=="add"){
	 	 $result=$time_table_class->Add_Time_Table();	 
	 }
	 
if($_POST['type']=="edit"){
		 $result=$time_table_class->Edit_Time_Table();	 
	 }	
?>