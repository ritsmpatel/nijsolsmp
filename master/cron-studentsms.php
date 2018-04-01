<?php define("menu_main","master");
	  define("menu_sub","student_information");
require_once("../includes/top.php");
class Cron_Student extends DataBase
{
	function Cron_All_Student_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
		
		
		include("../includes/mailer/class.phpmailer.php");		
			$common_nijsol_class= new Common_Nijsol_Class();		
			$result_settings=$common_nijsol_class->Direct_Query("SELECT * FROM ".DB_PREFIX."settings WHERE stgId=1"); 				
			if(!empty(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId'])))		
			{
			
			
			/*
			
			$result=$this->Get_Rows(DB_PREFIX."feedback","1=1",'*','fdId'); 
				foreach($result as $_result)
				{
				$studentid=$_result['fdStudentId'];
				$message=$_result['fdComment'];
				
			$semail = new PHPMailer();			
			$semail->SetLanguage("en", 'mailer/language/');								
			$semail->IsSMTP(); 		
			$semail->Host = Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailHost']);		$semail->SMTPAuth=true;	
			$semail->Username=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);	
			$semail->Password=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailPassword']);						
			$result=$common_nijsol_class->Direct_Query("SELECT stdSurname, stdStudentName, stdFatherName FROM ".DB_PREFIX."student WHERE stdId='".$studentid."'");									
			$std=Common_Nijsol_Class::Get_Value($result[0]['stdSurname'])." ";			
			$std.=Common_Nijsol_Class::Get_Value($result[0]['stdStudentName'])." ";			
			$std.=Common_Nijsol_Class::Get_Value($result[0]['stdFatherName']);													
			$semail->IsHTML(true);			
			$from=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);									 			$semail->From =$from;			
			$semail->FromName = SITE_NAME;						
			
				$semail->AddAddress("allemailbackup@krishnapranami.org");
			$semail->AddAddress(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId']));			
			$semail->AddReplyTo($from);			
			$semail->Subject ="Feedback Message For School";			
			$semail->Body=stripslashes($std."<br><br>".$message);						
			if(!$semail->Send())			
			{				
				echo $semail->ErrorInfo;				
				die("Not send to ");			
			}	
			else
			{
				echo $studentid."<br>";
			}
			$semail=NULL;		
			}	*/
		}
			
		/*Common_Nijsol_Class::Send_SMS("Nishit Rathod","9016480055","PGS108","1234","student_information","");*/
?> 
   
          <!--  <div class="pageContent extended">
        <div class="container">
						<table >
							<thead>
								<tr>
                                <th>No</th>
                                <th>Surname</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Mobile</th>
                                <th>User</th>
                                <th>Pass</th>
                                
								</tr>
							</thead>
							<tbody>
							<?php 
							$result=$this->Get_Rows(DB_PREFIX."student","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdActive='1'",'stdId, stdSurname, stdStudentName, stdFatherName,stdMobileNo,stdHomeNo,stdUid,stdPass','stdId'); 
							foreach($result as $_result)
							{
								$mobile=""; 
							if(!empty($_result['stdMobileNo']))
							{
								$mobile=$_result['stdMobileNo'];
							}
							else if(!empty($_result['stdHomeNo']))
							{
								$mobile=$_result['stdHomeNo'];
							}
				
				if(!empty($mobile))
				{	
					$name=Common_Nijsol_Class::Get_Value($_result['stdSurname'])." ".Common_Nijsol_Class::Get_Value($_result['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($_result['stdFatherName']);
				/*Common_Nijsol_Class::Send_SMS($name,$mobile,Common_Nijsol_Class::Get_Value($_result['stdUid']),Common_Nijsol_Class::Get_Value($_result['stdPass']),"student_information","");		
		*/					?>	
        <tr>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdId']); ?></td>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdSurname']); ?></td>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdStudentName']); ?></td>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdFatherName']); ?></td>
            <td><?php echo $mobile; ?></td>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdUid']); ?></td>
            <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdPass']); ?></td>
            
          
            
        </tr>
						  <?php } 
						  }
						  	 ?>    		
							</tbody>
						</table>
	</div>
    </div>			-->	
				
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom(); ?>

<?php }
	
}
$student = new Cron_Student();	
$student->Cron_All_Student_Information();
?>