<?php define("menu_main","master");	  define("menu_sub","time_table");require_once("../includes/top.php"); class Time_Table_Add_Edit extends DataBase{	function All_Time_Table_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Time Table </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li><a href="<?php echo MASTER_URL;?>time-table-manage.php">Manage Time Table</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Time Table</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))        {         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."time_table WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and ttId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");    ?>
    <div class="box">
      <form class="form-time-table" method="post" action="time-table-db.php">
        <div class="box rte">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="StdId">Standard</label>
                <select class="select2 js-select2 form-control" id="StdId" name="StdId" onChange="OnChanges_Standard_Manage('<?php echo MASTER_URL;?>',this.value,'');">
                  <option value="">- Select Standard -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",Common_Nijsol_Class::Get_Value($result[0]['ttStandardId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' ", "stnId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="clsId">Class Name</label>
                <select class="select2 js-select2 form-control" id="clsId" name="clsId">
                  <option value="">- Select Class -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($result[0]['ttClassId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($result[0]['ttStandardId'])."'", "clsId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="ttType">Time Table Type</label>
                <select class="select2 js-select2 form-control" id="ttType" name="ttType">
                  <option value="">- Select Time Table Type -</option>
                  <option value="1" <?php if(Common_Nijsol_Class::Set_Value($result[0]['ttType'])==1){echo "selected";}?>>Lecture Time Table</option>
                  <option value="2" <?php if(Common_Nijsol_Class::Set_Value($result[0]['ttType'])==2){echo "selected";}?>>Exam Time Table</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="ttPhoto">Time Table Photo</label>
              <div class="form-group dropzone" id="uplaodFile"></div>
            </div>
            <div class="col-md-3">
              <label>&nbsp;</label>
              <?php if(!empty($_GET['id']) && !empty($result[0]['ttPhoto']))                        {                            Common_Nijsol_Class::Set_Session('time-table-photo',$result[0]['ttPhoto']);                            ?>
              <div id="hideImage" class="col-sm-2 dz-default dz-message" style="border: 1px solid #eee; padding:5px; margin-left:15px;height:170px;width:170px">
                <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview text-center"> <img style="max-height:150px; max-width:150px" src="<?php echo FILE_UPLOAD_PATH_TIME_TABLE.Common_Nijsol_Class::Get_Value($result[0]['ttPhoto']);?>" /> </div>
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
                <button type="submit" class="<?php echo BTN_ADD;?>">Save</button>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              <div class="form-group">
                <button type="reset" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>time-table-manage.php');">Close</button>
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
<script src="<?php echo SITE_URL;?>js/time-table-manage.js"></script><!-- Dropzone Start -->
<link href="<?php echo SITE_URL;?>dropzone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo SITE_URL;?>dropzone/photo-dropzone.js"></script><script language="javascript">$(document).ready(function(e) {Dropzone.autoDiscover = false;   var myDropzoneuimage = $("#uplaodFile").dropzone({ url: "time-table-dropzone.php", acceptedFiles:"image/*",/*acceptedFiles:".csv, .ms-excel, .comma-separated-values",*/ dictDefaultMessage:"",/*previewsContainer: ".upload-list",previewTemplate: "", */maxFilesize: 20, maxFiles:1, maxfilesexceeded: function(file){	  alert("You have uploaded more than 1 Photo. Only the first file will be uploaded!");	  this.removeFile(file);},createImageThumbnails:true,addRemoveLinks: false,accept: function(file, done) { return done();},init: function() { this.on("error", function(file, response) {  /*$('.dz-file-preview').hide();      alert(response);      this.removeFile(file);*/    }); this.on("success", function(file, serverFileName) {  /*$('.file-drop-target').removeClass("over");*/    }); this.on("complete", function(file, serverFileName) {	 /*this.removeFile(file);*/    });}   }); }); </script><!-- End -->
<?php }}$time_table_add_edit = new Time_Table_Add_Edit();$time_table_add_edit->All_Time_Table_Add_Edit();	?>
