<?php class Student_Addrollno_Class extends DataBase
{
		/* Edit student roll no*/
		function Edit_Student_Addrollno(){
		foreach($_POST['stdId'] as $key=>$val){
			$column=array(
				  'stdRollNo'=>Common_Nijsol_Class::Set_Value($_POST['stdRollNo'][$key]),
				  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
				   );
			$where=" stdId='".Common_Nijsol_Class::Set_Value($_POST['stdId'][$key])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
			$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
		}
			
$column=array('tblName'=>'pgs_student',					  
'tblTitle'=>'Edit Student Roll No Information ( Standard : '.$_POST['standardAndClass'].' )',					
'editMessage'=>Common_Nijsol_Class::Set_Value($_POST['editMessage']),
'editDate'=>date("Y-m-d"),				  
'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),					  
'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID));					  					$result=$this->Insert_Row(DB_PREFIX."edit_message",$column);
	
			
		Common_Nijsol_Class::Set_Session('msg','Add student roll no successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success');
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-addrollno-manage.php');	
		}
}