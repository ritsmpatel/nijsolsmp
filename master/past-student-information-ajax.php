<?php require_once "../includes/general-includes-db.php";
class Ajax_Student_Class extends DataBase
{
		function Ajax_Remove_Student_Photo()
		{
			  $column=array('stdPhoto'=>'');
			  $where = array('stdId'=>$_GET['stdId']);	
			  $resut=$this->Update_Row(DB_PREFIX."student",$column, $where);
			  Common_Nijsol_Class::Remove_Session('student-photo');
		}
		
	   function Ajax_Select_Class()
		{
			?>
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['stdAdmissionClass']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdAdmissionStandard'])."'", "clsId"); ?>
       <?php }	
	   function Ajax_Select_Current_Class()
		{
			?>
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['stdCurrentClass']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdCurrentStandard'])."'", "clsId"); ?>
       <?php }	
}	
if($_GET['act']=="student" && $_GET['type']=="remove")
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Remove_Student_Photo();	 
}

if($_GET['act']=="class" && $_GET['type']=="select" && !empty($_GET['stdAdmissionStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Class();	 
}

if($_GET['act']=="class" && $_GET['type']=="select" && !empty($_GET['stdCurrentStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Current_Class();	 
}

?>