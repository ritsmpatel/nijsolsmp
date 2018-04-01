<?php require_once "../includes/general-includes-db.php";
class Ajax_Student_Suggestion extends DataBase
{
		function Ajax_Select_Taluka()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdTaluka like '%".Common_Nijsol_Class::Set_Value($_GET['stdTaluka'])."%'",'distinct stdTaluka','stdTaluka'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdTaluka']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdTaluka']);
				}
			}
			echo json_encode ($array);
		}	
		
		function Ajax_Select_City()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdCity like '%".Common_Nijsol_Class::Set_Value($_GET['stdCity'])."%'",'distinct stdCity','stdCity'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdCity']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdCity']);
				}
			}
			echo json_encode ($array);
		}
		
		function Ajax_Select_District()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdDistrict like '%".Common_Nijsol_Class::Set_Value($_GET['stdDistrict'])."%'",'distinct stdDistrict','stdDistrict'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdDistrict']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdDistrict']);
				}
			}
			echo json_encode ($array);
		}	
		
		
		function Ajax_Select_Cast()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdCast like '%".Common_Nijsol_Class::Set_Value($_GET['stdCast'])."%'",'distinct stdCast','stdCast'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdCast']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdCast']);
				}
			}
			echo json_encode ($array);
		}
		
		
		function Ajax_Select_Religion()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdReligion like '%".Common_Nijsol_Class::Set_Value($_GET['stdReligion'])."%'",'distinct stdReligion','stdReligion'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdReligion']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdReligion']);
				}
			}
			echo json_encode ($array);
		}	
		
		
		function Ajax_Select_LastSchool()
		{
			$result=$this->Get_Rows(DB_PREFIX."student","stdLastSchool like '%".Common_Nijsol_Class::Set_Value($_GET['stdLastSchool'])."%'",'distinct stdLastSchool','stdLastSchool'); 
			$array = array();	
			foreach($result as $_result)
			{ 
				if(!empty($_result['stdLastSchool']))
				{
					$array[] = Common_Nijsol_Class::Get_Value($_result['stdLastSchool']);
				}
			}
			echo json_encode ($array);
		}	
}	

if($_GET['act']=="taluka")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_Taluka();	 
}
if($_GET['act']=="city")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_City();	 
}

if($_GET['act']=="district")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_District();	 
}

if($_GET['act']=="cast")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_Cast();	 
}
if($_GET['act']=="religion")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_Religion();	 
}
if($_GET['act']=="lastSchool")
{
	$ajax_student_suggestion= new Ajax_Student_Suggestion();
	$result=$ajax_student_suggestion->Ajax_Select_LastSchool();	 
}
?>