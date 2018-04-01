<?php define("menu_main","master");	  define("menu_sub","student_addrollno");require_once("../includes/top.php");class Student_Add_Roll_No_Manage extends DataBase{	function All_Student_Add_Roll_No()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();?>
<script language="javascript">	var countRow=0;</script>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Roll No </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Manage Student Roll No</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn">&nbsp;</div>
    </div>
    <div class="box box-without-bottom-padding">
      <form role="form" class="form-horizontal form-student-addrollno-search" method="post" action="student-addrollno-manage.php" id="form-student-addrollno-search">
        <div class="box rte margin-padding-0">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="StdId">Standard</label>
                <select class="select2 js-select2 form-control" id="StdId" name="StdId" required onChange="OnChanges_Standard_Manage('<?php echo MASTER_URL;?>',this.value,'');">
                  <option value="">- Select Standard -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$_POST['StdId'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' ", "stnId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-1">
              <div class="form-group">
                <label for="clsId">Class Name</label>
                <select class="select2 js-select2 form-control" id="clsId" name="clsId" required>
                  <option value="">- Select Class -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_POST['clsId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."'", "clsId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-sm-offset-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <button class="<?php echo BTN_ADD;?> btn-lg" type="submit">Fetch</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <form role="form" class="form-student-addrollno" method="post" action="student-addrollno-db.php">
      
      <?php 
	  if(!empty($_POST['StdId']))
	  {
	  $standardAndClass=Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_POST['StdId']))." - ".Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_POST['clsId'])); 
	  }
	  ?>
      
      <input type="hidden" name="standardAndClass" value="<?php echo $standardAndClass?>">
      
        <div class="tableWrap dataTable table-responsive js-select">
          <table id="student-addrollno-list" class="table js-datatable student-addrollno-list" data-page-length='50'>
            <thead>
              <tr>
                <th width="10%">Sr. No.</th>
                <th width="15%">Roll No</th>
                <th width="20%">Surname</th>
                <th width="20%">Student Name</th>
                <th width="20%">Father Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $count=1;							$countRow=0;							$result=$this->Get_Rows(DB_PREFIX."student","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdCurrentStandard='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."' and stdCurrentClass='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."' and stdActive='1'",'stdId, stdSurname, stdStudentName, stdFatherName, stdRollNo','stdSurname'); 							foreach($result as $_result)							{ ?>
              <tr>
                <td><input type="hidden" name="stdId[<?php echo $_result['stdId'];?>]" value="<?php echo Common_Nijsol_Class::Get_Value($_result['stdId']); ?>">
                  <?php echo $count;?></td>
                <td><div class="form-group">
                    <input type="text" class="form-control" id="stdRollNo<?php echo $countRow;?>" name="stdRollNo[<?php echo $_result['stdId'];?>]" value="<?php echo Common_Nijsol_Class::Get_Value($_result['stdRollNo']); ?>" size="3" maxlength="3" onkeypress="return Is_Number(event);" onBlur="checkDuplicateRollNo(this.value,'stdRollNo<?php echo $countRow;?>');">
                  </div></td>
                <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdSurname']); ?></td>
                <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdStudentName']); ?></td>
                <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdFatherName']); ?></td>
              </tr>
              <?php $count++;						  	$countRow++; } ?>
            </tbody>
          </table>
        </div>
        
        
         <?php 
	  if(!empty($_POST['StdId']))
	  {?>     
     <div class="row">      
      <div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="editMessage">Edit Message</label>
			<input type="text" class="form-control" id="editMessage" name="editMessage" placeholder="Edit Message" >
		</div>
	</div>
    </div>
   <?php }?> 
        
        
        <?php if(!empty($_POST['StdId'])){?>
        <div class="row">
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <input type="hidden" name="type" id="type" value="edit">
              <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>   <button type="submit" class="<?php echo BTN_ADD;?>">Save</button><?php }?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <button type="reset" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-addrollno-manage.php');">Close</button>
            </div>
          </div>
        </div>
        <?php }?>
      </form>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 $common_bottom->ALL_Common_Bottom(); ?>
<script language="javascript">			countRow=<?php echo $countRow;?>;</script><script src="<?php echo SITE_URL;?>js/student-addrollno-manage.js"></script>
<?php } }$student_addrollno_manage = new Student_Add_Roll_No_Manage();	$student_addrollno_manage->All_Student_Add_Roll_No();?>
