<?php class Student_Attendance_Class extends DataBase
{
		/*Add student attendance*/
		function Add_Student_Attendance(){
				
			$error = "";
			
			if(empty($_POST['stndStudentStandardId']))
			{
				$error.= "Please select standard.<br>";	
			}
			
			if(empty($_POST['stndStudentClassId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['stndDate']))
			{
				$error.= "Please enter date.<br>";	
			}
			else
			{
				 $column=" stndDate='".Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate'])."' and stndStudentStandardId='".Common_Nijsol_Class::Set_Value($_POST['stndStudentStandardId'])."' and stndStudentClassId='".Common_Nijsol_Class::Set_Value($_POST['stndStudentClassId'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
				 $field = 'count(stndId) as total';
				$result=$this->Get_Rows(DB_PREFIX."student_attendance",$column,$field);
				
				if($result[0]['total'] > 0)	
				{
					$error.="Attendance already exists.<br>";	
				}
			}
			
			
			if(empty($error))
			{
				
	$column=array(
	'stndStudentStandardId'=>Common_Nijsol_Class::Set_Value($_POST['stndStudentStandardId']),
	'stndStudentClassId'=>Common_Nijsol_Class::Set_Value($_POST['stndStudentClassId']),
	'stndDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
	'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
	'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					  );
	$result=$this->Insert_Row(DB_PREFIX."student_attendance",$column);
	$sadStndId=$result;		
					
				$sadStudentIdChecked="";
				foreach ($_POST['stndStudentId'] as $key=>$value) {
					$sadStudentIdChecked.=$key.",";
				}
				$sadStudentIdChecked=rtrim($sadStudentIdChecked,",");
				$sadStudentIdChecked=explode(",", $sadStudentIdChecked);
				
				$stndTotalStudent=0;
				$stndPresentStudent=0;
				$stndAbsentStudent=0;
				
				
				$allPresentStudentId="";
				$allAbsentStudentId="";
				
				foreach ($_POST['stndStudentCountId'] as $key=>$value) 
				{
					$sadStudentId=$value;
					$sadPresent=0;
					if(in_array($sadStudentId,$sadStudentIdChecked))
					{
						$sadPresent=1;
						$stndPresentStudent++;
						
						$allPresentStudentId.=$value.",";
					}
					else
					{
						$stndAbsentStudent++;
						$allAbsentStudentId.=$value.",";
					}
					$stndTotalStudent++;
					
					$column=array(
					'sadStndId'=>Common_Nijsol_Class::Set_Value($sadStndId),
					'sadStudentId'=>Common_Nijsol_Class::Set_Value($sadStudentId),
					'sadPresent'=>$sadPresent
					  );
					  
					$result=$this->Insert_Row(DB_PREFIX."student_attendance_details",$column);
				}
				
				$allPresentStudentId=rtrim($allPresentStudentId,",");
				$allAbsentStudentId=rtrim($allAbsentStudentId,",");
					
				
	$column=array(
	'stndTotalStudent'=>$stndTotalStudent,
	'stndPresentStudent'=>$stndPresentStudent,
	'stndAbsentStudent'=>$stndAbsentStudent
	);
	$where = " stndId='".$sadStndId."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
	$result=$this->Update_Row(DB_PREFIX."student_attendance",$column, $where);
					
		
		
		if(!empty($allPresentStudentId))
		{
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'attendance',
			'notiSubject'=>'attendance',
			'notiDesc'=>'Present',
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($allPresentStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
			'notiPresentAbsent'=>'P',
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
			
			$allPStud=explode(",",$allPresentStudentId);
			for($i=0;$i<count($allPStud);$i++)
			{
				$stud=$this->Direct_Query("SELECT stdMobileNo,stdSurname,stdStudentName,stdFatherName,stdFcmId FROM ".DB_PREFIX."student WHERE stdId=".$allPStud[$i]); 
				
			 $studentName=Common_Nijsol_Class::Get_Value($stud[0]['stdSurname'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdFatherName']);		
		/*if(!empty($stud[0]['stdMobileNo']))
		{		
			Common_Nijsol_Class::Send_SMS($studentName,$stud[0]['stdMobileNo'],"","","attendance","P");
		}*/
		
		
		
	$reg_id=$stud[0]['stdFcmId'];
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]=ucwords("attendance");
		$dataInner["notiSubject"]=ucwords("attendance");
		$dataInner["notiDesc"]=$studentName." is present";
		$dataInner["notiDate"]=$_POST['stndDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
						
			}
		}
		if(!empty($allAbsentStudentId))
		{
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'attendance',
			'notiSubject'=>'attendance',
			'notiDesc'=>'Absent',
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($allAbsentStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
			'notiPresentAbsent'=>'A',
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
			
			$allAStud=explode(",",$allAbsentStudentId);
			for($i=0;$i<count($allAStud);$i++)
			{
				$stud=$this->Direct_Query("SELECT stdMobileNo,stdSurname,stdStudentName,stdFatherName,stdFcmId FROM ".DB_PREFIX."student WHERE stdId=".$allAStud[$i]); 
				
			 $studentName=Common_Nijsol_Class::Get_Value($stud[0]['stdSurname'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdFatherName']);		
		/* if(!empty($stud[0]['stdMobileNo']))
		{		
			Common_Nijsol_Class::Send_SMS($studentName,$stud[0]['stdMobileNo'],"","","attendance","A");
		}*/
				
			$reg_id=$stud[0]['stdFcmId'];
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]=ucwords("attendance");
		$dataInner["notiSubject"]=ucwords("attendance");
		$dataInner["notiDesc"]=$studentName." is absent";
		$dataInner["notiDate"]=$_POST['stndDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
				
			}
			
		}
				
		Common_Nijsol_Class::Set_Session('msg','Add student attendance details successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success');
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-attendance-manage.php');	
					
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-attendance-add-edit.php?mode=add');	
			}
		}	
		
		
		/*Edit student attendance*/
		function Edit_Student_Attendance(){
				
			$error = "";
			
			if(empty($_POST['stndStudentStandardId']))
			{
				$error.= "Please select standard.<br>";	
			}
			
			if(empty($_POST['stndStudentClassId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['stndDate']))
			{
				$error.= "Please enter date.<br>";	
			}
			else
			{
				$column=" stndDate='".Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate'])."' and stndStudentStandardId='".Common_Nijsol_Class::Set_Value($_POST['stndStudentStandardId'])."' and stndStudentClassId='".Common_Nijsol_Class::Set_Value($_POST['stndStudentClassId'])."' and stndId!='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
				 $field = 'count(stndId) as total';
				$result=$this->Get_Rows(DB_PREFIX."student_attendance",$column,$field);
				
				if($result[0]['total'] > 0)	
				{
					$error.="Attendance already exists.<br>";	
				}	
			}
			
			if(empty($error))
			{
				$stndStudentId="";
				foreach ($_POST['stndStudentId'] as $key=>$value) {
					$stndStudentId.=$key.",";
				}
				$stndStudentId=rtrim($stndStudentId,",");
				
				$column=array(
	'stndStudentStandardId'=>Common_Nijsol_Class::Set_Value($_POST['stndStudentStandardId']),
	'stndStudentClassId'=>Common_Nijsol_Class::Set_Value($_POST['stndStudentClassId']),
	'stndDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
	'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
	'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					  );
					
					$where = " stndId='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					$result=$this->Update_Row(DB_PREFIX."student_attendance",$column, $where);
					
					
		$where = array(
				'sadStndId'=>Common_Nijsol_Class::Set_Value($_POST['id'])
		);
		$result=$this->Delete_Row(DB_PREFIX."student_attendance_details", $where);
				
					$sadStudentIdChecked="";
				foreach ($_POST['stndStudentId'] as $key=>$value) {
					$sadStudentIdChecked.=$key.",";
				}
				$sadStudentIdChecked=rtrim($sadStudentIdChecked,",");
				$sadStudentIdChecked=explode(",", $sadStudentIdChecked);
				
				$stndTotalStudent=0;
				$stndPresentStudent=0;
				$stndAbsentStudent=0;
				
				
				$allPresentStudentId="";
				$allAbsentStudentId="";
				
				foreach ($_POST['stndStudentCountId'] as $key=>$value) 
				{
					$sadStudentId=$value;
					$sadPresent=0;
					if(in_array($sadStudentId,$sadStudentIdChecked))
					{
						$sadPresent=1;
						$stndPresentStudent++;
						
						$allPresentStudentId.=$value.",";
					}
					else
					{
						$stndAbsentStudent++;
						$allAbsentStudentId.=$value.",";
					}
					$stndTotalStudent++;
					
					$column=array(
					'sadStndId'=>Common_Nijsol_Class::Set_Value($_POST['id']),
					'sadStudentId'=>Common_Nijsol_Class::Set_Value($sadStudentId),
					'sadPresent'=>$sadPresent
					  );
					  
					$result=$this->Insert_Row(DB_PREFIX."student_attendance_details",$column);
				}
				
				$allPresentStudentId=rtrim($allPresentStudentId,",");
				$allAbsentStudentId=rtrim($allAbsentStudentId,",");
				
	$column=array(
	'stndTotalStudent'=>$stndTotalStudent,
	'stndPresentStudent'=>$stndPresentStudent,
	'stndAbsentStudent'=>$stndAbsentStudent
	);
	$where = " stndId='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
	$result=$this->Update_Row(DB_PREFIX."student_attendance",$column, $where);
		
		
		if(!empty($allPresentStudentId))
		{
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'attendance',
			'notiSubject'=>'attendance',
			'notiDesc'=>'Present',
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($allPresentStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
			'notiPresentAbsent'=>'P',
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
			
			$allPStud=explode(",",$allPresentStudentId);
			for($i=0;$i<count($allPStud);$i++)
			{
				$stud=$this->Direct_Query("SELECT stdMobileNo,stdSurname,stdStudentName,stdFatherName,stdFcmId FROM ".DB_PREFIX."student WHERE stdId=".$allPStud[$i]); 
				
				 $studentName=Common_Nijsol_Class::Get_Value($stud[0]['stdSurname'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdFatherName']);		
		/* if(!empty($stud[0]['stdMobileNo']))
		{		
			Common_Nijsol_Class::Send_SMS($studentName,$stud[0]['stdMobileNo'],"","","attendance","P");
		}*/
		
		
		
	$reg_id=$stud[0]['stdFcmId'];
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]=ucwords("attendance");
		$dataInner["notiSubject"]=ucwords("attendance");
		$dataInner["notiDesc"]=$studentName." is present";
		$dataInner["notiDate"]=$_POST['stndDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
						
			}
		}
		if(!empty($allAbsentStudentId))
		{
			$column=array(
			'notiUse'=>'student',
			'notiType'=>'attendance',
			'notiSubject'=>'attendance',
			'notiDesc'=>'Absent',
			'notiStudentId'=>Common_Nijsol_Class::Set_Value($allAbsentStudentId),
			'notiSendType'=>'notification',
			'notiDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stndDate']),
			'notiPresentAbsent'=>'A',
			'notiSendById'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			);
			$result=$this->Insert_Row(DB_PREFIX."notification",$column);
			
			$allAStud=explode(",",$allAbsentStudentId);
			for($i=0;$i<count($allAStud);$i++)
			{
				$stud=$this->Direct_Query("SELECT stdMobileNo,stdSurname,stdStudentName,stdFatherName,stdFcmId FROM ".DB_PREFIX."student WHERE stdId=".$allAStud[$i]); 
				
				 $studentName=Common_Nijsol_Class::Get_Value($stud[0]['stdSurname'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($stud[0]['stdFatherName']);		
		/*if(!empty($stud[0]['stdMobileNo']))
		{		
			Common_Nijsol_Class::Send_SMS($studentName,$stud[0]['stdMobileNo'],"","","attendance","A");
		}*/
				
			$reg_id=$stud[0]['stdFcmId'];
	if(!empty($reg_id))
	{			
		$dataInner=array();
		$dataInner["notiId"]=$result;
		$dataInner["notiType"]=ucwords("attendance");
		$dataInner["notiSubject"]=ucwords("attendance");
		$dataInner["notiDesc"]=$studentName." is absent";
		$dataInner["notiDate"]=$_POST['stndDate'];
		$msg = $dataInner;
	
		Common_Nijsol_Class::send_gcm_notify($reg_id, $msg);			
	}
				
			}
			
		}
		
		
$column=array('tblRecordId'=>Common_Nijsol_Class::Set_Value($_POST['id']),
'tblName'=>'pgs_student_attendance',					  
'tblTitle'=>'Edit Student Attendance Information',					
'editMessage'=>Common_Nijsol_Class::Set_Value($_POST['editMessage']),
'editDate'=>date("Y-m-d"),				  
'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),					  
'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID));					  					$result=$this->Insert_Row(DB_PREFIX."edit_message",$column);

		
					
					Common_Nijsol_Class::Set_Session('msg','Edit student attendance details successfully.');
					Common_Nijsol_Class::Set_Session('error_success','success');
					Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-attendance-manage.php');	
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-attendance-add-edit.php?id='.$_POST['id'].'&mode=edit');	
			}
		}
}