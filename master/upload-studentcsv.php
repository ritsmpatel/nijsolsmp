<?php define("menu_main","master");
	  define("menu_sub","student_information");
require_once("../includes/top.php");
class Csv_Student extends DataBase
{
	function Csv_All_Student_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
	?>	
		<div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
	<?php		
		$handle = fopen("11_12.csv", "r");
		$i=1;
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
		{
		
		$name=explode(" ",Common_Nijsol_Class::Set_Value($data[5]));
		$dob=str_replace("/","-",$data[7]);
		$joindate=str_replace("/","-",$data[8]);
		
		if(strtoupper(strtoupper(trim($data[10])))=="ALL")
		{
			$catid=1;	
		}
		else if(strtoupper(trim($data[10]))=="OPEN")
		{
			$catid=2;	
		}
		else if(strtoupper(trim($data[10]))=="SC")
		{
			$catid=3;	
		}
		else if(strtoupper(trim($data[10]))=="ST")
		{
			$catid=4;	
		}
		else if(strtoupper(trim($data[10]))=="SEBC/OBC")
		{
			$catid=5;	
		}
		else if(strtoupper(trim($data[10]))=="OTHER")
		{
			$catid=6;	
		}
		else if(strtoupper(trim($data[10]))=="MINORITY")
		{
			$catid=7;	
		}
		else if(strtoupper(trim($data[10]))=="P.H.")
		{
			$catid=8;	
		}
		
$column=array(
	'stdGrNo'=>Common_Nijsol_Class::Set_Value(trim($data[0])),
	'stdRollNo'=>Common_Nijsol_Class::Set_Value(trim($data[1])),
	'stdCurrentStandard'=>Common_Nijsol_Class::Set_Value(trim($data[2])),
	'stdCurrentClass'=>Common_Nijsol_Class::Set_Value(trim($data[3])),
	'stdGender'=>Common_Nijsol_Class::Set_Value(trim($data[4])),
	'stdSurname'=>Common_Nijsol_Class::Set_Value(strtoupper(trim($name[0]))),
	'stdStudentName'=>Common_Nijsol_Class::Set_Value(strtoupper(trim($name[1]))),
	'stdFatherName'=>Common_Nijsol_Class::Set_Value(strtoupper(trim($name[2]))),
	'stdAddress'=>Common_Nijsol_Class::Set_Value(trim($data[6])),
	'stdBirthDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format(trim($dob)),
	'stdAdmissionDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format(trim($joindate)),
	'stdCast'=>Common_Nijsol_Class::Set_Value(trim($data[9])),
	'stdCategory'=>Common_Nijsol_Class::Set_Value($catid),
	'stdMobileNo'=>Common_Nijsol_Class::Set_Value(trim($data[11])),
	'schCode'=>5,
	'usrId'=>1
 );
					
				  
					$result=$this->Insert_Row(DB_PREFIX."student",$column);
					
$stdUid="PGS".$result;	
$stdPass=mt_rand();
		
$column=array(
  'stdUid'=>Common_Nijsol_Class::Set_Value($stdUid),
  'stdPass'=>Common_Nijsol_Class::Set_Value($stdPass)
 );
$where = " stdId='".$result."' and schCode=5";
$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
			
					
		
		/*$column=array(
                    'stdGrNo'=>Common_Nijsol_Class::Set_Value($data[0]),
					  'stdSurname'=>Common_Nijsol_Class::Set_Value($data[1]),
					  'stdStudentName'=>Common_Nijsol_Class::Set_Value($data[2]),
					  'stdFatherName'=>Common_Nijsol_Class::Set_Value($data[3]),
					  'stdMotherName'=>Common_Nijsol_Class::Set_Value($data[4]),
					  'stdAddress'=>Common_Nijsol_Class::Set_Value($data[5]),
					  'stdTaluka'=>Common_Nijsol_Class::Set_Value($data[6]),
					  'stdDistrict'=>Common_Nijsol_Class::Set_Value($data[7]),
					  'stdCity'=>Common_Nijsol_Class::Set_Value($data[8]),
					  'stdPinCode'=>Common_Nijsol_Class::Set_Value($data[9]),
					  'stdGender'=>Common_Nijsol_Class::Set_Value($data[10]),
					  'stdBloodGroup'=>Common_Nijsol_Class::Set_Value($data[11]),
					  'stdOfficeNo'=>Common_Nijsol_Class::Set_Value($data[12]),
					  'stdMobileNo'=>Common_Nijsol_Class::Set_Value($data[13]),
					  'stdHomeNo'=>Common_Nijsol_Class::Set_Value($data[14]),
					  'stdFatherOccupation'=>Common_Nijsol_Class::Set_Value($data[15]),
					  'stdMotherOccupation'=>Common_Nijsol_Class::Set_Value($data[16]),
					  'stdBirthDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($data[17]),
					  'stdBirthPlace'=>Common_Nijsol_Class::Set_Value($data[18]),
					  'stdCast'=>Common_Nijsol_Class::Set_Value($data[19]),
					  'stdReligion'=>Common_Nijsol_Class::Set_Value($data[20]),
					  'stdCategory'=>Common_Nijsol_Class::Set_Value($data[21]),
					  'stdEtc'=>Common_Nijsol_Class::Set_Value($data[22]),
					  'stdAdmissionStandard'=>Common_Nijsol_Class::Set_Value($data[23]),
					  'stdAdmissionClass'=>Common_Nijsol_Class::Set_Value($data[24]),
					  'stdCurrentStandard'=>Common_Nijsol_Class::Set_Value($data[25]),
					  'stdCurrentClass'=>Common_Nijsol_Class::Set_Value($data[26]),
					  'stdAdmissionDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($data[27]),
					  'stdRollNo'=>Common_Nijsol_Class::Set_Value($data[28]),
					  'stdLastSchool'=>Common_Nijsol_Class::Set_Value($data[29]),
					  'stdRegNo'=>Common_Nijsol_Class::Set_Value($data[30]),
					  'stdRegDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($data[31]),
					  'stdCompulsarySubject'=>Common_Nijsol_Class::Set_Value($data[32]),
					  'stdGroupedSubject'=>Common_Nijsol_Class::Set_Value($data[33]),
					  'stdOptionalSubject'=>Common_Nijsol_Class::Set_Value($data[34]),
					  'stdReferenceName'=>Common_Nijsol_Class::Set_Value($data[35]),
					  'stdReferenceNumber'=>Common_Nijsol_Class::Set_Value($data[36]),
					  'stdUniqueId'=>Common_Nijsol_Class::Set_Value($data[37]),
					  'stdAadhaarId'=>Common_Nijsol_Class::Set_Value($data[38]),
					  'stdPhysicalHandicap'=>Common_Nijsol_Class::Set_Value($data[39]),
					  'stdNative'=>Common_Nijsol_Class::Set_Value($data[40]),
					  'stdNationality'=>Common_Nijsol_Class::Set_Value($data[41]),
					  'stdRemarks'=>Common_Nijsol_Class::Set_Value($data[42]),
					  'stdEmail'=>Common_Nijsol_Class::Email_Checking($data[43]),
					  'stdPrevPresents'=>Common_Nijsol_Class::Set_Value($data[44]),
					  'stdPrevWorkingDays'=>Common_Nijsol_Class::Set_Value($data[45]),
					  'stdIsHosteller'=>Common_Nijsol_Class::Set_Value($data[46]),
					  'stdPhoto'=>Common_Nijsol_Class::Set_Value($data[47]),
					  'stdFeeInPercentage'=>Common_Nijsol_Class::Set_Value($data[48]),
					  'stdFeeCategory'=>Common_Nijsol_Class::Set_Value($data[49]),
					  'stdValidFeeCollection'=>Common_Nijsol_Class::Set_Value($data[50]),
					  'stdValidFeeHead'=>Common_Nijsol_Class::Set_Value($data[51]),
					  'stdReasonFeeException'=>Common_Nijsol_Class::Set_Value($data[52]),
					  'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
					  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
					  );
					  
					$result=$this->Insert_Row(DB_PREFIX."student",$column);*/
					
				$i= $i+1;	
		
		}
?> 
   
      </div>
      </div>
      </div>
     </div>       				
				
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom(); ?>

<?php }
	
}
$student = new Csv_Student();	
$student->Csv_All_Student_Information();
?>