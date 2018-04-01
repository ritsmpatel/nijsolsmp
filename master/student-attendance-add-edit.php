<?php define("menu_main","master");	  define("menu_sub","student_attendance");require_once("../includes/top.php");class Student_Attendance_Add_Edit extends DataBase{	function All_Student_Attendance_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Attendance </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li><a href="<?php echo MASTER_URL;?>student-attendance-manage.php">Manage Student Attendance</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Student Attendance</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))        {         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."student_attendance WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stndId='".Common_Nijsol_Class::Get_Value($_GET['id'])."'");     ?>
    <form class="form-student-attendance" method="post" action="student-attendance-db.php">
      <div class="box rte">
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="stndDate">Date</label>
              <div id="stndDate" class="input-group date">
                <input type="text" class="form-control" id="stndDate" name="stndDate" placeholder="Date" value="<?php echo (!empty($_GET['id']))?Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['stndDate']):date("d-m-Y"); ?>" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stndStudentStandardId">Standard</label>
              <select class="select2 js-select2 form-control" id="stndStudentStandardId" name="stndStudentStandardId" onChange="OnChanges_Standard('<?php echo MASTER_URL;?>',this.value,'','');">
                <option disabled selected>- Select Standard -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$result[0]['stndStudentStandardId'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'", "stnId");?>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 i">
            <div class="form-group">
              <label for="stndStudentClassId">Class</label>
              <select class="select2 js-select2 form-control" id="stndStudentClassId" name="stndStudentClassId" onChange="OnChanges_Class('<?php echo MASTER_URL;?>','',this.value,'');">
                <option disabled selected>- Select Class -</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 i">
            <div class="form-group checkboxes" id="div_stndStudentStandardId"></div>
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
              <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-attendance-manage.php');">Close</button>
            </div>
          </div>
        </div>
        
    
        
      </div>
    </form>
    <?php }?>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();$common_bottom->ALL_Common_Bottom();?>
<script src="<?php echo SITE_URL;?>js/student-attendance-manage.js"></script>
<?php if($_GET['mode']=='edit'){?>
<script language="javascript">	OnChanges_Standard('<?php echo MASTER_URL;?>',<?php echo $result[0]['stndStudentStandardId'];?>,<?php echo $result[0]['stndStudentClassId'];?>,<?php echo $_GET['id'];?>);</script>
<?php }?>
<?php }}$student_attendance_add_edit = new Student_Attendance_Add_Edit();$student_attendance_add_edit->All_Student_Attendance_Add_Edit();	?>
