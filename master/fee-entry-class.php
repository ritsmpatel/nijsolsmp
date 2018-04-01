<?php class Student_Fee_Entry_Class extends DataBase
{
		/* Edit student fee entry*/
		function Add_Student_Fee_Entry()
		{
			$error = "";
			
		   if(empty($_POST['feeStandardId']))
			{
				$error.= "Please select standard.<br>";	
			}
			if(empty($_POST['feeClassId']))
			{
				$error.= "Please select class.<br>";	
			}
			if(empty($_POST['feeDate']))
			{
				$error.= "Please enter date.<br>";	
			}
			if(empty($_POST['feeStudentId']))
			{
				$error.= "Please enter student name.<br>";	
			}
			if(empty($_POST['feeTypeTermId']))
			{
				$error.= "Please select term.<br>";	
			}
			if(empty($_POST['feeTypeHeadId']))
			{
				$error.= "Please select head.<br>";	
			}
			else
			{
				 $column=" feeReceiptNo='".Common_Nijsol_Class::Set_Value($_POST['feeReceiptNo'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
				 $field = 'count(feeReceiptNo) as total';
				$result=$this->Get_Rows(DB_PREFIX."fee",$column,$field);
				
				if($result[0]['total'] > 0)	
				{
					$error.="Receipt number exists.<br>";	
				}
			}
			
			if(empty($error))
			{
			
			if(empty($_POST['feeReceiptNo']))
			{
					$feeReceiptNo=$this->Direct_Query("SELECT max(feeReceiptNo) as feeReceiptNo FROM ".DB_PREFIX."fee WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."'");
				  if(!empty($feeReceiptNo[0]['feeReceiptNo']))
						$feeReceiptNo=Common_Nijsol_Class::Get_Value($feeReceiptNo[0]['feeReceiptNo'])+1;
				  else
						$feeReceiptNo=1;
			}
			else
			{
				$feeReceiptNo=Common_Nijsol_Class::Set_Value($_POST['feeReceiptNo']);
			}
		
		$feeStandard=Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_POST['feeStandardId']));
		
		$feeClass=Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_POST['feeClassId']));
		
		$feeTypeTerm=Common_Nijsol_Class::Get_One_Name("fee_collection_type","fctType","fctId=".Common_Nijsol_Class::Get_Value($_POST['feeTypeTermId']));
		
		$feeTypeHead=Common_Nijsol_Class::Get_One_Name("organisation_name","orgLongName","orgId=".Common_Nijsol_Class::Get_Value($_POST['feeTypeHeadId']));
		
		$studentName=$this->Direct_Query("SELECT stdSurname,stdStudentName,stdFatherName FROM ".DB_PREFIX."student WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdId='".Common_Nijsol_Class::Set_Value($_POST['feeStudentId'])."'");
		
		 $feeStudentName=$studentName[0]['stdSurname']." ".$studentName[0]['stdStudentName']." ".$studentName[0]['stdFatherName'];
		
		
			
		$column=array(
			  'feeReceiptNo'=>Common_Nijsol_Class::Set_Value($feeReceiptNo),
			  'feeStandardId'=>Common_Nijsol_Class::Set_Value($_POST['feeStandardId']),
			  'feeStandard'=>Common_Nijsol_Class::Set_Value($feeStandard),
			  'feeClassId'=>Common_Nijsol_Class::Set_Value($_POST['feeClassId']),
			  'feeClass'=>Common_Nijsol_Class::Set_Value($feeClass),
			  'feeDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['feeDate']),
			  'feeTypeTermId'=>Common_Nijsol_Class::Set_Value($_POST['feeTypeTermId']),
			  'feeTypeTerm'=>Common_Nijsol_Class::Set_Value($feeTypeTerm),
			  'feeTypeHeadId'=>Common_Nijsol_Class::Set_Value($_POST['feeTypeHeadId']),
			  'feeTypeHead'=>Common_Nijsol_Class::Set_Value($feeTypeHead),
			  'feeStudentId'=>Common_Nijsol_Class::Set_Value($_POST['feeStudentId']),
			  'feeStudentName'=>Common_Nijsol_Class::Set_Value($feeStudentName),
			  'feeRemarks'=>Common_Nijsol_Class::Set_Value($_POST['feeRemarks']),
			  'feeByCheque'=>Common_Nijsol_Class::Set_Value($_POST['feeByCheque']),
			  'feeChequeNo'=>Common_Nijsol_Class::Set_Value($_POST['feeChequeNo']),
			  'feeScholarshipPercentage'=>Common_Nijsol_Class::Set_Value($_POST['feeScholarshipPercentage']),
			  'feeScholarshipAmount'=>Common_Nijsol_Class::Set_Value($_POST['feeTotalFees']-$_POST['feeTotalReceiveAmount']),
			  'feeTotalReceiveAmount'=>Common_Nijsol_Class::Set_Value($_POST['feeTotalReceiveAmount']),
			  'feeTotalFees'=>Common_Nijsol_Class::Set_Value($_POST['feeTotalFees']),
			  'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
			  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
			   );
			$resut=$this->Insert_Row(DB_PREFIX."fee",$column);
			$feeId=$resut;
			
			if(!empty($result))	
			{	
				foreach($_POST['feedFeesNameId'] as $key=>$val)
				{
					$feedFeesName=Common_Nijsol_Class::Get_One_Name("fee_name_setup","fnsName","fnsId=".Common_Nijsol_Class::Get_Value($val));
					
					$column=array(
					  'feedFeeId'=>Common_Nijsol_Class::Set_Value($feeId),
					  'feedFeesName'=>Common_Nijsol_Class::Set_Value($feedFeesName),
					  'feedFeesNameId'=>Common_Nijsol_Class::Set_Value($val),
					  'feedAmount'=>Common_Nijsol_Class::Set_Value($_POST['feedAmount'][$key]),
					  );
					
					$resut=$this->Insert_Row(DB_PREFIX."fee_details",$column);
				}
			
			
				Common_Nijsol_Class::Set_Session('msg','Add fee receipt entry successfully.');
				Common_Nijsol_Class::Set_Session('error_success','success');
			print '<script language="javascript" type="text/javascript">window.open("fee-entry-print.php?mode=print&feeReceiptNo='.$feeReceiptNo.'");</script>';
			
			print '<script language="javascript" type="text/javascript">
			document.location.replace("fee-entry.php?mode=add");
			</script>';	
			exit;
					
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg','Invalid data');
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'fee-entry.php?mode=add');
			}
			
		}
		else
		{
			Common_Nijsol_Class::Set_Session('msg',$error);
			Common_Nijsol_Class::Set_Session('error_success','error');
			Common_Nijsol_Class::Redirect_To(MASTER_URL.'fee-entry.php?mode=add');
		}
		}
}