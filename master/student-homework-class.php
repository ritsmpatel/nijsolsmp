<?php class Student_Homework_Class extends DataBase
{
		 /*Add student homework*/
		function Add_Student_Homework(){
				
			$error = "";
			
			if(empty($_POST['swkStudentStandardId']))
			{
				$error.= "Please select standard.<br>";	
			}
			
			if(empty($_POST['swkStudentClassId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['swkHomeworkDetails']))
			{
				$error.= "Please enter homework details.<br>";	
			}
			
			
			if(empty($error))
			{
				
				$swkStudentId="";
				foreach ($_POST['swkStudentId'] as $key=>$value) {
					$swkStudentId.=$key.",";
				}
				$swkStudentId=rtrim($swkStudentId,",");
				

		$column=array(
		'swkStudentStandardId'=>Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId']),
		'swkStudentClassId'=>Common_Nijsol_Class::Set_Value($_POST['swkStudentClassId']),
		'swkSubjectId'=>Common_Nijsol_Class::Set_Value($_POST['swkSubjectId']),
		'swkStudentId'=>Common_Nijsol_Class::Set_Value($swkStudentId),
		'swkDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['swkDate']),
		'swkHomeworkDetails'=>Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']),
		'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
		'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
		);
		$result=$this->Insert_Row(DB_PREFIX."student_homework",$column);
		
		if(!empty($result))	
		{	
		
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'homework',
			'notiSubject'=>Common_Nijsol_Class::Get_One_Name("subject","subName","subId='".Common_Nijsol_Class::Set_Value($_POST['swkSubjectId'])."' and subStandardId='".Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId'])."'"),
			'notiDesc'=>Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']),
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($swkStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['swkDate']),
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
			
			
foreach ($_POST['swkStudentId'] as $key=>$value) 
{	
	$reg_id=Common_Nijsol_Class::Get_One_Name("student","stdFcmId","stdId='".$key."'");
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]="Homework";
		$dataInner["notiSubject"]="Homework ".Common_Nijsol_Class::Get_One_Name("subject","subName","subId='".Common_Nijsol_Class::Set_Value($_POST['swkSubjectId'])."' and subStandardId='".Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId'])."'");
		$dataInner["notiDesc"]=Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']);
		$dataInner["notiDate"]=$_POST['swkDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
}
			Common_Nijsol_Class::Set_Session('msg','Add student homework details successfully.');
			Common_Nijsol_Class::Set_Session('error_success','success');
			Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-manage.php');	
		}
		else
		{
			Common_Nijsol_Class::Set_Session('msg','Invalid data');
			Common_Nijsol_Class::Set_Session('error_success','error');
			Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-add-edit.php?mode=add');
		}
	}
	else
	{
		Common_Nijsol_Class::Set_Session('msg',$error);
		Common_Nijsol_Class::Set_Session('error_success','error');
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-add-edit.php?mode=add');	
	}
}	
		
		
		 /*Edit student homework*/
		function Edit_Student_Homework(){
				
			$error = "";
			
			if(empty($_POST['swkStudentStandardId']))
			{
				$error.= "Please select standard.<br>";	
			}
			
			if(empty($_POST['swkStudentClassId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['swkHomeworkDetails']))
			{
				$error.= "Please enter homework details.<br>";	
			}
			
			
			if(empty($error))
			{
				$swkStudentId="";
				foreach ($_POST['swkStudentId'] as $key=>$value) {
					$swkStudentId.=$key.",";
				}
				$swkStudentId=rtrim($swkStudentId,",");
				
		$column=array(
		 'swkStudentStandardId'=>Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId']),
		  'swkStudentClassId'=>Common_Nijsol_Class::Set_Value($_POST['swkStudentClassId']),
		  'swkSubjectId'=>Common_Nijsol_Class::Set_Value($_POST['swkSubjectId']),
		  'swkStudentId'=>Common_Nijsol_Class::Set_Value($swkStudentId),
		  'swkDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['swkDate']),
		  'swkHomeworkDetails'=>Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']),
		  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
		   );
					
					$where = " swkId='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					$result=$this->Update_Row(DB_PREFIX."student_homework",$column, $where);
			
			
$column=array('tblRecordId'=>Common_Nijsol_Class::Set_Value($_POST['id']),					  'tblName'=>'pgs_student_homework',					  
'tblTitle'=>'Edit Student Homework Information',					  
'editMessage'=>Common_Nijsol_Class::Set_Value($_POST['editMessage']),
'editDate'=>date("Y-m-d"),				  
'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),					  
'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID));					  					$result=$this->Insert_Row(DB_PREFIX."edit_message",$column);
			
					
					
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'homework',
			'notiSubject'=>Common_Nijsol_Class::Get_One_Name("subject","subName","subId='".Common_Nijsol_Class::Set_Value($_POST['swkSubjectId'])."' and subStandardId='".Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId'])."'"),
			'notiDesc'=>Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']),
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($swkStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['swkDate']),
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
					
			
foreach ($_POST['swkStudentId'] as $key=>$value) 
{	
	$reg_id=Common_Nijsol_Class::Get_One_Name("student","stdFcmId","stdId='".$key."'");
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]="Homework";
		$dataInner["notiSubject"]="Homework ".Common_Nijsol_Class::Get_One_Name("subject","subName","subId='".Common_Nijsol_Class::Set_Value($_POST['swkSubjectId'])."' and subStandardId='".Common_Nijsol_Class::Set_Value($_POST['swkStudentStandardId'])."'");
		$dataInner["notiDesc"]=Common_Nijsol_Class::Set_Value($_POST['swkHomeworkDetails']);
		$dataInner["notiDate"]=$_POST['swkDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
}	
					
					
					Common_Nijsol_Class::Set_Session('msg','Edit student homework details successfully.');
					Common_Nijsol_Class::Set_Session('error_success','success');
					Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-manage.php');	
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-add-edit.php?id='.$_POST['id'].'&mode=edit');	
			}
		}
}