<?php define("menu_main","master");	  define("menu_sub","student_homework");require_once("../includes/top.php");class Student_Homework_Add_Edit extends DataBase{	function All_Student_Homework_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Homework </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li><a href="<?php echo MASTER_URL;?>student-homework-manage.php">Manage Student Homework</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Student Homework</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))        {         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."student_homework WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and swkId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");     ?>
    <form class="form-student-homework" method="post" action="student-homework-db.php">
      <div class="box rte">
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="swkDate">Date</label>
              <div id="swkDate" class="input-group date">
                <input type="text" class="form-control" id="swkDate" name="swkDate" placeholder="Date" value="<?php echo (!empty($_GET['id']))?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['swkDate']):date("d-m-Y"); ?>" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="swkStudentStandardId">Standard</label>
              <select class="select2 js-select2 form-control" id="swkStudentStandardId" name="swkStudentStandardId" onChange="OnChanges_Standard('<?php echo MASTER_URL;?>',this.value,'','','','');">
                <option disabled selected>- Select Standard -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result[0]['swkStudentStandardId'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId");?>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="swkStudentClassId">Class</label>
              <select class="select2 js-select2 form-control" id="swkStudentClassId" name="swkStudentClassId" onChange="OnChanges_Class('<?php echo MASTER_URL;?>','',this.value,'','');">
                <option disabled selected>- Select Class -</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="swkSubjectId">Subject</label>
              <select class="select2 js-select2 form-control" id="swkSubjectId" name="swkSubjectId">
                <option disabled selected>- Select Subject -</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <div class="form-group">
              <label for="swkHomeworkDetails">Homework Details</label>
              <textarea id="swkHomeworkDetails" name="swkHomeworkDetails" class="form-control" rows="5" placeholder="Homework Details"><?php echo Common_Nijsol_Class::Get_Value($result[0]['swkHomeworkDetails'])?></textarea>
            </div>
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
          <div class="col-xs-12 col-sm-12 i">
            <div class="form-group checkboxes" id="div_swkStudentStandardId"></div>
          </div>
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
              <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-homework-manage.php');">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php }?>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();$common_bottom->ALL_Common_Bottom();?>
<script src="<?php echo SITE_URL;?>js/student-homework-manage.js"></script>
<?php if($_GET['mode']=='edit'){?>
<script language="javascript">	OnChanges_Standard('<?php echo MASTER_URL;?>',<?php echo $result[0]['swkStudentStandardId'];?>,<?php echo $result[0]['swkStudentClassId'];?>,'<?php echo $result[0]['swkSubjectId'];?>','<?php echo $result[0]['swkStudentId'];?>',<?php echo $_GET['id'];?>);</script>
<?php }?>
<?php }}$student_homework_add_edit = new Student_Homework_Add_Edit();$student_homework_add_edit->All_Student_Homework_Add_Edit();	?>
