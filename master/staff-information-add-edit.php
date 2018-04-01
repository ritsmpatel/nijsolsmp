<?php define("menu_main","master");	  define("menu_sub","staff_information");require_once("../includes/top.php");class Staff_Information_Add_Edit extends DataBase{	function All_Staff_Information_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Staff Information </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li><a href="<?php echo MASTER_URL;?>staff-information-manage.php">Manage Staff Information</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Staff Information</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))        {         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."staff WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stfId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'"); 	?>
    <form class="form-staff" method="post" action="staff-information-db.php">
      <div class="box rte">
        <?php if(!empty($_GET['id'])){?>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfSurname">Employee No</label>
              <input type="text" class="form-control" id="stfEmpNo" name="stfEmpNo" placeholder="Employee No" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfEmpNo']);?>" readonly>
            </div>
          </div>
        </div>
        <?php }?>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfSurname">Surname</label>
              <input type="text" class="form-control" id="stfSurname" name="stfSurname" placeholder="Surname" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfSurname']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfStaffName">Name</label>
              <input type="text" class="form-control" id="stfStaffName" name="stfStaffName" placeholder="Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfStaffName']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfFatherHusbandName">Father/Husband Name</label>
              <input type="text" class="form-control" id="stfFatherHusbandName" name="stfFatherHusbandName" placeholder="Father/Husband Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfFatherHusbandName']) ?>">
            </div>
          </div>
        </div>
        <div class="row customSelectWrap">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfBirthDate">Birth Date</label>
              <div id="stfBirthDate" class="input-group date">
                <input type="text" class="form-control" id="stfBirthDate" name="stfBirthDate" placeholder="Birth Date" value="<?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stfBirthDate']) ?>">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stfGender">Gender</label>
              <select class="select2 js-select2 form-control" id="stfGender" name="stfGender">
                <option value="">- Select Gender -</option>
                <option value="M" <?php if(Common_Nijsol_Class::Get_Value($result[0]['stfGender'])=="M"){echo "selected";} ?>>Male</option>
                <option value="F" <?php if(Common_Nijsol_Class::Get_Value($result[0]['stfGender'])=="F"){echo "selected";} ?>>Female</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stfBloodGroup">Blood Group</label>
              <select class="select2 js-select2 form-control" id="stfBloodGroup" name="stfBloodGroup">
                <option disabled selected>- Select Blood Group -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."blood_group", "bgId", "bgName",$result[0]['stfBloodGroup'], "", "bgId"); ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <div class="form-group">
              <label for="stfAddress">Address</label>
              <textarea id="stfAddress" name="stfAddress" class="form-control" rows="2" placeholder="Address"><?php echo Common_Nijsol_Class::Get_Value($result[0]['stfAddress']) ?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfCity">City</label>
              <input type="text" class="form-control" id="stfCity" name="stfCity" placeholder="City" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfCity']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfTaluka">Taluka</label>
              <input type="text" class="form-control" id="stfTaluka" name="stfTaluka" placeholder="Taluka" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfTaluka']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfDistrict">District</label>
              <input type="text" class="form-control" id="stfDistrict" name="stfDistrict" placeholder="District" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfDistrict']) ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfPinCode">Pin Code</label>
              <input type="text" class="form-control" id="stfPinCode" name="stfPinCode" placeholder="Pin Code" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfPinCode']) ?>" maxlength="6" onkeypress="return Is_Number(event);">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfHomeNo">Phone (R)</label>
              <input type="text" class="form-control" id="stfHomeNo" name="stfHomeNo" placeholder="Phone (R)" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfHomeNo']) ?>" onkeypress="return Is_Number(event);">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfMobileNo">Mobile</label>
              <input type="text" class="form-control" id="stfMobileNo" name="stfMobileNo" placeholder="Mobile" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfMobileNo']) ?>" maxlength="10" onkeypress="return Is_Number(event);">
            </div>
          </div>
        </div>
        <div class="row customSelectWrap">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfEmail">Email</label>
              <input type="email" class="form-control" id="stfEmail" name="stfEmail" placeholder="Email" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfEmail']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stfDesignation">Designation</label>
              <select class="select2 js-select2 form-control" id="stfDesignation" name="stfDesignation">
                <option disabled selected>- Select Designation -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."designation", "desId", "desName",$result[0]['stfDesignation'], "", "desId"); ?>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfSalary">Salary</label>
              <input type="text" class="form-control" id="stfSalary" name="stfSalary" placeholder="Salary" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfSalary']) ?>" onkeypress="return Is_Number(event);">
            </div>
          </div>
        </div>
        <div class="row customSelectWrap">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfCast">Cast</label>
              <input type="text" class="form-control" id="stfCast" name="stfCast" placeholder="Cast" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfCast']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stfCategory">Category</label>
              <select class="select2 js-select2 form-control" id="stfCategory" name="stfCategory">
                <option disabled selected>- Select Category -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."category", "catId", "catName",$result[0]['stfCategory'], "", "catId"); ?>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfReligion">Religion</label>
              <input type="text" class="form-control" id="stfReligion" name="stfReligion" placeholder="Religion" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfReligion']) ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-8">
            <div class="form-group">
              <label for="stfSubject">Subjects</label>
              <input type="text" class="form-control" id="stfSubject" name="stfSubject" placeholder="Subjects" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfSubject']) ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfJoiningDate">Joining Date</label>
              <div id="stfJoiningDate" class="input-group date">
                <input type="text" class="form-control" id="stfJoiningDate" name="stfJoiningDate" placeholder="Joining Date" value="<?php echo (!empty($_GET['id']))?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stfJoiningDate']):date("d-m-Y"); ?>" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfQualification1">Qualification</label>
              <input type="text" class="form-control" id="stfQualification1" name="stfQualification1" placeholder="Qualification" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfQualification1']);?>">
              <input type="text" class="form-control" id="stfQualification2" name="stfQualification2" placeholder="Qualification" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfQualification2']);?>">
              <input type="text" class="form-control" id="stfQualification3" name="stfQualification3" placeholder="Qualification" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfQualification3']);?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfClass1">Class</label>
              <input type="text" class="form-control" id="stfClass1" name="stfClass1" placeholder="Class" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfClass1']);?>">
              <input type="text" class="form-control" id="stfClass2" name="stfClass2" placeholder="Class" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfClass2']);?>">
              <input type="text" class="form-control" id="stfClass3" name="stfClass3" placeholder="Class" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfClass3']);?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stfPercentage1">Percentage</label>
              <input type="text" class="form-control" id="stfPercentage1" name="stfPercentage1" placeholder="Percentage" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfPercentage1']);?>">
              <input type="text" class="form-control" id="stfPercentage2" name="stfPercentage2" placeholder="Percentage" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfPercentage2']);?>">
              <input type="text" class="form-control" id="stfPercentage3" name="stfPercentage3" placeholder="Percentage" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['stfPercentage3']);?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-3 i">
            <div class="form-group checkboxes">
              <label>
                <input type="checkbox" id="stfPhysicalHandicap" name="stfPhysicalHandicap" <?php echo ($result[0]['stfPhysicalHandicap']==1)?'checked="checked"':'';?> value="1">
                <span>Physical Handicap</span> </label>
            </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <label for="stfPhoto">Teacher's Photograph</label>
            <div class="form-group dropzone" id="uplaodFile"></div>
          </div>
          <div class="col-xs-12 col-md-3">
            <label>&nbsp;</label>
            <?php if(!empty($_GET['id']) && !empty($result[0]['stfPhoto']))									{										Common_Nijsol_Class::Set_Session('staff-photo',$result[0]['stfPhoto']);										?>
            <div id="hideImage" class="col-sm-2 dz-default dz-message" style="border: 1px solid #eee; padding:5px; margin-left:15px;height:170px;width:170px">
              <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview text-center"> <img style="max-height:150px; max-width:150px" src="<?php echo FILE_UPLOAD_PATH.Common_Nijsol_Class::Get_Value($result[0]['stfPhoto']);?>" /> </div>
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
              <input type="hidden" name="type" id="type" value="<?php echo $_GET['mode'];?>">
              <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">
              <button type="submit" class="<?php echo BTN_ADD;?>">Submit</button>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <button type="reset" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>staff-information-manage.php');">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php }?>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();$common_bottom->ALL_Common_Bottom();?>
<script src="<?php echo SITE_URL;?>js/staff-information-manage.js"></script><!-- Dropzone Start -->
<link href="<?php echo SITE_URL;?>dropzone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo SITE_URL;?>dropzone/photo-dropzone.js"></script><script language="javascript">$(document).ready(function(e) {Dropzone.autoDiscover = false;   var myDropzoneuimage = $("#uplaodFile").dropzone({ url: "staff-dropzone.php", acceptedFiles:"image/*",/* acceptedFiles:".csv, .ms-excel, .comma-separated-values",*/ dictDefaultMessage:"",/*previewsContainer: ".upload-list",previewTemplate: "", */maxFilesize: 20, maxFiles:1, maxfilesexceeded: function(file){	  alert("You have uploaded more than 1 Photo. Only the first file will be uploaded!");	  this.removeFile(file);},createImageThumbnails:true,addRemoveLinks: false,accept: function(file, done) { return done();},init: function() { this.on("error", function(file, response) {  /*$('.dz-file-preview').hide();      alert(response);      this.removeFile(file);*/    }); this.on("success", function(file, serverFileName) {  /*$('.file-drop-target').removeClass("over");*/    }); this.on("complete", function(file, serverFileName) {	 /*this.removeFile(file);*/    });}   }); }); </script><!-- End -->
<?php }}$staff_information_add_edit = new Staff_Information_Add_Edit();$staff_information_add_edit->All_Staff_Information_Add_Edit();	?>
