<?php class User_Manage_Class extends DataBase
{
		 /*Add User */
		function Add_User(){
				
			$error = "";
			
			if(empty($_POST['usrName']))
			{
				$error.= "Please enter user full name.<br>";	
			}
			if(empty($_POST['usrUserName']))
			{
				$error.= "Please enter email id.<br>";	
			}
			if(empty($_POST['usrPassword']))
			{
				$error.= "Please enter password.<br>";	
			}
			if(empty($_POST['usrConfirmPassword']))
			{
				$error.= "Please enter confirm password.<br>";	
			}
			else
			{
				 $column=" usrUserName='".Common_Nijsol_Class::Set_Value($_POST['usrUserName'])."'";
				 $field = 'count(usrUserName) as total';
				$result=$this->Get_Rows(DB_PREFIX."usr",$column,$field);
				
				if($result[0]['total'] > 0)	
				{
					$error.="User already exists.<br>";	
				}
			}
			
			if(!empty($_POST['usrUserName']))
			{
				if (!filter_var($_POST['usrUserName'], FILTER_VALIDATE_EMAIL)) {
				  $error.= "Invalid email format.<br>";
				}
			}
			
			if(empty($error))
			{

				$column=array(
                      'usrName'=>Common_Nijsol_Class::Set_Value($_POST['usrName']),
					  'usrUserName'=>Common_Nijsol_Class::Set_Value($_POST['usrUserName']),
					  'usrPassword'=>Common_Nijsol_Class::Encrypt_Data($_POST['usrPassword']),
					  'usrType'=>2,
					  'usrActive'=>Common_Nijsol_Class::Set_Value($_POST['usrActive'])
					   );
					   
					$result=$this->Insert_Row(DB_PREFIX."usr",$column);
					
					if(!empty($result))	
					{
						$sql="SELECT usrId FROM ".DB_PREFIX."usr WHERE usrUserName='".Common_Nijsol_Class::Set_Value($_POST['usrUserName'])."' and usrName='".Common_Nijsol_Class::Set_Value($_POST['usrName'])."'";
						$result_usr=$this->Direct_Query($sql);
						$usrId=$result_usr[0]['usrId'];	
						
						$perStnId = $_POST['perStnIdFeild'];
						
						
			foreach ($perStnId as $key=>$value) {
				 /*echo $_POST['perStnIdFeild'][$key]."key : ".$value."<br />";*/
					 $column=array(
						'perStnId'=>Common_Nijsol_Class::Set_Value($value),
						'perUsrId'=>Common_Nijsol_Class::Set_Value($usrId),
						'perView'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perView'][$key]),
						'perAdd'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perAdd'][$key]),
						'perEdit'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perEdit'][$key]),
						'perDelete'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perDelete'][$key]),
					 );
					$result=$this->Insert_Row(DB_PREFIX."permission",$column);
			}
						
						
						
						
				$schCode = $_POST['schCodeFeild'];
						
				foreach ($schCode as $key=>$value) {
					 $column=array(
						'schCode'=>Common_Nijsol_Class::Set_Value($value),
						'usrId'=>Common_Nijsol_Class::Set_Value($usrId),
						'perView'=>Common_Nijsol_Class::Set_One_Zeero($_POST['schCode'][$key]),
						'adminUsrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID),
					 );
					 $result=$this->Insert_Row(DB_PREFIX."usr_organisation_permission",$column);
				}
						
						
						
						Common_Nijsol_Class::Set_Session('msg','Add user successfully.');
						Common_Nijsol_Class::Set_Session('error_success','success');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage.php');	
					}
					else
					{
						Common_Nijsol_Class::Set_Session('msg','Invalid data');
						Common_Nijsol_Class::Set_Session('error_success','error');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage-add-edit.php?mode=add');
					}
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage-add-edit.php?mode=add');	
			}
		}	
		
		
		 /*Edit User */
		function Edit_User(){
				
			$error = "";
			
			if(empty($_POST['usrName']))
			{
				$error.= "Please enter user full name.<br>";	
			}
			if(empty($_POST['usrUserName']))
			{
				$error.= "Please enter email id.<br>";	
			}
			else
			{
				 $column=" usrUserName='".Common_Nijsol_Class::Set_Value($_POST['usrUserName'])."' and usrId != '".Common_Nijsol_Class::Set_Value($_POST['id'])."'";
				 $field = 'count(usrUserName) as total';
				$result=$this->Get_Rows(DB_PREFIX."usr",$column,$field);
				
				
				if($result[0]['total'] > 0)	
				{
					$error.="User already exists.<br>";	
				}
			}
			
			if(!empty($_POST['usrUserName']))
			{
				if (!filter_var($_POST['usrUserName'], FILTER_VALIDATE_EMAIL)) {
				  $error.= "Invalid email format.<br>";
				}
			}
			if(empty($error))
			{
				
				if(empty($_POST['usrPassword']))
				{
					$error.= "Please enter password.<br>";	
				}
				if(empty($_POST['usrConfirmPassword']))
				{
					$error.= "Please enter confirm password.<br>";	
				}
				
				$column=array(
				  'usrName'=>Common_Nijsol_Class::Set_Value($_POST['usrName']),
				  'usrUserName'=>Common_Nijsol_Class::Set_Value($_POST['usrUserName']),
				  'usrType'=>2,
				  'usrActive'=>Common_Nijsol_Class::Set_Value($_POST['usrActive'])
				);
					   
				   if(!empty($_POST['usrPassword']))
				    {
						$column['usrPassword'] = Common_Nijsol_Class::Encrypt_Data($_POST['usrPassword']);
					}
				   
					$where = array(
						'usrId'=>$_POST['id']
					);	
					
					$result=$this->Update_Row(DB_PREFIX."usr",$column, $where);
					
					if(!empty($_POST['id']))	
					{
						$where = array(
								'perUsrId'=>$_POST['id']
						);
						$result=$this->Delete_Row(DB_PREFIX."permission", $where);
						
						
						$usrId=Common_Nijsol_Class::Set_Value($_POST['id']);
						$perStnId = $_POST['perStnIdFeild'];
						
						foreach ($perStnId as $key=>$value) {
							 /*echo $_POST['perStnIdFeild'][$key]."key : ".$value."<br />";*/
							 $column=array(
								'perStnId'=>Common_Nijsol_Class::Set_Value($value),
								'perUsrId'=>Common_Nijsol_Class::Set_Value($usrId),
								'perView'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perView'][$key]),
						'perAdd'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perAdd'][$key]),
						'perEdit'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perEdit'][$key]),
						'perDelete'=>Common_Nijsol_Class::Set_One_Zeero($_POST['perDelete'][$key]),
							 );
							 $result=$this->Insert_Row(DB_PREFIX."permission",$column);
						}
						
						
					$where = array(
							'usrId'=>$_POST['id']
					);
					$result=$this->Delete_Row(DB_PREFIX."usr_organisation_permission", $where);
						
						
						$usrId=Common_Nijsol_Class::Set_Value($_POST['id']);
						$schCode = $_POST['schCodeFeild'];
						
				foreach ($schCode as $key=>$value) {
					 $column=array(
						'schCode'=>Common_Nijsol_Class::Set_Value($value),
						'usrId'=>Common_Nijsol_Class::Set_Value($usrId),
						'perView'=>Common_Nijsol_Class::Set_One_Zeero($_POST['schCode'][$key]),
						'adminUsrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID),
					 );
					 $result=$this->Insert_Row(DB_PREFIX."usr_organisation_permission",$column);
				}
						
						
						Common_Nijsol_Class::Set_Session('msg','Edit user successfully.');
						Common_Nijsol_Class::Set_Session('error_success','success');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage.php');	
					}
					
					else
					{
						Common_Nijsol_Class::Set_Session('msg','Invalid data');
						Common_Nijsol_Class::Set_Session('error_success','error');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage-add-edit.php?id='.$_POST['id'].'&mode=edit');
					}
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage-add-edit.php?id='.$_POST['id'].'&mode=edit');	
			}
		}
}