<?php class Student_Information_Class extends DataBase
{
		 /*Add Student information*/
		function Add_Student_Information(){
				
			$error = "";
			
			if(empty($_POST['stdGrNo']))
			{
				$error.= "Please enter GR No.<br>";	
			}
			if(empty($_POST['stdSurname']))
			{
				$error.= "Please enter surname.<br>";	
			}
			if(empty($_POST['stdStudentName']))
			{
				$error.= "Please enter student name.<br>";	
			}
			if(empty($_POST['stdFatherName']))
			{
				$error.= "Please enter father name.<br>";	
			}
			if(empty($_POST['stdAddress']))
			{
				$error.= "Please enter address.<br>";	
			}
			if(empty($_POST['stdDistrict']))
			{
				$error.= "Please enter district name.<br>";	
			}
			if(empty($_POST['stdGender']))
			{
				$error.= "Please select gender.<br>";	
			}
			if(empty($_POST['stdBirthDate']))
			{
				$error.= "Please select birth date.<br>";	
			}
			if(empty($_POST['stdBirthPlace']))
			{
				$error.= "Please enter birth place.<br>";	
			}
			if(empty($_POST['stdCast']))
			{
				$error.= "Please enter cast.<br>";	
			}
			if(empty($_POST['stdReligion']))
			{
				$error.= "Please enter religion.<br>";	
			}
			if(empty($_POST['stdCategory']))
			{
				$error.= "Please select category.<br>";	
			}
			if(empty($_POST['stdAdmissionStandard']))
			{
				$error.= "Please select admission standard.<br>";	
			}
			if(empty($_POST['stdAdmissionClass']))
			{
				$error.= "Please select admission class.<br>";	
			}
			if(empty($_POST['stdCurrentStandard']))
			{
				$error.= "Please select current standard.<br>";	
			}
			if(empty($_POST['stdCurrentClass']))
			{
				$error.= "Please select current class.<br>";	
			}
			if(empty($_POST['stdLastSchool']))
			{
				$error.= "Please enter last school.<br>";	
			}
			if(empty($_POST['stdFeeInPercentage']))
			{
				$error.= "Please enter fee in percentage.<br>";	
			}
			if(empty($_POST['stdFeeCategory']))
			{
				$error.= "Please select fee category.<br>";	
			}
			else
			{
					 $column=" stdGrNo='".Common_Nijsol_Class::Set_Value($_POST['stdGrNo'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					 $field = 'count(stdGrNo) as total';
					$result=$this->Get_Rows(DB_PREFIX."student",$column,$field);
					
					if($result[0]['total'] > 0)	
					{
						$error.="GR number already exists.<br>";	
					}
			}
			
			
			if(!empty($_POST['stdEmail']))
			{
				if (!filter_var($_POST['stdEmail'], FILTER_VALIDATE_EMAIL)) {
				  $error.= "Invalid email format.<br>";
				}
			}
			
			$stdCompulsarySubject="";
			foreach ($_POST['stdCompulsarySubject'] as $key=>$value) {
				$stdCompulsarySubject.=$key.",";
			}
			$stdCompulsarySubject=rtrim($stdCompulsarySubject,",");
			
			$stdGroupedSubject="";
			foreach ($_POST['stdGroupedSubject'] as $key=>$value) {
				$stdGroupedSubject.=$key.",";
			}
			$stdGroupedSubject=rtrim($stdGroupedSubject,",");
			
			$stdOptionalSubject="";
			foreach ($_POST['stdOptionalSubject'] as $key=>$value) {
				$stdOptionalSubject.=$key.",";
			}
			$stdOptionalSubject=rtrim($stdOptionalSubject,",");
			
			
			
			$stdValidFeeCollection="";
			foreach ($_POST['stdValidFeeCollection'] as $key=>$value) {
				$stdValidFeeCollection.=$key.",";
			}
			$stdValidFeeCollection=rtrim($stdValidFeeCollection,",");
			
			$stdValidFeeHead="";
			foreach ($_POST['stdValidFeeHead'] as $key=>$value) {
				$stdValidFeeHead.=$key.",";
			}
			$stdValidFeeHead=rtrim($stdValidFeeHead,",");
			
			
			
			if(empty($error))
			{

				$column=array(
                      'stdGrNo'=>Common_Nijsol_Class::Set_Value($_POST['stdGrNo']),
					  'stdSurname'=>Common_Nijsol_Class::Set_Value($_POST['stdSurname']),
					  'stdStudentName'=>Common_Nijsol_Class::Set_Value($_POST['stdStudentName']),
					  'stdFatherName'=>Common_Nijsol_Class::Set_Value($_POST['stdFatherName']),
					  'stdMotherName'=>Common_Nijsol_Class::Set_Value($_POST['stdMotherName']),
					  'stdAddress'=>Common_Nijsol_Class::Set_Value($_POST['stdAddress']),
					  'stdTaluka'=>Common_Nijsol_Class::Set_Value($_POST['stdTaluka']),
					  'stdDistrict'=>Common_Nijsol_Class::Set_Value($_POST['stdDistrict']),
					  'stdCity'=>Common_Nijsol_Class::Set_Value($_POST['stdCity']),
					  'stdPinCode'=>Common_Nijsol_Class::Set_Value($_POST['stdPinCode']),
					  'stdGender'=>Common_Nijsol_Class::Set_Value($_POST['stdGender']),
					  'stdBloodGroup'=>Common_Nijsol_Class::Set_Value($_POST['stdBloodGroup']),
					  'stdOfficeNo'=>Common_Nijsol_Class::Set_Value($_POST['stdOfficeNo']),
					  'stdMobileNo'=>Common_Nijsol_Class::Set_Value($_POST['stdMobileNo']),
					  'stdHomeNo'=>Common_Nijsol_Class::Set_Value($_POST['stdHomeNo']),
					  'stdFatherOccupation'=>Common_Nijsol_Class::Set_Value($_POST['stdFatherOccupation']),
					  'stdMotherOccupation'=>Common_Nijsol_Class::Set_Value($_POST['stdMotherOccupation']),
					  'stdBirthDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdBirthDate']),
					  'stdBirthPlace'=>Common_Nijsol_Class::Set_Value($_POST['stdBirthPlace']),
					  'stdCast'=>Common_Nijsol_Class::Set_Value($_POST['stdCast']),
					  'stdReligion'=>Common_Nijsol_Class::Set_Value($_POST['stdReligion']),
					  'stdCategory'=>Common_Nijsol_Class::Set_Value($_POST['stdCategory']),
					  'stdEtc'=>Common_Nijsol_Class::Set_Value($_POST['stdEtc']),
					  'stdAdmissionStandard'=>Common_Nijsol_Class::Set_Value($_POST['stdAdmissionStandard']),
					  'stdAdmissionClass'=>Common_Nijsol_Class::Set_Value($_POST['stdAdmissionClass']),
					  'stdCurrentStandard'=>Common_Nijsol_Class::Set_Value($_POST['stdCurrentStandard']),
					  'stdCurrentClass'=>Common_Nijsol_Class::Set_Value($_POST['stdCurrentClass']),
					  'stdAdmissionDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdAdmissionDate']),
					  'stdRollNo'=>Common_Nijsol_Class::Set_Value($_POST['stdRollNo']),
					  'stdLastSchool'=>Common_Nijsol_Class::Set_Value($_POST['stdLastSchool']),
					  'stdRegNo'=>Common_Nijsol_Class::Set_Value($_POST['stdRegNo']),
					  'stdRegDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdRegDate']),
					  'stdCompulsarySubject'=>Common_Nijsol_Class::Set_Value($stdCompulsarySubject),
					  'stdGroupedSubject'=>Common_Nijsol_Class::Set_Value($stdGroupedSubject),
					  'stdOptionalSubject'=>Common_Nijsol_Class::Set_Value($stdOptionalSubject),
					  'stdReferenceName'=>Common_Nijsol_Class::Set_Value($_POST['stdReferenceName']),
					  'stdReferenceNumber'=>Common_Nijsol_Class::Set_Value($_POST['stdReferenceNumber']),
					  'stdUniqueId'=>Common_Nijsol_Class::Set_Value($_POST['stdUniqueId']),
					  'stdAadhaarId'=>Common_Nijsol_Class::Set_Value($_POST['stdAadhaarId']),
					  'stdPhysicalHandicap'=>Common_Nijsol_Class::Set_Value($_POST['stdPhysicalHandicap']),
					  'stdNative'=>Common_Nijsol_Class::Set_Value($_POST['stdNative']),
					  'stdNationality'=>Common_Nijsol_Class::Set_Value($_POST['stdNationality']),
					  'stdRemarks'=>Common_Nijsol_Class::Set_Value($_POST['stdRemarks']),
					  'stdEmail'=>Common_Nijsol_Class::Email_Checking($_POST['stdEmail']),
					  'stdPrevPresents'=>Common_Nijsol_Class::Set_Value($_POST['stdPrevPresents']),
					  'stdPrevWorkingDays'=>Common_Nijsol_Class::Set_Value($_POST['stdPrevWorkingDays']),
					  'stdIsHosteller'=>Common_Nijsol_Class::Set_Value($_POST['stdIsHosteller']),
					  'stdPhoto'=>Common_Nijsol_Class::Set_Value(Common_Nijsol_Class::Get_Session('student-photo')),
					  'stdFeeInPercentage'=>Common_Nijsol_Class::Set_Value($_POST['stdFeeInPercentage']),
					  'stdFeeCategory'=>Common_Nijsol_Class::Set_Value($_POST['stdFeeCategory']),
					  'stdValidFeeCollection'=>Common_Nijsol_Class::Set_Value($stdValidFeeCollection),
					  'stdValidFeeHead'=>Common_Nijsol_Class::Set_Value($stdValidFeeHead),
					  'stdReasonFeeException'=>Common_Nijsol_Class::Set_Value($_POST['stdReasonFeeException']),
					  'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
					  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					  );
					  
					$result=$this->Insert_Row(DB_PREFIX."student",$column);
					
					if(!empty($result))	
					{
						
$stdUid=SITE_NAME.$result;	
$stdPass=mt_rand();
		
$column=array(
  'stdUid'=>Common_Nijsol_Class::Set_Value($stdUid),
  'stdPass'=>Common_Nijsol_Class::Set_Value($stdPass)
 );
$where = " stdId='".$result."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
	
	
/*$studentName=Common_Nijsol_Class::Set_Value($_POST['stdSurname'])." ".Common_Nijsol_Class::Set_Value($_POST['stdStudentName'])." ".Common_Nijsol_Class::Set_Value($_POST['stdFatherName']);				  	
$mobileNo=Common_Nijsol_Class::Set_Value($_POST['stdMobileNo']);	
Common_Nijsol_Class::Send_SMS($studentName,$mobileNo,$stdUid,$stdPass,"student_information","");*/
						
							
				Common_Nijsol_Class::Set_Session('msg','Add student information successfully.');
				Common_Nijsol_Class::Set_Session('error_success','success');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-manage.php');	
					}
					else
					{
						Common_Nijsol_Class::Set_Session('msg','Invalid data');
						Common_Nijsol_Class::Set_Session('error_success','error');
						Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-add-edit.php?mode=add');
					}
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-add-edit.php?mode=add');	
			}
		}	
		
		
		 /*Edit student information*/
		function Edit_Student_Information(){
				
			$error = "";
			
			if(empty($_POST['stdGrNo']))
			{
				$error.= "Please enter GR No.<br>";	
			}
			if(empty($_POST['stdSurname']))
			{
				$error.= "Please enter surname.<br>";	
			}
			if(empty($_POST['stdStudentName']))
			{
				$error.= "Please enter student name.<br>";	
			}
			if(empty($_POST['stdFatherName']))
			{
				$error.= "Please enter father name.<br>";	
			}
			if(empty($_POST['stdAddress']))
			{
				$error.= "Please enter address.<br>";	
			}
			if(empty($_POST['stdDistrict']))
			{
				$error.= "Please enter district name.<br>";	
			}
			if(empty($_POST['stdGender']))
			{
				$error.= "Please select gender.<br>";	
			}
			if(empty($_POST['stdBirthDate']))
			{
				$error.= "Please select birth date.<br>";	
			}
			if(empty($_POST['stdBirthPlace']))
			{
				$error.= "Please enter birth place.<br>";	
			}
			if(empty($_POST['stdCast']))
			{
				$error.= "Please enter cast.<br>";	
			}
			if(empty($_POST['stdReligion']))
			{
				$error.= "Please enter religion.<br>";	
			}
			if(empty($_POST['stdCategory']))
			{
				$error.= "Please select category.<br>";	
			}
			if(empty($_POST['stdAdmissionStandard']))
			{
				$error.= "Please select admission standard.<br>";	
			}
			if(empty($_POST['stdAdmissionClass']))
			{
				$error.= "Please select admission class.<br>";	
			}
			if(empty($_POST['stdCurrentStandard']))
			{
				$error.= "Please select current standard.<br>";	
			}
			if(empty($_POST['stdCurrentClass']))
			{
				$error.= "Please select current class.<br>";	
			}
			if(empty($_POST['stdFeeInPercentage']))
			{
				$error.= "Please enter fee in percentage.<br>";	
			}
			if(empty($_POST['stdFeeCategory']))
			{
				$error.= "Please select fee category.<br>";	
			}
			else
			{
					$column=" stdGrNo='".Common_Nijsol_Class::Set_Value($_POST['stdGrNo'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdId!='".Common_Nijsol_Class::Set_Value($_POST['id'])."'";
					$field = 'count(stdGrNo) as total';
					$result=$this->Get_Rows(DB_PREFIX."student",$column,$field);
					
					if($result[0]['total'] > 0)	
					{
						$error.="GR number already exists.<br>";	
					}
			}
			
			
			if(!empty($_POST['stdEmail']))
			{
				if (!filter_var($_POST['stdEmail'], FILTER_VALIDATE_EMAIL)) {
				  $error.= "Invalid email format.<br>";
				}
			}
			
			$stdCompulsarySubject="";
			foreach ($_POST['stdCompulsarySubject'] as $key=>$value) {
				$stdCompulsarySubject.=$key.",";
			}
			$stdCompulsarySubject=rtrim($stdCompulsarySubject,",");
			
			$stdGroupedSubject="";
			foreach ($_POST['stdGroupedSubject'] as $key=>$value) {
				$stdGroupedSubject.=$key.",";
			}
			$stdGroupedSubject=rtrim($stdGroupedSubject,",");
			
			$stdOptionalSubject="";
			foreach ($_POST['stdOptionalSubject'] as $key=>$value) {
				$stdOptionalSubject.=$key.",";
			}
			$stdOptionalSubject=rtrim($stdOptionalSubject,",");
			
			$stdValidFeeCollection="";
			foreach ($_POST['stdValidFeeCollection'] as $key=>$value) {
				$stdValidFeeCollection.=$key.",";
			}
			$stdValidFeeCollection=rtrim($stdValidFeeCollection,",");
			
			$stdValidFeeHead="";
			foreach ($_POST['stdValidFeeHead'] as $key=>$value) {
				$stdValidFeeHead.=$key.",";
			}
			$stdValidFeeHead=rtrim($stdValidFeeHead,",");
			
			if(empty($error))
			{

				$column=array(
					  'stdGrNo'=>Common_Nijsol_Class::Set_Value($_POST['stdGrNo']),
					  'stdSurname'=>Common_Nijsol_Class::Set_Value($_POST['stdSurname']),
					  'stdStudentName'=>Common_Nijsol_Class::Set_Value($_POST['stdStudentName']),
					  'stdFatherName'=>Common_Nijsol_Class::Set_Value($_POST['stdFatherName']),
					  'stdMotherName'=>Common_Nijsol_Class::Set_Value($_POST['stdMotherName']),
					  'stdAddress'=>Common_Nijsol_Class::Set_Value($_POST['stdAddress']),
					  'stdTaluka'=>Common_Nijsol_Class::Set_Value($_POST['stdTaluka']),
					  'stdDistrict'=>Common_Nijsol_Class::Set_Value($_POST['stdDistrict']),
					  'stdCity'=>Common_Nijsol_Class::Set_Value($_POST['stdCity']),
					  'stdPinCode'=>Common_Nijsol_Class::Set_Value($_POST['stdPinCode']),
					  'stdGender'=>Common_Nijsol_Class::Set_Value($_POST['stdGender']),
					  'stdBloodGroup'=>Common_Nijsol_Class::Set_Value($_POST['stdBloodGroup']),
					  'stdOfficeNo'=>Common_Nijsol_Class::Set_Value($_POST['stdOfficeNo']),
					  'stdMobileNo'=>Common_Nijsol_Class::Set_Value($_POST['stdMobileNo']),
					  'stdHomeNo'=>Common_Nijsol_Class::Set_Value($_POST['stdHomeNo']),
					  'stdFatherOccupation'=>Common_Nijsol_Class::Set_Value($_POST['stdFatherOccupation']),
					  'stdMotherOccupation'=>Common_Nijsol_Class::Set_Value($_POST['stdMotherOccupation']),
					  'stdBirthDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdBirthDate']),
					  'stdBirthPlace'=>Common_Nijsol_Class::Set_Value($_POST['stdBirthPlace']),
					  'stdCast'=>Common_Nijsol_Class::Set_Value($_POST['stdCast']),
					  'stdReligion'=>Common_Nijsol_Class::Set_Value($_POST['stdReligion']),
					  'stdCategory'=>Common_Nijsol_Class::Set_Value($_POST['stdCategory']),
					  'stdEtc'=>Common_Nijsol_Class::Set_Value($_POST['stdEtc']),
					  'stdAdmissionStandard'=>Common_Nijsol_Class::Set_Value($_POST['stdAdmissionStandard']),
					  'stdAdmissionClass'=>Common_Nijsol_Class::Set_Value($_POST['stdAdmissionClass']),
					  'stdCurrentStandard'=>Common_Nijsol_Class::Set_Value($_POST['stdCurrentStandard']),
					  'stdCurrentClass'=>Common_Nijsol_Class::Set_Value($_POST['stdCurrentClass']),
					  'stdAdmissionDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdAdmissionDate']),
					  'stdRollNo'=>Common_Nijsol_Class::Set_Value($_POST['stdRollNo']),
					  'stdLastSchool'=>Common_Nijsol_Class::Set_Value($_POST['stdLastSchool']),
					  'stdRegNo'=>Common_Nijsol_Class::Set_Value($_POST['stdRegNo']),
					  'stdRegDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_POST['stdRegDate']),
					  'stdCompulsarySubject'=>Common_Nijsol_Class::Set_Value($stdCompulsarySubject),
					  'stdGroupedSubject'=>Common_Nijsol_Class::Set_Value($stdGroupedSubject),
					  'stdOptionalSubject'=>Common_Nijsol_Class::Set_Value($stdOptionalSubject),
					  'stdReferenceName'=>Common_Nijsol_Class::Set_Value($_POST['stdReferenceName']),
					  'stdReferenceNumber'=>Common_Nijsol_Class::Set_Value($_POST['stdReferenceNumber']),
					  'stdUniqueId'=>Common_Nijsol_Class::Set_Value($_POST['stdUniqueId']),
					  'stdAadhaarId'=>Common_Nijsol_Class::Set_Value($_POST['stdAadhaarId']),
					  'stdPhysicalHandicap'=>Common_Nijsol_Class::Set_Value($_POST['stdPhysicalHandicap']),
					  'stdNative'=>Common_Nijsol_Class::Set_Value($_POST['stdNative']),
					  'stdNationality'=>Common_Nijsol_Class::Set_Value($_POST['stdNationality']),
					  'stdRemarks'=>Common_Nijsol_Class::Set_Value($_POST['stdRemarks']),
					  'stdEmail'=>Common_Nijsol_Class::Email_Checking($_POST['stdEmail']),
					  'stdPrevPresents'=>Common_Nijsol_Class::Set_Value($_POST['stdPrevPresents']),
					  'stdPrevWorkingDays'=>Common_Nijsol_Class::Set_Value($_POST['stdPrevWorkingDays']),
					  'stdIsHosteller'=>Common_Nijsol_Class::Set_Value($_POST['stdIsHosteller']),
					  'stdPhoto'=>Common_Nijsol_Class::Set_Value(Common_Nijsol_Class::Get_Session('student-photo')),
					  'stdFeeInPercentage'=>Common_Nijsol_Class::Set_Value($_POST['stdFeeInPercentage']),
					  'stdFeeCategory'=>Common_Nijsol_Class::Set_Value($_POST['stdFeeCategory']),
					  'stdValidFeeCollection'=>Common_Nijsol_Class::Set_Value($stdValidFeeCollection),
					  'stdValidFeeHead'=>Common_Nijsol_Class::Set_Value($stdValidFeeHead),
					  'stdReasonFeeException'=>Common_Nijsol_Class::Set_Value($_POST['stdReasonFeeException']),
					  'stdUid'=>Common_Nijsol_Class::Set_Value($_POST['stdUid']),
  					'stdPass'=>Common_Nijsol_Class::Set_Value($_POST['stdPass']),
					  
					  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					   );
					
					$where = " stdId='".Common_Nijsol_Class::Set_Value($_POST['id'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
					$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
					
					
					
$column=array('tblRecordId'=>Common_Nijsol_Class::Set_Value($_POST['id']),					  'tblName'=>'pgs_student',					  
'tblTitle'=>'Edit Student Information',					  
'editMessage'=>Common_Nijsol_Class::Set_Value($_POST['editMessage']),
'editDate'=>date("Y-m-d"),				  
'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),					  
'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID));					  					$result=$this->Insert_Row(DB_PREFIX."edit_message",$column);

					
					
					Common_Nijsol_Class::Set_Session('msg','Edit student information successfully.');
					Common_Nijsol_Class::Set_Session('error_success','success');
					Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-manage.php');	
			}
			else
			{
				Common_Nijsol_Class::Set_Session('msg',$error);
				Common_Nijsol_Class::Set_Session('error_success','error');
				Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-add-edit.php?id='.$_POST['id'].'&mode=edit');	
			}
		}
}