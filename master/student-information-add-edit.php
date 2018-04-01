<?php define("menu_main","master");
	  define("menu_sub","student_information");
require_once("../includes/top.php");
class Student_Information_Add_Edit extends DataBase
{
	function All_Student_Information_Add_Edit()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();	
?>
<div class="pageContent extended">
			<div class="container">
				
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Student Information
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li><a href="<?php echo MASTER_URL;?>student-information-manage.php">Manage Student Information</a></li>
                    <li class="active"><?php echo ucwords($_GET['mode']);?> Student Information</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn"></div>
      </div>
			
	  <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))
        {
         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."student WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");
		 /* $GRNo=$this->Direct_Query("SELECT max(stdGrNo) as stdGrNo FROM ".DB_PREFIX."student WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."'");
		  $GRNo=Common_Nijsol_Class::Get_Value($GRNo[0]['stdGrNo'])+1; */
    ?>   	
            <div class="box">
                    <form class="form-student" method="post" action="student-information-db.php">
					<div class="row">
						<div class="col-xs-12 col-lg-12">
							<ul class="nav nav-tabs" role="tablist">
								<li id="tab1" role="presentation" class="active"><a href="#basic-details" id="tab11" aria-controls="tab-item-1" role="tab" data-toggle="tab">1. Basic Details</a></li>
								<li id="tab2" role="presentation"><a href="#admission-details" aria-controls="tab-item-2" id="tab22" role="tab" data-toggle="tab">2. Admission Details</a></li>
								<li id="tab3" role="presentation"><a href="#other-information" aria-controls="tab-item-3" id="tab33" role="tab" data-toggle="tab">3. Other Information</a></li>
							</ul>

							<div class="tab-content">
                            
                            <!--First Tab Of Student-->
								<div role="tabpanel" class="tab-pane fade in active" id="basic-details">
							
                         <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdGrNo">GR. No.</label>
									<input type="text" class="form-control" id="stdGrNo" name="stdGrNo" placeholder="GR. No." value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdGrNo']); ?>" onkeypress="return Is_Number(event);">
								</div>
							</div>
                            
                            
                           <?php if(!empty($_GET['id'])){?> 
                            <div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label for="stdUid">Apps. User Name</label>
									<input type="text" class="form-control" id="stdUid" name="stdUid" placeholder="Apps. User Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdUid']);?>" readonly>
								</div>
							</div>
                            
                           <div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label for="stdPass">Apps. Password</label>
									<input type="text" class="form-control" id="stdPass" name="stdPass" placeholder="Apps. Password" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdPass']);?>">
								</div>
							</div>
                          <?php }?>    
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdSurname">Surname</label>
									<input type="text" class="form-control" id="stdSurname" name="stdSurname" placeholder="Surname" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdSurname']) ?>">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdStudentName">Student's Name</label>
									<input type="text" class="form-control" id="stdStudentName" name="stdStudentName" placeholder="Student's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdStudentName']) ?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdFatherName">Father's Name</label>
									<input type="text" class="form-control" id="stdFatherName" name="stdFatherName" placeholder="Father's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdFatherName']) ?>">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdMotherName">Mother's Name</label>
									<input type="text" class="form-control" id="stdMotherName" name="stdMotherName" placeholder="Mother's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdMotherName']) ?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="stdAddress">Address</label>
									<textarea id="stdAddress" name="stdAddress" class="form-control" rows="3" placeholder="Address"><?php echo Common_Nijsol_Class::Get_Value($result[0]['stdAddress']);?></textarea>
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
                        <div class="col-xs-12 col-sm-6">
								<div class="form-group multiple-select">
									<label for="stdTaluka">Taluka</label>
									<input type="text" class="form-control" id="stdTaluka" name="stdTaluka" placeholder="Taluka" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdTaluka']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                                    
                              
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdCity">City</label>
									<input type="text" class="form-control" id="stdCity" name="stdCity" placeholder="City" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdCity']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px" required>
								</div>
							</div>
                            
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdDistrict">District</label>
									<input type="text" class="form-control" id="stdDistrict" name="stdDistrict" placeholder="District" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdDistrict']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdPinCode">PinCode</label>
									<input type="text" class="form-control" id="stdPinCode" name="stdPinCode" placeholder="PinCode" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdPinCode']) ?>" maxlength="6" onkeypress="return Is_Number(event);">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6 i">
								<div class="form-group">
									<label for="stdGender">Gender</label>
									<select class="select2 js-select2 form-control" id="stdGender" name="stdGender">
										<option value="">- Select Gender -</option>
										<option value="M" <?php if(Common_Nijsol_Class::Get_Value($result[0]['stdGender'])=="M"){echo "selected";} ?>>Male</option>
                                        <option value="F" <?php if(Common_Nijsol_Class::Get_Value($result[0]['stdGender'])=="F"){echo "selected";} ?>>Female</option>
									</select>
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6 i">
								<div class="form-group">
									<label for="stdBloodGroup">Blood Group</label>
									<select class="select2 js-select2 form-control" id="stdBloodGroup" name="stdBloodGroup">
										<option value="">- Select Blood Group -</option>
										<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."blood_group", "bgId", "bgName",$result[0]['stdBloodGroup'], "", "bgId");?>
									</select>
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdOfficeNo">Office No</label>
									<input type="text" class="form-control" id="stdOfficeNo" name="stdOfficeNo" placeholder="Office No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdOfficeNo']) ?>" onkeypress="return Is_Number(event);">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdHomeNo">Home No</label>
									<input type="text" class="form-control" id="stdHomeNo" name="stdHomeNo" placeholder="Home No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdHomeNo']) ?>" onkeypress="return Is_Number(event);">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdMobileNo">Mobile No.</label>
									<input type="text" class="form-control" id="stdMobileNo" name="stdMobileNo" placeholder="Mobile No." value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdMobileNo']) ?>" maxlength="10" onkeypress="return Is_Number(event);" required>
								</div>
							</div>
                            
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdFatherOccupation">Father Occupation</label>
									<input type="text" class="form-control" id="stdFatherOccupation" name="stdFatherOccupation" placeholder="Father Occupation" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdFatherOccupation']) ?>">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdMotherOccupation">Mother Occupation</label>
									<input type="text" class="form-control" id="stdMotherOccupation" name="stdMotherOccupation" placeholder="Mother Occupation" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdMotherOccupation']) ?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
                        	<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdBirthDate">Birth Date</label>
                                    <div id="stdBirthDate" class="input-group date">
									<input type="text" class="form-control" id="stdBirthDate" name="stdBirthDate" placeholder="Birth Date" value="<?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stdBirthDate']) ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						       </div>   
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdBirthPlace">Birth Place</label>
									<input type="text" class="form-control" id="stdBirthPlace" name="stdBirthPlace" placeholder="Birth Place" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdBirthPlace']) ?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdCast">Cast</label>
									<input type="text" class="form-control" id="stdCast" name="stdCast" placeholder="Cast" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdCast']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdReligion">Religion</label>
									<input type="text" class="form-control" id="stdReligion" name="stdReligion" placeholder="Religion" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdReligion']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdCategory">Category</label>
									<select class="select2 js-select2 form-control" id="stdCategory" name="stdCategory">
										<option value="">- Select Category -</option>
                                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."category", "catId", "catName",$result[0]['stdCategory'], "", "catId"); ?>
									</select>
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdEtc">Other Information</label>
									<input type="text" class="form-control" id="stdEtc" name="stdEtc" placeholder="Other Information" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdEtc']) ?>">
								</div>
							</div>
						</div>
                        
                        
                        
                        
                        
                 <div class="row">
                       <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                             <button type="button" onClick="Set_Tabs(2);" class="<?php echo BTN_ADD;?>">Next</button> 
                            </div>
                        </div>
                  </div>       
                               
                               
                                                
								</div>
                                
                                
                                
                            <!--Second Tab Of Student-->
								<div role="tabpanel" class="tab-pane fade" id="admission-details">
							
                            <div class="row customSelectWrap">
							
                            <div class="col-xs-12 col-sm-3 i">
								<div class="form-group">
									<label for="stdAdmissionStandard">Admission Standard</label>
									<select class="select2 js-select2 form-control" id="stdAdmissionStandard" name="stdAdmissionStandard" onChange="OnChanges_Standard('<?php echo MASTER_URL;?>',this.value,'');">
										<option disabled selected>- Select Standard -</option>
										<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result[0]['stdAdmissionStandard'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId");?>
									</select>
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-2 i">
								<div class="form-group">
									<label for="stdAdmissionClass">Class</label>
									<select class="select2 js-select2 form-control" id="stdAdmissionClass" name="stdAdmissionClass">
										<option disabled selected>- Select Class -</option>
										
									</select>
								</div>
							</div>
                            
                            
                            <div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label for="stdAdmissionDate">Admission Date</label>
                                     <div id="stdAdmissionDate" class="input-group date">
                                    <input id="stdAdmissionDate" name="stdAdmissionDate" class="form-control datepicker" placeholder="Select date" type="text" value="<?php echo (!empty($_GET['id'])?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stdAdmissionDate']):date("d-m-Y"));?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
       </div>  
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label for="stdLastSchool">Last School</label>
									<input type="text" class="form-control" id="stdLastSchool" name="stdLastSchool" placeholder="Last School" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdLastSchool']);?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row customSelectWrap">
							
                            <div class="col-xs-12 col-sm-3 i">
								<div class="form-group">
									<label for="stdCurrentStandard">Current Standard</label>
									<select class="select2 js-select2 form-control" id="stdCurrentStandard" name="stdCurrentStandard" onChange="OnChanges_Current_Standard('<?php echo MASTER_URL;?>',this.value,'','','','','');">
										<option disabled selected>- Select Standard -</option>
										<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result[0]['stdCurrentStandard'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId"); ?>
									</select>
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-2 i">
								<div class="form-group">
									<label for="stdCurrentClass">Class</label>
									<select class="select2 js-select2 form-control" id="stdCurrentClass" name="stdCurrentClass">
										<option disabled selected>- Select Class -</option>
										
									</select>
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-2">
								<div class="form-group">
									<label for="stdRollNo">Roll No</label>
									<input type="text" class="form-control" id="stdRollNo" name="stdRollNo" placeholder="Roll No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdRollNo']);?>" onkeypress="return Is_Number(event);">
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-2">
								<div class="form-group">
									<label for="stdRegNo">Reg. No.</label>
                                    
									<input type="text" class="form-control" id="stdRegNo" name="stdRegNo" placeholder="Reg. No." value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdRegNo']);?>">
								</div>
							</div>
                            
                            <div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label for="stdRegDate">Reg. Date</label>
                                    <div id="stdRegDate" class="input-group date">
                                    <input id="stdRegDate" name="stdRegDate" class="form-control datepicker" placeholder="Select date" type="text" value="<?php echo (!empty($_GET['id'])?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stdRegDate']):date("d-m-Y"));?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
       </div> 
								</div>
							</div>
						</div>
                        
                        
                        
                <div class="row"> 
                    
                     <div class="col-xs-12 col-sm-4 i">
                        <div class="form-group checkboxes" id="div_stdCompulsarySubject"></div>
                     </div>
                     
                     <div class="col-xs-12 col-sm-4 i">
                        <div class="form-group checkboxes" id="div_stdGroupedSubject"></div>
                     </div>
                     
                     <div class="col-xs-12 col-sm-4 i">
                        <div class="form-group checkboxes" id="div_stdOptionalSubject"></div>
                     </div>
                 
                </div>    
                        
                        
                        
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdReferenceName">Reference Name</label>
									<input type="text" class="form-control" id="stdReferenceName" name="stdReferenceName" placeholder="Reference Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdReferenceName']);?>">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdReferenceNumber">Reference No</label>
									<input type="text" class="form-control" id="stdReferenceNumber" name="stdReferenceNumber" placeholder="Reference No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdReferenceNumber']);?>" maxlength="10" onkeypress="return Is_Number(event);">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdUniqueId">Unique Id No</label>
									<input type="text" class="form-control" id="stdUniqueId" name="stdUniqueId" placeholder="Unique Id No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdUniqueId']);?>">
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdAadhaarId">Aadhaar No</label>
									<input type="text" class="form-control" id="stdAadhaarId" name="stdAadhaarId" placeholder="Aadhaar No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdAadhaarId']);?>">
								</div>
							</div>
						</div>
                         
                         
                      
                         <div class="row">
                       <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                             <button type="button" onClick="Set_Tabs(1);" class="<?php echo BTN_ADD;?>">Back</button> 
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                             <button type="button" onClick="Set_Tabs(3);" class="<?php echo BTN_ADD;?>">Next</button> 
                            </div>
                        </div>
                  </div>   
                            
                            
                                    
                                    
								</div>
                                
                                
                                
                            <!--Third Tab Of Student-->
								<div role="tabpanel" class="tab-pane fade" id="other-information">
									
                         <div class="row">
                            <div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="stdEmail">Email</label>
									<input type="text" class="form-control" id="stdEmail" name="stdEmail" placeholder="Email" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdEmail']);?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                <label for="stdNative">Native</label>
									<input type="text" class="form-control" id="stdNative" name="stdNative" placeholder="Native" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdNative']);?>">
                                </div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdPrevPresents">Admission in between Term, Then Previous Presents</label>
									<input type="text" class="form-control" id="stdPrevPresents" name="stdPrevPresents" placeholder="Admission in between Term, Then Previous Presents" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdPrevPresents']);?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row customSelectWrap">
							<div class="col-xs-12 col-sm-6 i">
                                <div class="form-group">
                                <label for="stdNationality">Nationality</label>
                                <select class="select2 js-select2 form-control" id="stdNationality" name="stdNationality">
                                    <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."nation", "nationId", "nationName",$result[0]['stdNationality'], "", "nationId"); ?>
                                </select>
                                </div>
							</div>
                            <div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="stdPrevWorkingDays">Admission in between Term, Then Previous Working Days</label>
									<input type="text" class="form-control" id="stdPrevWorkingDays" name="stdPrevWorkingDays" placeholder="Admission in between Term, Then Previous Working Days" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdPrevWorkingDays']);?>">
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
							<div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                <label for="stdRemarks">Remarks</label>
									<textarea id="stdRemarks" name="stdRemarks" class="form-control" rows="2" placeholder="Remarks"><?php echo Common_Nijsol_Class::Get_Value($result[0]['stdRemarks']);?></textarea>
                                </div>
							</div>
                            
                            
                            <div class="col-xs-12 col-sm-3 i">
                                <div class="form-group checkboxes">
                                <label>&nbsp;</label>
                                <label>
                                  <input type="checkbox" id="stdPhysicalHandicap" name="stdPhysicalHandicap" <?php echo ($result[0]['stdPhysicalHandicap']==1)?'checked="checked"':'';?> value="1">
                                    <span>Physical Handicap</span>
                                </label>
                                </div>
							</div>
                            <div class="col-xs-12 col-sm-3 i">
								<div class="form-group checkboxes">
                                <label>&nbsp;</label>
                                <label>
                                  <input type="checkbox" id="stdIsHosteller" name="stdIsHosteller" <?php echo ($result[0]['stdIsHosteller']==1)?'checked="checked"':'';?> value="1" >
                                    <span>Is Hostler ?</span>
                                </label>
                                </div>
							</div>
                            
						</div>
                        
                        
                        <div class="row customSelectWrap">
							<div class="col-xs-12 col-sm-3">
                                <div class="form-group">
                                <label for="stdFeeInPercentage">Fee In Percentage</label>
									<input type="text" class="form-control" id="stdFeeInPercentage" name="stdFeeInPercentage" placeholder="100" value="<?php echo (!empty(Common_Nijsol_Class::Get_Value($result[0]['stdFeeInPercentage'])) ? Common_Nijsol_Class::Get_Value($result[0]['stdFeeInPercentage']) : "100");?>" required maxlength="3" onkeypress="return Is_Number(event);">
                                </div>
							</div>
                            <div class="col-xs-12 col-sm-3 i">
								<div class="form-group">
									<label for="stdFeeCategory">Fees Category</label>
									<select class="select2 js-select2 form-control" id="stdFeeCategory" name="stdFeeCategory" onChange="OnChanges_Fee_Category('<?php echo MASTER_URL;?>',this.value,'','');">
										<option disabled selected>- Fees Category -</option>
										<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."fee_category_setup", "fcsId", "fcsName",$result[0]['stdFeeCategory'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "fcsId"); ?>
									</select>
								</div>
							</div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                <label for="stdReasonFeeException">Reason For Fee Exception</label>
									<input type="text" class="form-control" id="stdReasonFeeException" name="stdReasonFeeException" placeholder="Reason For Fee Exception" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdReasonFeeException']);?>">
                                </div>
							</div>
						</div>
                        
                        
                        <!--<div class="row customSelectWrap">
                        	<div class="col-xs-12 col-sm-3 i">
								<div class="form-group checkboxes">
                                <label>
                                  <input type="checkbox" id="stdValidFeeCollection" name="stdValidFeeCollection" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdValidFeeCollection']);?>" <?php echo ($result[0]['stdValidFeeCollection']==1)?'checked="checked"':'';?>>
                                    <span>Valid Fee Collection</span>
                                </label>
								</div>
							</div>
                            <div class="col-xs-12 col-sm-3 i">
								<div class="form-group checkboxes">
                                <label>
                                  <input type="checkbox" id="stdValidFeeHead" name="stdValidFeeHead" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stdValidFeeHead']);?>" <?php echo ($result[0]['stdValidFeeHead']==1)?'checked="checked"':'';?>>
                                    <span>Valid Fee Heads</span>
                                </label>
								</div>
							</div>
                      </div>-->
                           
                     
                 <div class="row"> 
                    
                     <div class="col-xs-12 col-sm-3 i">
                        <div class="form-group checkboxes" id="div_stdValidFeeCollection"></div>
                     </div>
                     
                     <div class="col-xs-12 col-sm-3 i">
                       <div class="form-group checkboxes">
                        <label for="stdValidFeeHead"><strong>Valid Fee Head</strong></label>
								<?php $result_freecol=$this->Get_Rows(DB_PREFIX."organisation_name"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."'",'orgId, orgShortName','orgId'); 
						
						$stdValidFeeHead=explode(",",$result[0]['stdValidFeeHead']);
								  foreach($result_freecol as $_result_freecol)
                                { ?>
    <label>
    <input type="checkbox" id="stdValidFeeHead<?php echo $_result_freecol['orgId'];?>" name="stdValidFeeHead[<?php echo $_result_freecol['orgId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_freecol['orgId'], $stdValidFeeHead))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_freecol['orgShortName']);?></span>
    </label>
    			<?php }?>
                	</div>	
                     </div>
                     
                </div>        
                               
                               
                     
                     <div class="row">
							<div class="col-xs-12 col-md-6"> 
                    		 <label for="stfPhoto">Student's Photograph</label>	       
                            <div class="form-group dropzone" id="uplaodFile"></div> 
                    </div>
                    
                    <div class="col-xs-12 col-md-3">
                     <label>&nbsp;</label>	 
                        <?php if(!empty($_GET['id']) && !empty($result[0]['stdPhoto']))
									{
										Common_Nijsol_Class::Set_Session('student-photo',$result[0]['stdPhoto']);
										?>
									  <div id="hideImage" class="col-sm-2 dz-default dz-message" style="border: 1px solid #eee; padding:5px; margin-left:15px;height:170px;width:170px">
										  <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview text-center">
											<img style="max-height:150px; max-width:150px" src="<?php echo FILE_UPLOAD_PATH.Common_Nijsol_Class::Get_Value($result[0]['stdPhoto']);?>" />
										  </div>
                                   </div>
                                   <div style="clear:both"></div>
                                   <div id="removeButton">
                                            <a class="dz-remove"  style="background-image: linear-gradient(to bottom,#fafafa,#eee);border-radius: 2px;border: 1px solid #eee; text-decoration: none;display: block;padding: 4px 5px;text-align: center;color: #aaa;margin-left:15px; cursor:pointer; width:171px;" onClick="Remove_Photo(<?php echo $_GET['id'];?>);">Remove file</a></div>
										
                                          
                                    
							   <?php }?>
                    </div>
						</div>          
                               
                        
<div class="row">
    <?php if(!empty($_GET['id']))
	{ ?>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="editMessage">Edit Message</label>
			<input type="text" class="form-control" id="editMessage" name="editMessage" placeholder="Edit Message" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['editMessage']) ?>" >
		</div>
	</div>
 <?php }?>
</div> 
                          
                          
                          <div class="row">
                        
                        
                        <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                             <button type="button" onClick="Set_Tabs(2);" class="<?php echo BTN_ADD;?>">Back</button> 
                            </div>
                        </div>
                        
                        
                      	<div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                            <input type="hidden" name="type" id="type" value="<?php echo $_GET['mode'];?>">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">	
            
                                <button type="submit" class="<?php echo BTN_ADD;?>">Submit</button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="form-group"><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-information-manage.php');">Close</button>
                            </div>
                        </div>
                    </div>
                          
                          
                               
                                    
								</div>
							</div>
						</div>
					</div>
                    
                   </form>
                    
				</div>
            
            
    <?php }?>        
           </div>
		</div>

<?php $common_bottom = new Common_Bottom();
$common_bottom->ALL_Common_Bottom();
?>


<script src="<?php echo SITE_URL;?>js/student-information-manage.js"></script>
<!-- Dropzone Start -->
<link href="<?php echo SITE_URL;?>dropzone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo SITE_URL;?>dropzone/photo-dropzone.js"></script>

<script language="javascript">
$(document).ready(function(e) {
Dropzone.autoDiscover = false;
   var myDropzoneuimage = $("#uplaodFile").dropzone({ url: "student-dropzone.php",
 acceptedFiles:"image/*",
/* acceptedFiles:".csv, .ms-excel, .comma-separated-values",*/
 dictDefaultMessage:"",
/*previewsContainer: ".upload-list",
previewTemplate: "", */
maxFilesize: 20, 
maxFiles:1, 
maxfilesexceeded: function(file)
{
	  alert("You have uploaded more than 1 Photo. Only the first file will be uploaded!");
	  this.removeFile(file);
},
createImageThumbnails:true,
addRemoveLinks: false,
accept: function(file, done) {
 return done();
},
init: function() {
 this.on("error", function(file, response) {
  /*$('.dz-file-preview').hide();
     alert(response);
     this.removeFile(file);*/
    });
 this.on("success", function(file, serverFileName) {
  /*$('.file-drop-target').removeClass("over");*/
    });
 this.on("complete", function(file, serverFileName) {
	 /*this.removeFile(file);*/
    });
}  
 });
 
}); 
</script>
<!-- End -->

<?php if($_GET['mode']=='edit')
{
?>
<script language="javascript">
	OnChanges_Standard('<?php echo MASTER_URL;?>',<?php echo $result[0]['stdAdmissionStandard'];?>,<?php echo $result[0]['stdAdmissionClass'];?>);
	
	OnChanges_Current_Standard('<?php echo MASTER_URL;?>',<?php echo $result[0]['stdCurrentStandard'];?>,<?php echo $result[0]['stdCurrentClass'];?>,'<?php echo $result[0]['stdCompulsarySubject'];?>','<?php echo $result[0]['stdGroupedSubject'];?>','<?php echo $result[0]['stdOptionalSubject'];?>',<?php echo $_GET['id'];?>);
	
OnChanges_Fee_Category('<?php echo MASTER_URL;?>',<?php echo $result[0]['stdFeeCategory'];?>,'<?php echo $result[0]['stdValidFeeCollection'];?>',<?php echo $_GET['id'];?>);
	
</script>
<?php }
?>	

<?php }
}
$student_information_add_edit = new Student_Information_Add_Edit();
$student_information_add_edit->All_Student_Information_Add_Edit();	
?>