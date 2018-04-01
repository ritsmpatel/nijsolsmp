<?php require_once "general-includes-db.php";
class Common_Top extends DataBase
{
	function ALL_Common_Top()
	{?>
<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo SITE_NAME;?></title>
	<meta name="description" content="...">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS -->
    <link rel="icon" href="<?php echo FILE_UPLOAD_PATH.Common_Nijsol_Class::Get_One_Name("settings","stgLogo","stgId=1");?>" sizes="32x32" type="image/png">
    
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/fontello.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/datatables.min.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/app.min.css">
    
    <link rel="stylesheet" href="<?php echo SITE_URL;?>css/nijsol.css">
	
	<!-- Modernizr -->
	<script src="<?php echo SITE_URL;?>assets/js/modernizr-2.8.3.min.js"></script>

	<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<?php 
$masterclass=" hidden-xs hidden-sm";
?>
	<!-- Header -->
<header id="header">
		<h1 class="logo">
			<a href="#" title="#" class="js-nav-toggler">
				<i class="icon icon-close"></i>
                 <!--<img src="<?php /*echo SITE_URL;*/?>img/hide_menu.png" border=0 style="margin-top:-4px">&nbsp;-->
			</a>
			<a href="#" title="#">
				  <?php if(!empty(Common_Nijsol_Class::Get_Session('schCode')))
                {
					     echo Common_Nijsol_Class::Get_Session('schName')." (".str_replace("_","-",Common_Nijsol_Class::Get_Session('years')).")";
                }
                else
                {
                    echo SITE_NAME;
                }
                ?>
           </a>
		</h1>

		<div class="pageContent">
			<div class="container">
				<ul class="topNavigation">
                <li style="padding: 20px 0;">
                		  <?php echo Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_PROPER_NAME);?>
                </li>
                
					<!--<li>
						<a href="#" title="#">
							<i class="zmdi zmdi-fullscreen-alt zmdi-hc-fw icon js-fullscreen-enter"></i>
						</a>
					</li>-->
				</ul>
			</div>
		</div>
	</header>
	
	<aside class="aside">
		<!-- User profile -->
		<div class="asideUserProfile">
			<a href="<?php echo LOGIN_URL;?>dashboard.php" title="#" class="c">
            <?php $logo=Common_Nijsol_Class::Get_One_Name("settings","stgLogo","stgId=1");
			if(!empty($logo)){
			?>
            	<img src="<?php echo FILE_UPLOAD_PATH.Common_Nijsol_Class::Get_Value($logo);?>" alt="Logo" class="img-responsive">
			<?php }?>	
                <!--<span class="name hidden-xs hidden-sm">Patricia<br /> Brown-Johnes</span>-->
			</a>
		</div>

		<!-- Navigation -->
        <?php

$permission=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."permission WHERE perUsrId='".Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)."'");
	
	$menuList=array();
	foreach($permission as $_per)
	{
		if($_per['perView']==1)
		{
		$section=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."section WHERE stnId='".$_per['perStnId']."'");
		$menuList[]=$section[0]['stnSubMenuName'];
		}
	}
	
	if(!in_array(menu_sub,$menuList) && Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)!=1){
		Common_Nijsol_Class::Redirect_To(LOGIN_URL.'logout.php');
	}
	
	
	
	
		if(menu_sub!="")
		{
			$section=$this->Direct_Query("SELECT stnId FROM ".DB_PREFIX."section WHERE stnSubMenuName='".menu_sub."'");
			$permission=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."permission WHERE perStnId='".$section[0]['stnId']."' and perUsrId='".Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)."'");
			
Common_Nijsol_Class::Set_Session('perView',Common_Nijsol_Class::Get_Value($permission[0]['perView']));
Common_Nijsol_Class::Set_Session('perAdd',Common_Nijsol_Class::Get_Value($permission[0]['perAdd']));
Common_Nijsol_Class::Set_Session('perEdit',Common_Nijsol_Class::Get_Value($permission[0]['perEdit']));
Common_Nijsol_Class::Set_Session('perDelete',Common_Nijsol_Class::Get_Value($permission[0]['perDelete']));
		}
		else
		{
			Common_Nijsol_Class::Remove_Session('perView');
			Common_Nijsol_Class::Remove_Session('perAdd');
			Common_Nijsol_Class::Remove_Session('perEdit');
			Common_Nijsol_Class::Remove_Session('perDelete');
		}
?>
        
		<nav class="simpleList asideNavigation">
			<ul>
            <?php if(in_array("dashboard",$menuList)){?>
				<li class="<?php echo (menu_main=="dashboard")? "active":"";?>"><a href="<?php echo LOGIN_URL;?>dashboard.php" title="Dashboard"><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Dashboard</span></a></li>
             <?php }?>
            
             
    <?php if(in_array("trustee_information",$menuList) 
			|| in_array("student_information",$menuList) 
			|| in_array("student_addrollno",$menuList) 
			|| in_array("admission_cancel",$menuList) 
			|| in_array("student_homework",$menuList) 
			|| in_array("fee_entry",$menuList) 
			|| in_array("fee_receipt_cancellation",$menuList) 
			|| in_array("time_table",$menuList) 
			|| in_array("past_student_information",$menuList)
			|| in_array("change_password",$menuList)
			|| Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_TYPE)==1){?>
               
               <li class="sub js-submenu <?php echo (menu_main=="master")? "active":"";?>" >
					<div id="master" <?php echo (menu_main=="master")? "":"onClick=menuShowHide('master');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Master<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="master")? "display-block ".$masterclass:"";?>">
				
                <?php if(in_array("trustee_information",$menuList)){?>		
                        <li class="<?php echo (menu_sub=="trustee_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>trustee-information-manage.php" title="Trustee Information">Trustee Information</a></li>
                 <?php } if(in_array("student_information",$menuList)){?>       
                        <li class="<?php echo (menu_sub=="student_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-information-manage.php" title="Student Information">Student Information</a></li>
                 <?php } if(in_array("student_addrollno",$menuList)){?>           
                        <li class="<?php echo (menu_sub=="student_addrollno")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-addrollno-manage.php" title="Student Roll No">Student Roll No</a></li>
                      <?php } if(in_array("admission_cancel",$menuList)){?>      
                        <li class="<?php echo (menu_sub=="admission_cancel")? "active":"";?>"><a href="<?php echo MASTER_URL;?>admission-cancel-manage.php" title="Student Admission Cancel">Student Admission Cancel</a></li>  
                      <?php } if(in_array("student_homework",$menuList)){?>     
                       <li class="<?php echo (menu_sub=="student_homework")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-homework-manage.php" title="Student Homework">Student Homework</a></li>   
                   <?php } if(in_array("student_attendance",$menuList)){?>        
                    <li class="<?php echo (menu_sub=="student_attendance")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-attendance-manage.php" title="Student Attendance">Student Attendance</a></li> 
                    <?php } if(in_array("fee_entry",$menuList)){?>    
                    <li class="<?php echo (menu_sub=="fee_entry")? "active":"";?>"><a href="<?php echo MASTER_URL;?>fee-entry.php?mode=add" title="Fee Receipt Entry">Fee Receipt Entry</a></li> 
                    <?php } if(in_array("fee_receipt_cancellation",$menuList)){?>    
                    <li class="<?php echo (menu_sub=="fee_receipt_cancellation")? "active":"";?>"><a href="<?php echo MASTER_URL;?>fee-receipt-cancellation.php" title="Fee Receipt View/Cancellation">Fee Receipt View/Cancellation</a></li> 
                   <?php } if(in_array("time_table",$menuList)){?>     
                     <li class="<?php echo (menu_sub=="time_table")? "active":"";?>"><a href="<?php echo MASTER_URL;?>time-table-manage.php" title="Time Table">Time Table</a></li> 
                    
                    <?php } if(in_array("past_student_information",$menuList)){?>    
                    <li class="<?php echo (menu_sub=="past_student_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>past-student-information-manage.php" title="Past Student Information">Past Student Information</a></li>
                    <?php } if(in_array("staff_information",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="staff_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>staff-information-manage.php" title="Staff Information">Staff Information</a></li>     
                   <?php } 
				   
				   if(Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_TYPE)==1)
				   {?>    
                   
                   <li class="<?php echo (menu_sub=="edit_message")? "active":"";?>"><a href="<?php echo MASTER_URL;?>edit-message-manage.php" title="Message Edit Message">Manage Edit Message</a></li>  
                   <li class="<?php echo (menu_sub=="user_manage")? "active":"";?>"><a href="<?php echo MASTER_URL;?>user-manage.php" title="Manage User">Manage User</a></li>
              <?php }
				  else 
				  {
					 if(in_array("change_password",$menuList)){ 
					  ?>     
                       <li class="<?php echo (menu_sub=="change_password")? "active":"";?>"><a href="<?php echo MASTER_URL;?>change-password.php?mode=edit" title="Change Password">Change Password</a></li>
                <?php }
				
				}?>       
					</ul>
				</li>
                
    <?php }?>
    
    <?php if(in_array("class_wise_student_attendance",$menuList) 
			|| in_array("class_wise_student_list",$menuList) 
			|| in_array("student_list_excel",$menuList)
			|| in_array("student_birthday_list",$menuList) 
			|| in_array("student_address",$menuList) 
			|| in_array("category_wise_student_strength",$menuList) 
			|| in_array("subject_wise_passing_marks",$menuList) 
			|| in_array("class_wise_total_fee",$menuList) 
			|| in_array("student_progress_monthly",$menuList) 
			|| in_array("student_bonafide",$menuList)
			|| in_array("date_wise_bonafide",$menuList)
			|| in_array("subject_wise_student",$menuList)
			|| in_array("class_wise_student_category",$menuList)
			){?>
             
             <li class="sub js-submenu <?php echo (menu_main=="report")? "active":"";?>" >
					<div id="report" <?php echo (menu_main=="report")? "":"onClick=menuShowHide('report');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Report<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="report")? "display-block ".$masterclass:"";?>">
						
						<?php if(in_array("class_wise_student_attendance",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="class_wise_student_attendance")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-attendance.php" title="Class Wise Student Attendance">Class Wise Student Attendance</a></li>
                     <?php } if(in_array("class_wise_student_list",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="class_wise_student_list")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-list.php" title="Class Wise Student List">Class Wise Student List</a></li>
                   
                   <?php } if(in_array("student_list_excel",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="student_list_excel")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-list-export-excel.php" title="Student List In Excel">Student List In Excel</a></li>   
					 
					 <?php } if(in_array("student_birthday_list",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="student_birthday_list")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-birthday-list.php" title="Student Birthday List">Student Birthday List</a></li>
                     <?php } if(in_array("student_address",$menuList)){?>     
                     <li class="<?php echo (menu_sub=="student_address")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-address-list.php" title="Student Address List">Student Address List</a></li>   
                    <?php } if(in_array("category_wise_student_strength",$menuList)){?> 
                     <li class="<?php echo (menu_sub=="category_wise_student_strength")? "active":"";?>"><a href="<?php echo REPORT_URL;?>category-wise-student-strength.php" title="Category Wise Student Strength">Category Wise Student Strength</a></li>
                    <?php } if(in_array("subject_wise_passing_marks",$menuList)){?>  
                     <li class="<?php echo (menu_sub=="subject_wise_passing_marks")? "active":"";?>"><a href="<?php echo REPORT_URL;?>subject-wise-passing-marks.php" title="Subject Wise Passing Marks">Subject Wise Passing Marks</a></li> 
                    <?php } if(in_array("class_wise_total_fee",$menuList)){?>  
                     <li class="<?php echo (menu_sub=="class_wise_total_fee")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-total-fee.php" title="Class Wise Total Fee">Class Wise Total Fee</a></li>
                 <?php } if(in_array("student_progress_monthly",$menuList)){?>        
                   <li class="<?php echo (menu_sub=="student_progress_monthly")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-progress-monthly.php" title="Student Progress Monthly">Student Progress Monthly</a></li>
                   <?php } if(in_array("student_bonafide",$menuList)){?> 
                   
                   <li class="<?php echo (menu_sub=="student_bonafide")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-bonafide.php" title="Student Bonafide">Student Bonafide</a></li>
                  <?php } if(in_array("date_wise_bonafide",$menuList)){?> 
                   <li class="<?php echo (menu_sub=="date_wise_bonafide")? "active":"";?>"><a href="<?php echo REPORT_URL;?>date-wise-bonafide.php" title="Date Wise Bonafide">Date Wise Bonafide</a></li>
                   <?php } if(in_array("subject_wise_student",$menuList)){?> 
                   <li class="<?php echo (menu_sub=="subject_wise_student")? "active":"";?>"><a href="<?php echo REPORT_URL;?>subject-wise-student.php" title="Subject Wise Student">Subject Wise Student</a></li>
                   <?php } if(in_array("class_wise_student_category",$menuList)){?> 
                   <li class="<?php echo (menu_sub=="class_wise_student_category")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-category.php" title="Class Wise Student Category">Class Wise Student Category</a></li>
                  <?php }
				   if(in_array("student_id_card",$menuList)){?> 
                   <li class="<?php echo (menu_sub=="student_id_card")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-id-card.php" title="Student ID Card">Student ID Card</a></li>
                   <?php } ?>        
                  </ul>
				</li>   
                
        <?php }?>
             
         <?php if(in_array("student_signature_sheet",$menuList) 
			|| in_array("student_result_sheet_oral_test",$menuList) 
			){?>    
              
              <li class="sub js-submenu <?php echo (menu_main=="blank_report")? "active":"";?>" >
					<div id="blank_report" <?php echo (menu_main=="blank_report")? "":"onClick=menuShowHide('blank_report');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Blank Reports<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="blank_report")? "display-block ".$masterclass:"";?>">
					
                  <?php if(in_array("student_signature_sheet",$menuList)){?>
                   <li class="<?php echo (menu_sub=="student_signature_sheet")? "active":"";?>"><a href="<?php echo BLANK_REPORT_URL;?>student-signature-sheet-list.php" title="Student Signature Sheet">Student Signature Sheet</a></li>
                  <?php } if(in_array("student_result_sheet_oral_test",$menuList)){?> 
                     <li class="<?php echo (menu_sub=="student_result_sheet_oral_test")? "active":"";?>"><a href="<?php echo BLANK_REPORT_URL;?>student-result-sheet-oral-test-list.php" title="Student Result Sheet Oral Test">Student Result Sheet Oral Test</a></li>
                <?php }?>        
                  </ul>
				</li>  
    <?php }?>            
                
       <?php if(in_array("exam_information",$menuList) 
			|| in_array("standard_setup",$menuList) 
			|| in_array("class_setup",$menuList) 
			|| in_array("subject_information",$menuList) 
			|| in_array("class_grade_setup",$menuList) 
			|| in_array("subject_wise_total_passing_marks",$menuList) 
			|| in_array("subject_grade_setup",$menuList) 
			|| in_array("organisation_name",$menuList)
			|| in_array("fee_category_setup",$menuList)
			|| in_array("fee_collection_type",$menuList)
			|| in_array("fee_name_setup",$menuList)
			|| in_array("fee_structure_setup",$menuList)
			|| in_array("activities_name_setup",$menuList)
			|| in_array("paper_type",$menuList)
			){?>         
                
                <li class="sub js-submenu <?php echo (menu_main=="setup")? "active":"";?>" >
					<div id="setup" <?php echo (menu_main=="setup")? "":"onClick=menuShowHide('setup');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Setup<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="setup")? "display-block ".$masterclass:"";?>">
						
                   <?php if(in_array("exam_information",$menuList)){?>      
                        <li class="<?php echo (menu_sub=="exam_information")? "active":"";?>"><a href="<?php echo SETUP_URL;?>exam-information-manage.php" title="Exams Information">Exams Information</a></li>
                       <?php } if(in_array("standard_setup",$menuList)){?>  
                        <li class="<?php echo (menu_sub=="standard_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>standard-setup-manage.php" title="Standards Setup">Standards Setup</a></li>
                        <?php } if(in_array("class_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="class_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>class-setup-manage.php" title="Class Setup">Class Setup</a></li>
                       <?php } if(in_array("subject_information",$menuList)){?>  
                        <li class="<?php echo (menu_sub=="subject_information")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-information-manage.php" title="Subject Information">Subjects Information</a></li>
                       <?php } if(in_array("class_grade_setup",$menuList)){?>  
                        <li class="<?php echo (menu_sub=="class_grade_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>class-grade-setup-manage.php" title="Class or Grade Setup">Class or Grade Setup</a></li>
                       <?php }?>  
                        <!--<li class="<?php /*echo (menu_sub=="exam_setup_term_final")? "active":"";*/?>"><a href="<?php /*echo SETUP_URL;*/?>exam-setup-term-final-manage.php" title="Exam Setup Term/Final">Exam Setup Term/Final</a></li>-->
                      <!--<li class="<?php /*echo (menu_sub=="final_result_marks_setup")? "active":"";*/?>"><a href="<?php /*echo SETUP_URL;*/?>final-result-marks-setup-manage.php" title="Final Result Marks Setup">Final Result Marks Setup</a></li>-->
                       
                     <?php if(in_array("subject_wise_total_passing_marks",$menuList)){?>   
                        <li class="<?php echo (menu_sub=="subject_wise_total_passing_marks")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-wise-total-passing-marks-manage.php" title="Total and Passing Marks Setup">Total and Passing Marks Setup</a></li>
                        
                       <?php } if(in_array("subject_grade_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="subject_grade_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-grade-setup-manage.php" title="Subject Grade Setup">Subject Grade Setup</a></li>
                      <?php } if(in_array("organisation_name",$menuList)){?>   
                        <li class="<?php echo (menu_sub=="organisation_name")? "active":"";?>"><a href="<?php echo SETUP_URL;?>organisation-name-manage.php" title="Organisation Name">Organisation Name</a></li>
                       <?php } if(in_array("fee_category_setup",$menuList)){?>  
                        <li class="<?php echo (menu_sub=="fee_category_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-category-setup-manage.php" title="Fee Category Setup">Fee Category Setup</a></li>
                        <?php } if(in_array("fee_collection_type",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="fee_collection_type")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-collection-type-manage.php" title="Fee Collection Type">Fee Collection Type</a></li>
                        <?php } if(in_array("fee_name_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="fee_name_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-name-setup-manage.php" title="Fee Name Setup">Fee Name Setup</a></li>
                        <?php } if(in_array("fee_structure_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="fee_structure_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-structure-setup-manage.php" title="Fee Structure Setup">Fee Structure Setup</a></li>
                        <?php } if(in_array("activities_name_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="activities_name_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>activities-name-setup-manage.php" title="Activities Name Setup">Activities Name Setup</a></li>
                       <?php } if(in_array("paper_type",$menuList)){?>  
                         <li class="<?php echo (menu_sub=="paper_type")? "active":"";?>"><a href="<?php echo SETUP_URL;?>paper-type-manage.php" title="Paper Type">Paper Type</a></li>
                       <?php } ?>   
                  </ul>
				</li>
             <?php }?>
             
              <?php if(in_array("semester_result",$menuList) 
			|| in_array("semester_result_structure",$menuList) 
			|| in_array("student_mark_entry",$menuList) 
			|| in_array("mark_sheet_semester",$menuList) 
			|| in_array("indicator_setup",$menuList) 
			|| in_array("indicator_setup_2_b",$menuList) 
			|| in_array("activity_indicator",$menuList) 
			|| in_array("indicator_entry",$menuList)
			|| in_array("mark_sheet_overall",$menuList)
			|| in_array("semester_result_structure_11_12",$menuList)
			|| in_array("annual_report_11_12",$menuList)){?> 
               
                
               <li class="sub js-submenu <?php echo (menu_main=="semester_result")? "active":"";?>" >
					<div id="semester_result" <?php echo (menu_main=="semester_result")? "":"onClick=menuShowHide('semester_result');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Semester Result<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="semester_result")? "display-block ".$masterclass:"";?>">
					
                 <?php if(in_array("semester_result_structure",$menuList)){?>     
                    	<li class="<?php echo (menu_sub=="semester_result_structure")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>semester-result-structure-manage.php" title="Semester Result Structure">Semester Result Structure</a></li>
                 <?php } 
				 
				  if(in_array("semester_result_structure_11_12",$menuList)){?>     
                    	<li class="<?php echo (menu_sub=="semester_result_structure_11_12")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>semester-result-structure-11-12-manage.php" title="Semester Result Structure 11 And 12">Semester Result Structure 11 And 12</a></li>
                 <?php } 
				 
				 
				 if(in_array("student_mark_entry",$menuList)){?>         
						<li class="<?php echo (menu_sub=="student_mark_entry")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>student-mark-entry.php" title="Student Mark Entry">Student Mark Entry</a></li>
                  <?php } if(in_array("mark_sheet_semester",$menuList)){?>        
                       <li class="<?php echo (menu_sub=="mark_sheet_semester")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>mark-sheet-semester-list.php" title="Mark Sheet Semester">Mark Sheet Semester</a></li>                         
                   <?php } if(in_array("indicator_setup",$menuList)){?>       
                    <li class="<?php echo (menu_sub=="indicator_setup")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-setup-manage.php" title="Indicator Setup">Indicator Setup</a></li>
                     <?php } if(in_array("indicator_setup_2_b",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="indicator_setup_2_b")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-setup-2-b-manage.php" title="Indicator Setup 2-B">Indicator Setup 2-B</a></li>
                      <?php } if(in_array("activity_indicator",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="activity_indicator")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>activity-indicator-manage.php" title="Activity Indicator">Activity Indicator</a></li>
                      <?php } if(in_array("indicator_entry",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="indicator_entry")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-entry-manage.php" title="Indicator Entry">Indicator Entry</a></li>    
                      <?php } if(in_array("mark_sheet_overall",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="mark_sheet_overall")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>mark-sheet-semester-overall.php" title="Mark Sheet Semester Overall">Mark Sheet Semester Overall</a></li>    
                      <?php }
					  if(in_array("annual_report_11_12",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="annual_report_11_12")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>mark-sheet-annual-report-11-12.php" title="Mark Sheet Annual Report 11 And 12">Annual Report 11 And 12</a></li>    
                      <?php }?>
                      
                      
                    
                      
                  </ul>
				</li> 
         <?php }?>
         
           <?php if(in_array("subjective_exam_info",$menuList) 
			|| in_array("test_name_setup",$menuList) 
			|| in_array("subject_remarks_setup",$menuList) 
			|| in_array("special_exam_structure",$menuList) 
			|| in_array("special_mark_entry",$menuList) 
			){?>   
                
              <li class="sub js-submenu <?php echo (menu_main=="special_setup")? "active":"";?>" >
					<div id="special_setup"  <?php echo (menu_main=="special_setup")? "":"onClick=menuShowHide('special_setup');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Special Setup<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="special_setup")? "display-block ".$masterclass:"";?>">
					  <?php if(in_array("subjective_exam_info",$menuList)){?> 	
                      <li class="<?php echo (menu_sub=="subjective_exam_info")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>subjective-exam-info-manage.php" title="Month Exam Info">Month Exam Info</a></li>
                       <?php } if(in_array("test_name_setup",$menuList)){?>  
                        <li class="<?php echo (menu_sub=="test_name_setup")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>test-name-setup-manage.php" title="Test Name Setup">Test Name Setup</a></li>
                          <?php } if(in_array("subject_remarks_setup",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="subject_remarks_setup")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>subject-remarks-setup-manage.php" title="Subject Remarks Setup">Subject Remarks Setup</a></li>
                         <?php } if(in_array("special_exam_structure",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="special_exam_structure")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>special-exam-structure-manage.php" title="Special Exam Structure">Special Exam Structure</a></li>
                         <?php } if(in_array("special_mark_entry",$menuList)){?> 
                        <li class="<?php echo (menu_sub=="special_mark_entry")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>special-mark-entry.php" title="Special Mark Entry">Special Mark Entry</a></li>
                      <?php } ?>     
                  	</ul>
				</li>  
          <?php }?>    
             
           <?php if(in_array("emergency_message",$menuList) ){?>   
                    
              <li class="sub js-submenu <?php echo (menu_main=="notification")? "active":"";?>" >
					<div id="notification" <?php echo (menu_main=="notification")? "":"onClick=menuShowHide('notification');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Notification<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="notification")? "display-block ".$masterclass:"";?>">
					  <?php if(in_array("emergency_message",$menuList)){?>	
                        <li class="<?php echo (menu_sub=="emergency_message")? "active":"";?>"><a href="<?php echo NOTIFICATION_URL;?>emergency-message-manage.php" title="Emergency Message">Emergency Message</a></li>
                       <?php }?>   
                  </ul>
				</li>
           <?php }?>   
              
           <?php if(in_array("home_page",$menuList) 
			|| in_array("about_us",$menuList) 
			|| in_array("contact",$menuList) 
			|| in_array("photo_gallery",$menuList) 
			){?>   
                 
              <li class="sub js-submenu <?php echo (menu_main=="cms")? "active":"";?>" >
					<div id="cms" <?php echo (menu_main=="cms")? "":"onClick=menuShowHide('cms');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">CMS<i class="zmdi zmdi-plus plus"></i></span></div>
					
                    <ul class="<?php echo (menu_main=="cms")? "display-block ".$masterclass:"";?>">
                   
                 <?php if(in_array("home_page",$menuList)){?>   
						<li class="<?php echo (menu_sub=="home_page")? "active":"";?>"><a href="<?php echo CMS_URL;?>home-page.php?mode=edit" title="Home">Home</a></li>
                  <?php } if(in_array("about_us",$menuList)){?>
						<li class="<?php echo (menu_sub=="about_us")? "active":"";?>"><a href="<?php echo CMS_URL;?>about-us.php?mode=edit" title="About Us">About Us</a></li>
                    <?php } if(in_array("contact",$menuList)){?>    
                        <li class="<?php echo (menu_sub=="contact")? "active":"";?>"><a href="<?php echo CMS_URL;?>contact.php?mode=edit" title="Contact">Contact</a></li>
                  <?php } if(in_array("photo_gallery",$menuList)){?>      
                     <li class="<?php echo (menu_sub=="photo_gallery")? "active":"";?>"><a href="<?php echo CMS_URL;?>photo-gallery-manage.php" title="Contact">Photo Gallery</a></li>   
                  <?php }?>      
                  	</ul>
				</li>
        <?php }?>      
              
             <?php if(in_array("settings",$menuList)){?>   
              <li class="<?php echo (menu_main=="settings")? "active":"";?>"><a href="<?php echo SETTINGS_URL;?>settings.php?mode=edit" title="Settings"><i class="fa fa-fw fa-gears icon"></i> <span class="hidden-xs hidden-sm">Settings</span></a></li>   
           <?php }?>     
              
              <li><a href="<?php echo LOGIN_URL;?>logout.php" title="Log Out"><i class="zmdi zmdi-power zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Log Out</span></a></li> 
				
         
			</ul>
		</nav>

	</aside>

	<!-- Page Wrap -->
	<div class="pageWrap">
 <?php }

}

/*Bottom contant*/
class Common_Bottom extends DataBase
{
	function ALL_Common_Bottom()
	{?>
	</div>

	<!-- JS -->
    <!-- support datepicker -->
    <script src="<?php echo SITE_URL;?>assets/js/moment.min.js"></script>
	
	
<script src="<?php echo SITE_URL;?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/select2.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/jquery.shuffle.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/pwstrength-bootstrap-1.2.9.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/throttle-debounce.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/app.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/datatables.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/bootstrap-typeahead.js"></script>
<script src="<?php echo SITE_URL;?>js/typeahead.js"></script>

<script src="<?php echo SITE_URL;?>js/nijsol.js"></script>

	
<script language="javascript">
	 function menuShowHide(menu)
	 {	
		if ( $('#'+menu+' span i').hasClass('zmdi-plus plus') ) {
			$('#'+menu+' span i').addClass('zmdi-minus minus');
			$('#'+menu+' span i').removeClass('zmdi-plus plus');
		} else {
			$('#'+menu+' span i').removeClass('zmdi-minus minus');
			$('#'+menu+' span i').addClass('zmdi-plus plus');
		}	
	 }
	 
	 menuShowHide('<?php echo menu_main;?>');
</script>    
    
    
	<div class="visible-xs visible-sm extendedChecker"></div>
    <?php include("alert.php");
	?>
    <div id="delete-box"></div>
</body>
</html>
 <?php }
}
?>