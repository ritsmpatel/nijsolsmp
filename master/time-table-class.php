<?php class Time_Table_Class extends DataBase
{
		/*Add time table*/
		function Add_Time_Table(){
				
			$error = "";
			
			if(empty($_POST['StdId']))
			{
				$error.= "Please select standard name.<br>";	
			}
			
			if(empty($_POST['clsId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['ttType']))
			{
				$error.= "Please select type.<br>";	
			}
			
			else
			{
					 $column=" ttStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."' and ttClassId='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."' and ttType='".Common_Nijsol_Class::Set_Value($_POST['ttType'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					 $field = 'count(ttId) as total';
					$result=$this->Get_Rows(DB_PREFIX."time_table",$column,$field);
					
					if($result[0]['total'] > 0)	
					{
						$error.="Time table already exists.<br>";	
					}
			}
			
			if(empty($error))
			{
				$column=array(
                      'ttStandardId'=>Common_Nijsol_Class::Set_Value($_POST['StdId']),
					  'ttClassId'=>Common_Nijsol_Class::Set_Value($_POST['clsId']),
					  'ttType'=>Common_Nijsol_Class::Set_Value($_POST['ttType']),
					  'ttPhoto'=>Common_Nijsol_Class::Set_Value(Common_Nijsol_Class::Get_Session('time-table-photo')),
					  'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
					  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					  );
					  
					$result=$this->Insert_Row(DB_PREFIX."time_table",$column);
					
					if(!empty($result))	
					{	
						Common_Nijsol_Class::Set_Session('msg','Add time table successfully.');
						Common_Nijsol_Class::Set_Session('error_success','success');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-manage.php');	
					}
					else
					{
						Common_Nijsol_Class::Set_Session('msg','Invalid data');
						Common_Nijsol_Class::Set_Session('error_success','error');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-add-edit.php?mode=add');
					}
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-add-edit.php?mode=add');	
			}
		}	
		
		
		/*Edit time table*/
		function Edit_Time_Table(){
				
			$error = "";
			
			if(empty($_POST['StdId']))
			{
				$error.= "Please select standard.<br>";	
			}
			
			if(empty($_POST['clsId']))
			{
				$error.= "Please select class.<br>";	
			}
			
			if(empty($_POST['ttType']))
			{
				$error.= "Please select type.<br>";	
			}
			
			else
			{
					$column=" ttStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."' and ttClassId='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."' and ttType='".Common_Nijsol_Class::Set_Value($_POST['ttType'])."' and ttId!='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					 $field = 'count(ttId) as total';
					$result=$this->Get_Rows(DB_PREFIX."time_table",$column,$field);
					
					if($result[0]['total'] > 0)	
					{
						$error.="Time table already exists.<br>";	
					}
			}
			
			
			if(empty($error))
			{

				$column=array(
					  'ttStandardId'=>Common_Nijsol_Class::Set_Value($_POST['StdId']),
					  'ttClassId'=>Common_Nijsol_Class::Set_Value($_POST['clsId']),
					  'ttType'=>Common_Nijsol_Class::Set_Value($_POST['ttType']),
					  'ttPhoto'=>Common_Nijsol_Class::Set_Value(Common_Nijsol_Class::Get_Session('time-table-photo')),
					  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					   );
					
					$where = " ttId='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					$result=$this->Update_Row(DB_PREFIX."time_table",$column, $where);
					
					
$column=array('tblRecordId'=>Common_Nijsol_Class::Set_Value($_POST['id']),					  'tblName'=>'pgs_time_table',					  
'tblTitle'=>'Edit Time Table Information',					  
'editMessage'=>Common_Nijsol_Class::Set_Value($_POST['editMessage']),
'editDate'=>date("Y-m-d"),				  
'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),					  
'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID));					  					$result=$this->Insert_Row(DB_PREFIX."edit_message",$column);
					
					
					Common_Nijsol_Class::Set_Session('msg','Edit time table successfully.');
					Common_Nijsol_Class::Set_Session('error_success','success');
					Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-manage.php');	
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-add-edit.php?id='.$_POST['id'].'&mode=edit');	
			}
		}
}