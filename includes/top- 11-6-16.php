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
                        echo Common_Nijsol_Class::Get_Session('schName');
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
		<nav class="simpleList asideNavigation">
			<ul>
				<li class="<?php echo (menu_main=="dashboard")? "active":"";?>"><a href="<?php echo LOGIN_URL;?>dashboard.php" title="Dashboard"><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Dashboard</span></a></li>
               
               <li class="sub js-submenu <?php echo (menu_main=="master")? "active":"";?>" >
					<div id="master" <?php echo (menu_main=="master")? "":"onClick=menuShowHide('master');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Master<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="master")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="trustee_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>trustee-information-manage.php" title="Trustee Information">Trustee Information</a></li>
                        <li class="<?php echo (menu_sub=="student_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-information-manage.php" title="Student Information">Student Information</a></li>
                        
                        <li class="<?php echo (menu_sub=="student_addrollno")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-addrollno-manage.php" title="Student Roll No">Student Roll No</a></li>
                        
                        <li class="<?php echo (menu_sub=="admission_cancel")? "active":"";?>"><a href="<?php echo MASTER_URL;?>admission-cancel-manage.php" title="Student Admission Cancel">Student Admission Cancel</a></li>  
                       
                       <li class="<?php echo (menu_sub=="student_homework")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-homework-manage.php" title="Student Homework">Student Homework</a></li>   
                       
                    <li class="<?php echo (menu_sub=="student_attendance")? "active":"";?>"><a href="<?php echo MASTER_URL;?>student-attendance-manage.php" title="Student Attendance">Student Attendance</a></li> 
                    
                    <li class="<?php echo (menu_sub=="fee_entry")? "active":"";?>"><a href="<?php echo MASTER_URL;?>fee-entry.php?mode=add" title="Fee Receipt Entry">Fee Receipt Entry</a></li> 
                    
                    <li class="<?php echo (menu_sub=="fee_receipt_cancellation")? "active":"";?>"><a href="<?php echo MASTER_URL;?>fee-receipt-cancellation.php" title="Fee Receipt View/Cancellation">Fee Receipt View/Cancellation</a></li> 
                    
                     <li class="<?php echo (menu_sub=="time_table")? "active":"";?>"><a href="<?php echo MASTER_URL;?>time-table-manage.php" title="Time Table">Time Table</a></li> 
                    
                    
                    <li class="<?php echo (menu_sub=="past_student_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>past-student-information-manage.php" title="Past Student Information">Past Student Information</a></li>
                        <li class="<?php echo (menu_sub=="staff_information")? "active":"";?>"><a href="<?php echo MASTER_URL;?>staff-information-manage.php" title="Staff Information">Staff Information</a></li>     
                        
					</ul>
				</li>
                
             
             <li class="sub js-submenu <?php echo (menu_main=="report")? "active":"";?>" >
					<div id="report" <?php echo (menu_main=="report")? "":"onClick=menuShowHide('report');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Report<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="report")? "display-block":"";?>">
						
                        <li class="<?php echo (menu_sub=="class_wise_student_attendance")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-attendance.php" title="Class Wise Student Attendance">Class Wise Student Attendance</a></li>
                        
                        <li class="<?php echo (menu_sub=="class_wise_student_list")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-list.php" title="Class Wise Student List">Class Wise Student List</a></li>
                        
                        <li class="<?php echo (menu_sub=="student_birthday_list")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-birthday-list.php" title="Student Birthday List">Student Birthday List</a></li>
                        
                     <li class="<?php echo (menu_sub=="student_address")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-address-list.php" title="Student Address List">Student Address List</a></li>   
                     <li class="<?php echo (menu_sub=="category_wise_student_strength")? "active":"";?>"><a href="<?php echo REPORT_URL;?>category-wise-student-strength.php" title="Category Wise Student Strength">Category Wise Student Strength</a></li>
                     
                     <li class="<?php echo (menu_sub=="subject_wise_passing_marks")? "active":"";?>"><a href="<?php echo REPORT_URL;?>subject-wise-passing-marks.php" title="Subject Wise Passing Marks">Subject Wise Passing Marks</a></li> 
                     
                     <li class="<?php echo (menu_sub=="class_wise_total_fee")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-total-fee.php" title="Class Wise Total Fee">Class Wise Total Fee</a></li>
                        
                   <li class="<?php echo (menu_sub=="student_progress_monthly")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-progress-monthly.php" title="Student Progress Monthly">Student Progress Monthly</a></li>
                   
                   
                   <li class="<?php echo (menu_sub=="student_bonafide")? "active":"";?>"><a href="<?php echo REPORT_URL;?>student-bonafide.php" title="Student Bonafide">Student Bonafide</a></li>
                   <li class="<?php echo (menu_sub=="date_wise_bonafide")? "active":"";?>"><a href="<?php echo REPORT_URL;?>date-wise-bonafide.php" title="Date Wise Bonafide">Date Wise Bonafide</a></li>
                   
                   <li class="<?php echo (menu_sub=="subject_wise_student")? "active":"";?>"><a href="<?php echo REPORT_URL;?>subject-wise-student.php" title="Subject Wise Student">Subject Wise Student</a></li>
                   <li class="<?php echo (menu_sub=="class_wise_student_category")? "active":"";?>"><a href="<?php echo REPORT_URL;?>class-wise-student-category.php" title="Class Wise Student Category">Class Wise Student Category</a></li>
                        
                  </ul>
				</li>   
                
              
              <li class="sub js-submenu <?php echo (menu_main=="blank_report")? "active":"";?>" >
					<div id="blank_report" <?php echo (menu_main=="blank_report")? "":"onClick=menuShowHide('blank_report');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Blank Reports<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="blank_report")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="student_signature_sheet")? "active":"";?>"><a href="<?php echo BLANK_REPORT_URL;?>student-signature-sheet-list.php" title="Student Signature Sheet">Student Signature Sheet</a></li>
                     <li class="<?php echo (menu_sub=="student_result_sheet_oral_test")? "active":"";?>"><a href="<?php echo BLANK_REPORT_URL;?>student-result-sheet-oral-test-list.php" title="Student Result Sheet Oral Test">Student Result Sheet Oral Test</a></li>
                        
                  </ul>
				</li>  
                
                
                
                
                <li class="sub js-submenu <?php echo (menu_main=="setup")? "active":"";?>" >
					<div id="setup" <?php echo (menu_main=="setup")? "":"onClick=menuShowHide('setup');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Setup<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="setup")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="exam_information")? "active":"";?>"><a href="<?php echo SETUP_URL;?>exam-information-manage.php" title="Exams Information">Exams Information</a></li>
                        <li class="<?php echo (menu_sub=="standard_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>standard-setup-manage.php" title="Standards Setup">Standards Setup</a></li>
                        <li class="<?php echo (menu_sub=="class_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>class-setup-manage.php" title="Class Setup">Class Setup</a></li>
                        <li class="<?php echo (menu_sub=="subject_information")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-information-manage.php" title="Subject Information">Subjects Information</a></li>
                        <li class="<?php echo (menu_sub=="class_grade_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>class-grade-setup-manage.php" title="Class or Grade Setup">Class or Grade Setup</a></li>
                        <!--<li class="<?php /*echo (menu_sub=="exam_setup_term_final")? "active":"";*/?>"><a href="<?php /*echo SETUP_URL;*/?>exam-setup-term-final-manage.php" title="Exam Setup Term/Final">Exam Setup Term/Final</a></li>-->
                        <li class="<?php echo (menu_sub=="subject_wise_total_passing_marks")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-wise-total-passing-marks-manage.php" title="Total and Passing Marks Setup">Total and Passing Marks Setup</a></li>
                        <!--<li class="<?php /*echo (menu_sub=="final_result_marks_setup")? "active":"";*/?>"><a href="<?php /*echo SETUP_URL;*/?>final-result-marks-setup-manage.php" title="Final Result Marks Setup">Final Result Marks Setup</a></li>-->
                        <li class="<?php echo (menu_sub=="subject_grade_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>subject-grade-setup-manage.php" title="Subject Grade Setup">Subject Grade Setup</a></li>
                        <li class="<?php echo (menu_sub=="organisation_name")? "active":"";?>"><a href="<?php echo SETUP_URL;?>organisation-name-manage.php" title="Organisation Name">Organisation Name</a></li>
                        <li class="<?php echo (menu_sub=="fee_category_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-category-setup-manage.php" title="Fee Category Setup">Fee Category Setup</a></li>
                        <li class="<?php echo (menu_sub=="fee_collection_type")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-collection-type-manage.php" title="Fee Collection Type">Fee Collection Type</a></li>
                        <li class="<?php echo (menu_sub=="fee_name_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-name-setup-manage.php" title="Fee Name Setup">Fee Name Setup</a></li>
                        <li class="<?php echo (menu_sub=="fee_structure_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>fee-structure-setup-manage.php" title="Fee Structure Setup">Fee Structure Setup</a></li>
                        <li class="<?php echo (menu_sub=="activities_name_setup")? "active":"";?>"><a href="<?php echo SETUP_URL;?>activities-name-setup-manage.php" title="Activities Name Setup">Activities Name Setup</a></li>
                         <li class="<?php echo (menu_sub=="paper_type")? "active":"";?>"><a href="<?php echo SETUP_URL;?>paper-type-manage.php" title="Paper Type">Paper Type</a></li>
                  </ul>
				</li>
                
               <li class="sub js-submenu <?php echo (menu_main=="semester_result")? "active":"";?>" >
					<div id="semester_result" <?php echo (menu_main=="semester_result")? "":"onClick=menuShowHide('semester_result');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Semester Result<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="semester_result")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="semester_result_structure")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>semester-result-structure-manage.php" title="Semester Result Structure">Semester Result Structure</a></li>
                        
						<li class="<?php echo (menu_sub=="student_mark_entry")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>student-mark-entry.php" title="Student Mark Entry">Student Mark Entry</a></li>
                        
                       <li class="<?php echo (menu_sub=="mark_sheet_semester")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>mark-sheet-semester-list.php" title="Mark Sheet Semester">Mark Sheet Semester</a></li>                         
                        
                    <li class="<?php echo (menu_sub=="indicator_setup")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-setup-manage.php" title="Indicator Setup">Indicator Setup</a></li>
                        <li class="<?php echo (menu_sub=="indicator_setup_2_b")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-setup-2-b-manage.php" title="Indicator Setup 2-B">Indicator Setup 2-B</a></li>
                        <li class="<?php echo (menu_sub=="activity_indicator")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>activity-indicator-manage.php" title="Activity Indicator">Activity Indicator</a></li>
                        <li class="<?php echo (menu_sub=="indicator_entry")? "active":"";?>"><a href="<?php echo SEMESTER_RESULT_URL;?>indicator-entry-manage.php" title="Indicator Entry">Indicator Entry</a></li>    
                        
                  </ul>
				</li> 
                
              <li class="sub js-submenu <?php echo (menu_main=="special_setup")? "active":"";?>" >
					<div id="special_setup"  <?php echo (menu_main=="special_setup")? "":"onClick=menuShowHide('special_setup');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Special Setup<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="special_setup")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="subjective_exam_info")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>subjective-exam-info-manage.php" title="Month Exam Info">Month Exam Info</a></li>
                        <li class="<?php echo (menu_sub=="test_name_setup")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>test-name-setup-manage.php" title="Test Name Setup">Test Name Setup</a></li>
                        <li class="<?php echo (menu_sub=="subject_remarks_setup")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>subject-remarks-setup-manage.php" title="Subject Remarks Setup">Subject Remarks Setup</a></li>
                        <li class="<?php echo (menu_sub=="special_exam_structure")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>special-exam-structure-manage.php" title="Special Exam Structure">Special Exam Structure</a></li>
                        <li class="<?php echo (menu_sub=="special_mark_entry")? "active":"";?>"><a href="<?php echo SPECIAL_SETUP_URL;?>special-mark-entry.php" title="Special Mark Entry">Special Mark Entry</a></li>
                        
                  	</ul>
				</li>  
              
              
              <li class="sub js-submenu <?php echo (menu_main=="notification")? "active":"";?>" >
					<div id="notification" <?php echo (menu_main=="notification")? "":"onClick=menuShowHide('notification');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Notification<i class="zmdi zmdi-plus plus"></i></span></div>
					<ul class="<?php echo (menu_main=="notification")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="emergency_message")? "active":"";?>"><a href="<?php echo NOTIFICATION_URL;?>emergency-message-manage.php" title="Emergency Message">Emergency Message</a></li>
                  </ul>
				</li>
              
              
              
              <li class="sub js-submenu <?php echo (menu_main=="cms")? "active":"";?>" >
					<div id="cms" <?php echo (menu_main=="cms")? "":"onClick=menuShowHide('cms');";?>><i class="zmdi zmdi-apps zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">CMS<i class="zmdi zmdi-plus plus"></i></span></div>
					
                    <ul class="<?php echo (menu_main=="cms")? "display-block":"";?>">
						<li class="<?php echo (menu_sub=="home_page")? "active":"";?>"><a href="<?php echo CMS_URL;?>home-page.php?mode=edit" title="Home">Home</a></li>
						<li class="<?php echo (menu_sub=="about_us")? "active":"";?>"><a href="<?php echo CMS_URL;?>about-us.php?mode=edit" title="About Us">About Us</a></li>
                        <li class="<?php echo (menu_sub=="contact")? "active":"";?>"><a href="<?php echo CMS_URL;?>contact.php?mode=edit" title="Contact">Contact</a></li>
                        
                     <li class="<?php echo (menu_sub=="photo_gallery")? "active":"";?>"><a href="<?php echo CMS_URL;?>photo-gallery-manage.php" title="Contact">Photo Gallery</a></li>   
                        
                  	</ul>
				</li>
              
              
              
              <li class="<?php echo (menu_main=="settings")? "active":"";?>"><a href="<?php echo SETTINGS_URL;?>settings.php?mode=edit" title="Settings"><i class="fa fa-fw fa-gears icon"></i> <span class="hidden-xs hidden-sm">Settings</span></a></li>   
              
              
              <li><a href="<?php echo LOGIN_URL;?>logout.php" title="Log Out"><i class="zmdi zmdi-power zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Log Out</span></a></li> 
				
              <!--<li class="sub js-submenu">
					<div><i class="zmdi zmdi-chart zmdi-hc-fw icon"></i> <span class="hidden-xs hidden-sm">Graphs <span class="label label-info">New</span><i class="zmdi zmdi-plus plus"></i></span></div>
					<ul>
						<li><a href="graphs-flot.html" title="#">Flot Charts</a></li>
						<li><a href="graphs-morris.html" title="#">Morris.js Charts</a></li>
						<li><a href="graphs-chartjs.html" title="#">Chart.js</a></li>
						<li><a href="graphs-chartist.html" title="#">Chartist</a></li>
						<li><a href="graphs-rickshaw.html" title="#">Rickshaw <span class="label label-info">New</span></a></li>
						<li><a href="graphs-peity.html" title="#">Peity <span class="label label-info">New</span></a></li>
						<li><a href="graphs-sparkline.html" title="#">Sparkline <span class="label label-info">New</span></a></li>
					</ul>
				</li>-->
			</ul>
		</nav>

	</aside>

	<!-- Page Wrap -->
	<div class="pageWrap">
<?php /*if(menu_sub!="")
			{
				$section=$this->Direct_Query("SELECT stn_id FROM ".DB_PREFIX."section WHERE stn_sub_menu_name='".menu_sub."'");
				$permission=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."permission WHERE per_stn_id='".$section[0]['stn_id']."' and per_usr_id='".Clscommon::Get_Session(ADMIN_LOGIN_USER_ID)."'");
				
				Clscommon::Set_Session('per_view',Clscommon::Get_Value($permission[0]['per_view']));
				Clscommon::Set_Session('per_add',Clscommon::Get_Value($permission[0]['per_add']));
				Clscommon::Set_Session('per_edit',Clscommon::Get_Value($permission[0]['per_edit']));
				Clscommon::Set_Session('per_delete',Clscommon::Get_Value($permission[0]['per_delete']));
				Clscommon::Set_Session('per_print',Clscommon::Get_Value($permission[0]['per_print']));
			}
			else
			{
				Clscommon::Remove_Session('per_view');
				Clscommon::Remove_Session('per_add');
				Clscommon::Remove_Session('per_edit');
				Clscommon::Remove_Session('per_delete');
				Clscommon::Remove_Session('per_print');
			}*/
		?>
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