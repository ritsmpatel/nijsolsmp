<?php require_once "../includes/general-includes-db.php";
class Ajax_Staff_Class extends DataBase
{
		function Ajax_Remove_Staff_Photo()
		{
			  $column=array('stfPhoto'=>'');
			  $where = array('stfId'=>$_GET['stfId']);	
			  $resut=$this->Update_Row(DB_PREFIX."staff",$column, $where);
			  Common_Nijsol_Class::Remove_Session('staff-photo');
		}	
}	
if($_GET['act']=="staff" && $_GET['type']=="remove")
{
	$ajax_staff_class= new Ajax_Staff_Class();
	$result=$ajax_staff_class->Ajax_Remove_Staff_Photo();	 
}?>