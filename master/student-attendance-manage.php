<?php define("menu_main","master");	  define("menu_sub","student_attendance");require_once("../includes/top.php");class Student_Attendance_Manage extends DataBase{	function All_Student_Attendance()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();				$fromDate=(empty($_POST['fromDate']))?date("01-m-Y"):Common_Nijsol_Class::Get_Value($_POST['fromDate']);$toDate=(empty($_POST['toDate']))?date("d-m-Y"):Common_Nijsol_Class::Get_Value($_POST['toDate']);	?>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Attendance </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Manage Student Attendance</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn">
        <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-attendance-add-edit.php?mode=add');">Add</button><?php }?>
      </div>
    </div>
    <div class="box box-without-bottom-padding">
      <form role="form" class="form-horizontal form-student-attendance-search" method="post" action="student-attendance-manage.php" id="form-student-attendance-search">
        <div class="box rte margin-padding-0">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="fromDate">From Date</label>
                <div id="fromDate" class="input-group date">
                  <input type="text" class="form-control" id="fromDate" name="fromDate" placeholder="From Date" value="<?php echo $fromDate;?>" required>
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-1">
              <div class="form-group">
                <label for="toDate">To Date</label>
                <div id="toDate" class="input-group date">
                  <input type="text" class="form-control" id="toDate" name="toDate" placeholder="To Date" value="<?php echo $toDate;?>" required>
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
              </div>
            </div>
          </div>
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
      <div class="tableWrap dataTable table-responsive js-select">
        <table id="trustee-information-list" class="table js-datatable trustee-information-list" data-page-length='50'>
          <thead>
            <tr>
              <th>Date</th>
              <th>Standard</th>
              <th>Present Student</th>
              <th>Absent Student</th>
              <th>Total Student</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1;							$result=$this->Get_Rows(DB_PREFIX."student_attendance","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stndStudentStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."' and stndStudentClassId='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."'  and stndDate BETWEEN '".Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($fromDate)."' and '".Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($toDate)."'",'*','stndDate'); 							foreach($result as $_result)							{ ?>
            <tr>
              <td><?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($_result['stndDate']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_result['stndStudentStandardId']))." - ".Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_result['stndStudentClassId'])); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stndPresentStudent']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stndAbsentStudent']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stndTotalStudent']); ?></td>
              <td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>student-attendance-add-edit.php?id=<?php echo $_result['stndId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a><?php }?> 
 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>  <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>student-attendance-manage.php?id=<?php echo $_result['stndId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
            </tr>
            <?php $count++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 $common_bottom->ALL_Common_Bottom();		 		 ?>
<script src="<?php echo SITE_URL;?>js/student-attendance-manage.js"></script>
<?php }	function Delete_Student_Attendance($id)	{		$where = array(				'stndId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."student_attendance", $where);				$where = array(				'sadStndId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."student_attendance_details", $where);			Common_Nijsol_Class::Set_Session('msg','Delete student attendance details successfully.');	Common_Nijsol_Class::Set_Session('error_success','success'); 	Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-attendance-manage.php');	}}$student_attendance_manage = new Student_Attendance_Manage();	$student_attendance_manage->All_Student_Attendance();if(!empty($_GET['id']) && ($_GET['mode'] == 'delete')){	$student_attendance_manage->Delete_Student_Attendance($_GET['id']);		}?>
