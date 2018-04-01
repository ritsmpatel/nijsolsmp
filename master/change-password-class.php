<?php class Change_Password_Class extends DataBase
{
	function Edit_Change_Password()
		{
			$error = "";
			
			if(empty($_POST['usrOldPassword']))
			{
				$error.= "Please enter old password.<br>";	
			}
			if(empty($_POST['usrPassword']))
			{
				$error.= "Please enter new password.<br>";	
			}
			if(empty($_POST['usrConfirmPassword']))
			{
				$error.= "Please enter confirm new password.<br>";	
			}
		
			$result=$this->Direct_Query("SELECT usrPassword FROM ".DB_PREFIX."usr WHERE usrId='".Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)."'");
			if(Common_Nijsol_Class::Decrypt_Data($result[0]['usrPassword']) != $_POST['usrOldPassword'])
			{
				$error.= "Please enter proper old password.<br>";	
			}
			
				
			if(empty($error))
			{
				$column=array(
				  'usrPassword'=>Common_Nijsol_Class::Encrypt_Data($_POST['usrPassword'])
				);
					
					$where = array(
						'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					);	
					
					$result=$this->Update_Row(DB_PREFIX."usr",$column, $where);
					Common_Nijsol_Class::Set_Session('msg','Change password successfully.');
					Common_Nijsol_Class::Set_Session('error_success','success');
					Common_Nijsol_Class::Redirect_To(MASTER_URL.'change-password.php?mode=edit');	
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'change-password.php?mode=edit');	
			}
		}
}