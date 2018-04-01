<?php define("menu_main","master");	  define("menu_sub","past_student_information");require_once("../includes/top.php");class Past_Student_Information_Add_Edit extends DataBase{	function All_Past_Student_Information_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Past Student Information </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li><a href="<?php echo MASTER_URL;?>past-student-information-manage.php">Manage Past Student Information</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Past Student Information</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))        {			$result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."past_student WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and pstdStudentId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");         $result_std=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."student WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");		      ?>
    <div class="box">
      <form class="form-student" method="post" action="past-student-information-db.php">
        <div class="row">
          <div class="col-xs-12 col-lg-12">
            <ul class="nav nav-tabs" role="tablist">
              <li id="tab1" role="presentation" class="active"><a href="#basic-details" id="tab11" aria-controls="tab-item-1" role="tab" data-toggle="tab">1. Basic Details</a></li>
              <li id="tab2" role="presentation"><a href="#leaving-information" aria-controls="tab-item-2" id="tab22" role="tab" data-toggle="tab">2. Leaving Information</a></li>
              <li id="tab3" role="presentation"><a href="#other-information" aria-controls="tab-item-3" id="tab33" role="tab" data-toggle="tab">3. Other Information</a></li>
            </ul>
            <div class="tab-content"> <!--First Tab Of Student-->
              <div role="tabpanel" class="tab-pane fade in active" id="basic-details">
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <label for="stdGrNo">GR. No.</label>
                      <input type="text" class="form-control" id="stdGrNo" name="stdGrNo" placeholder="GR. No." value="<?php if(!empty($_GET['id'])){echo Common_Nijsol_Class::Get_Value($result_std[0]['stdGrNo']);}else{echo 0;} ?>" onkeypress="return Is_Number(event);">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdSurname">Surname</label>
                      <input type="text" class="form-control" id="stdSurname" name="stdSurname" placeholder="Surname" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdSurname']) ?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdStudentName">Student's Name</label>
                      <input type="text" class="form-control" id="stdStudentName" name="stdStudentName" placeholder="Student's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdStudentName']) ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdFatherName">Father's Name</label>
                      <input type="text" class="form-control" id="stdFatherName" name="stdFatherName" placeholder="Father's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdFatherName']) ?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdMotherName">Mother's Name</label>
                      <input type="text" class="form-control" id="stdMotherName" name="stdMotherName" placeholder="Mother's Name" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdMotherName']) ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <label for="stdAddress">Address</label>
                      <textarea id="stdAddress" name="stdAddress" class="form-control" rows="3" placeholder="Address"><?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdAddress']);?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdTaluka">Taluka</label>
                      <input type="text" class="form-control" id="stdTaluka" name="stdTaluka" placeholder="Taluka" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdTaluka']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdCity">City</label>
                      <input type="text" class="form-control" id="stdCity" name="stdCity" placeholder="City" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdCity']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdDistrict">District</label>
                      <input type="text" class="form-control" id="stdDistrict" name="stdDistrict" placeholder="District" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdDistrict']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdPinCode">PinCode</label>
                      <input type="text" class="form-control" id="stdPinCode" name="stdPinCode" placeholder="PinCode" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdPinCode']) ?>" maxlength="6" onkeypress="return Is_Number(event);">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 i">
                    <div class="form-group">
                      <label for="stdGender">Gender</label>
                      <select class="select2 js-select2 form-control" id="stdGender" name="stdGender">
                        <option value="">- Select Gender -</option>
                        <option value="M" <?php if(Common_Nijsol_Class::Get_Value($result_std[0]['stdGender'])=="M"){echo "selected";} ?>>Male</option>
                        <option value="F" <?php if(Common_Nijsol_Class::Get_Value($result_std[0]['stdGender'])=="F"){echo "selected";} ?>>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 i">
                    <div class="form-group">
                      <label for="stdBloodGroup">Blood Group</label>
                      <select class="select2 js-select2 form-control" id="stdBloodGroup" name="stdBloodGroup">
                        <option value="">- Select Blood Group -</option>
                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."blood_group", "bgId", "bgName",$result_std[0]['stdBloodGroup'], "", "bgId");?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdMobileNo">Mobile No.</label>
                      <input type="text" class="form-control" id="stdMobileNo" name="stdMobileNo" placeholder="Mobile No." value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdMobileNo']) ?>" maxlength="10" onkeypress="return Is_Number(event);">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdHomeNo">Home No</label>
                      <input type="text" class="form-control" id="stdHomeNo" name="stdHomeNo" placeholder="Home No" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdHomeNo']) ?>" onkeypress="return Is_Number(event);">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdFatherOccupation">Father Occupation</label>
                      <input type="text" class="form-control" id="stdFatherOccupation" name="stdFatherOccupation" placeholder="Father Occupation" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdFatherOccupation']) ?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdMotherOccupation">Mother Occupation</label>
                      <input type="text" class="form-control" id="stdMotherOccupation" name="stdMotherOccupation" placeholder="Mother Occupation" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdMotherOccupation']) ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdBirthDate">Birth Date</label>
                      <div id="stdBirthDate" class="input-group date">
                        <input type="text" class="form-control" id="stdBirthDate" name="stdBirthDate" placeholder="Birth Date" value="<?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result_std[0]['stdBirthDate']) ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdBirthPlace">Birth Place</label>
                      <input type="text" class="form-control" id="stdBirthPlace" name="stdBirthPlace" placeholder="Birth Place" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdBirthPlace']) ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdCast">Cast</label>
                      <input type="text" class="form-control" id="stdCast" name="stdCast" placeholder="Cast" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdCast']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdReligion">Religion</label>
                      <input type="text" class="form-control" id="stdReligion" name="stdReligion" placeholder="Religion" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdReligion']) ?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdCategory">Category</label>
                      <select class="select2 js-select2 form-control" id="stdCategory" name="stdCategory">
                        <option value="">- Select Category -</option>
                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."category", "catId", "catName",$result_std[0]['stdCategory'], "", "catId"); ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdEtc">Sub Cast</label>
                      <input type="text" class="form-control" id="stdEtc" name="stdEtc" placeholder="Other Information" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdEtc']) ?>">
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
              <div role="tabpanel" class="tab-pane fade" id="leaving-information">
                <div class="row customSelectWrap">
                  <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                      <label for="pstdLCNo">Leaving Certificate No</label>
                      <input id="pstdLCNo" name="pstdLCNo" class="form-control" placeholder="Leaving Certificate No" type="text" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdLCNo']);?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3 i">
                    <div class="form-group">
                      <label for="stdAdmissionStandard">Admission Standard</label>
                      <select class="select2 js-select2 form-control" id="stdAdmissionStandard" name="stdAdmissionStandard" onChange="OnChanges_Standard('<?php echo MASTER_URL;?>',this.value,'');">
                        <option disabled selected>- Select Standard -</option>
                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result_std[0]['stdAdmissionStandard'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId");?>
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
                        <input id="stdAdmissionDate" name="stdAdmissionDate" class="form-control datepicker" placeholder="Select date" type="text" value="<?php echo (!empty($_GET['id'])?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result_std[0]['stdAdmissionDate']):date("d-m-Y"));?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
                    </div>
                  </div>
                </div>
                <div class="row customSelectWrap">
                  <div class="col-xs-12 col-sm-2 i">
                    <div class="form-group">
                      <label for="stdCurrentStandard">Leaving Standard</label>
                      <select class="select2 js-select2 form-control" id="stdCurrentStandard" name="stdCurrentStandard" onChange="OnChanges_Current_Standard('<?php echo MASTER_URL;?>',this.value,'');">
                        <option disabled selected>- Select Standard -</option>
                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result_std[0]['stdCurrentStandard'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId");?>
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
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="pstdLeavingDate">Leaving Date</label>
                      <div id="pstdLeavingDate" class="input-group date">
                        <input id="pstdLeavingDate" name="pstdLeavingDate" class="form-control datepicker" type="text" value="<?php if(!empty($_GET['id'])){echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['pstdLeavingDate']);}else {echo date("d-m-Y");}?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-5">
                    <div class="form-group">
                      <label for="pstdReason">Reason</label>
                      <input id="pstdReason" name="pstdReason" class="form-control" placeholder="Reason" type="text" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdReason']);?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="pstdFromWhenLeaving">From When in Leaving Standard</label>
                      <input id="pstdFromWhenLeaving" name="pstdFromWhenLeaving" class="form-control datepicker" placeholder="Select date" type="text" value="<?php if(!empty($result[0]['pstdFromWhenLeaving'])){echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['pstdFromWhenLeaving']);}else{echo date("d-m-Y");}?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdLastSchool">Last School</label>
                      <input type="text" class="form-control" id="stdLastSchool" name="stdLastSchool" placeholder="Last School" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdLastSchool']);?>" data-provide="typeahead" data-items="4" style="margin-bottom:0px">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="pstdRemarks">Remark</label>
                      <textarea id="pstdRemarks" name="pstdRemarks" class="form-control" placeholder="Remark" rows="5"><?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdRemarks']);?></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="pstdProgress">Progress</label>
                      <input type="text" class="form-control" id="pstdProgress" name="pstdProgress" placeholder="Progress" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdProgress']);?>">
                    </div>
                    <div class="form-group">
                      <label for="pstdConduct">Cunduct</label>
                      <input type="text" class="form-control" id="pstdConduct" name="pstdConduct" placeholder="Cunduct" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdConduct']);?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 i">
                    <div class="form-group checkboxes">
                      <label>
                        <input type="checkbox" id="pstdLCIssue" name="pstdLCIssue" <?php echo ($result[0]['pstdLCIssue']==1)?'checked="checked"':'';?> value="1">
                        <span>Is Leaving Certificate Issued ?</span> </label>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="pstdLCIssueDate">Issue Date of Leaving Certificate</label>
                      <input type="text" class="form-control datepicker" id="pstdLCIssueDate" name="pstdLCIssueDate" value="<?php if(!empty($result[0]['pstdLCIssueDate'])){echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['pstdLCIssueDate']);}else{echo date("d-m-Y");}?>">
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
                  <div class="col-xs-12 col-sm-3 i">
                    <div class="form-group checkboxes">
                      <label>
                        <input type="checkbox" id="stdPhysicalHandicap" name="stdPhysicalHandicap" <?php echo ($result_std[0]['stdPhysicalHandicap']==1)?'checked="checked"':'';?> value="1">
                        <span>Physical Handicap</span> </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdNative">Native</label>
                      <input type="text" class="form-control" id="stdNative" name="stdNative" placeholder="Native" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdNative']);?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdEmail">Email</label>
                      <input type="text" class="form-control" id="stdEmail" name="stdEmail" placeholder="Email" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdEmail']);?>">
                    </div>
                  </div>
                </div>
                <div class="row customSelectWrap">
                  <div class="col-xs-12 col-sm-6 i">
                    <div class="form-group">
                      <label for="stdNationality">Nationality</label>
                      <select class="select2 js-select2 form-control" id="stdNationality" name="stdNationality">
                        <option disabled selected>- Select Nationality -</option>
                        <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."nation", "nationId", "nationName",$result_std[0]['stdNationality'], "", "nationId"); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row customSelectWrap">
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label for="pstdPresenceDay">Total Presence Days</label>
                      <input type="text" class="form-control" id="pstdPresenceDay" name="pstdPresenceDay" placeholder="Total Presence Days" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdPresenceDay']);?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3 i">
                    <div class="form-group">
                      <label for="pstdWorkingDay">Total Working Days</label>
                      <input type="text" class="form-control" id="pstdWorkingDay" name="pstdWorkingDay" placeholder="Total Working Days" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['pstdWorkingDay']);?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                      <label for="stdReasonFeeException">Fee Percentage</label>
                      <input type="text" class="form-control" id="stdReasonFeeException" name="stdReasonFeeException" placeholder="Fee Percentage" value="<?php echo Common_Nijsol_Class::Get_Value($result_std[0]['stdReasonFeeException']);?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-6">
                    <label for="stdPhoto">Student's Photograph</label>
                    <div class="form-group dropzone" id="uplaodFile"></div>
                  </div>
                  <div class="col-xs-12 col-md-3">
                    <label>&nbsp;</label>
                    <?php if(!empty($_GET['id']) && !empty($result_std[0]['stdPhoto']))							{								Common_Nijsol_Class::Set_Session('student-photo',$result_std[0]['stdPhoto']);								?>
                    <div id="hideImage" class="col-sm-2 dz-default dz-message" style="border: 1px solid #eee; padding:5px; margin-left:15px;height:170px;width:170px">
                      <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview text-center"> <img style="max-height:150px; max-width:150px" src="<?php echo FILE_UPLOAD_PATH.Common_Nijsol_Class::Get_Value($result_std[0]['stdPhoto']);?>" /> </div>
                    </div>
                    <div style="clear:both"></div>
                    <div id="removeButton"> <a class="dz-remove"  style="background-image: linear-gradient(to bottom,#fafafa,#eee);border-radius: 2px;border: 1px solid #eee; text-decoration: none;display: block;padding: 4px 5px;text-align: center;color: #aaa;margin-left:15px; cursor:pointer; width:171px;" onClick="Remove_Photo(<?php echo $_GET['id'];?>);">Remove file</a></div>
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
                    <div class="form-group">
                      <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>past-student-information-manage.php');">Close</button>
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
<?php $common_bottom = new Common_Bottom();$common_bottom->ALL_Common_Bottom();?>
<script src="<?php echo SITE_URL;?>js/past-student-information-manage.js"></script><!-- Dropzone Start -->
<link href="<?php echo SITE_URL;?>dropzone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo SITE_URL;?>dropzone/photo-dropzone.js"></script><script language="javascript">$(document).ready(function(e) {Dropzone.autoDiscover = false;   var myDropzoneuimage = $("#uplaodFile").dropzone({ url: "past-student-dropzone.php", acceptedFiles:"image/*",/*acceptedFiles:".csv, .ms-excel, .comma-separated-values",*/ dictDefaultMessage:"",/*previewsContainer: ".upload-list",previewTemplate: "", */maxFilesize: 20, maxFiles:1, maxfilesexceeded: function(file){	  alert("You have uploaded more than 1 Photo. Only the first file will be uploaded!");	  this.removeFile(file);},createImageThumbnails:true,addRemoveLinks: false,accept: function(file, done) { return done();},init: function() { this.on("error", function(file, response) {  /*$('.dz-file-preview').hide();      alert(response);      this.removeFile(file);*/    }); this.on("success", function(file, serverFileName) {  /*$('.file-drop-target').removeClass("over");*/    }); this.on("complete", function(file, serverFileName) {	 /*this.removeFile(file);*/    });}   }); }); </script><!-- End -->
<?php if($_GET['mode']=='edit')    {    ?>
<script language="javascript">        OnChanges_Standard('<?php echo MASTER_URL;?>',<?php echo $result_std[0]['stdAdmissionStandard'];?>,<?php echo $result_std[0]['stdAdmissionClass'];?>);                OnChanges_Current_Standard('<?php echo MASTER_URL;?>',<?php echo $result_std[0]['stdCurrentStandard'];?>,<?php echo $result_std[0]['stdCurrentClass'];?>);                    </script>
<?php }    ?>
<?php }}$past_student_information_add_edit = new Past_Student_Information_Add_Edit();$past_student_information_add_edit->All_Past_Student_Information_Add_Edit();	?>
