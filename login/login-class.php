<?php class Login extends DataBase
{
		function Chack_Login()
		{
				if(!empty($_POST['usrUserName']) && (!empty($_POST['usrPassword'])))
				{
		             $column=array(
                     'usrUserName'=>Common_Nijsol_Class::Set_Value($_POST['usrUserName']),
					   'usrPassword'=>Common_Nijsol_Class::Encrypt_Data($_POST['usrPassword']),
					   'usrActive'=>1
                     );
					 
					 $field = 'usrUserName,usrPassword,usrId,usrType,usrName';
				    $resut=$this->Get_Rows(DB_PREFIX."usr",$column,$field);
					
					if(count($resut) <= 0)
					{
						Common_Nijsol_Class::Set_Session('msg','Username and password incorrect.');
						Common_Nijsol_Class::Set_Session('error_success','error');
						Common_Nijsol_Class::Redirect_To(LOGIN_URL.'index.php');
					}
					else
					{
						Common_Nijsol_Class::Set_Session(ADMIN_LOGIN_USER_ID,$resut[0]['usrId']);
						Common_Nijsol_Class::Set_Session(ADMIN_LOGIN_USER_NAME,$resut[0]['usrUserName']);
						Common_Nijsol_Class::Set_Session(ADMIN_LOGIN_USER_TYPE,$resut[0]['usrType']);
						Common_Nijsol_Class::Set_Session(ADMIN_LOGIN_USER_PROPER_NAME,$resut[0]['usrName']);
						Common_Nijsol_Class::Redirect_To(LOGIN_URL.'select-school.php');
					}
				}
				else
				{
					 Common_Nijsol_Class::Set_Session('msg','Username and password incorrect.');
					 Common_Nijsol_Class::Set_Session('error_success','error');
					 Common_Nijsol_Class::Redirect_To(LOGIN_URL.'index.php');
				}
		}	
}