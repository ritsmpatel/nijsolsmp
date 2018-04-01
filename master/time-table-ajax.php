<?php require_once "../includes/general-includes-db.php";
class Ajax_Time_Table_Class extends DataBase
{
		function Ajax_Remove_Time_Table_Photo()
		{
			  $column=array('ttPhoto'=>'');
			  $where = array('ttId'=>$_GET['ttId']);	
			  $resut=$this->Update_Row(DB_PREFIX."time_table",$column, $where);
			  Common_Nijsol_Class::Remove_Session('time-table-photo');
		}
}	
if($_GET['act']=="time_table" && $_GET['type']=="remove")
{
	$ajax_time_table_class= new Ajax_Time_Table_Class();
	$result=$ajax_time_table_class->Ajax_Remove_Time_Table_Photo();	 
}
?>