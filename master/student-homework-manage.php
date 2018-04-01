<?php define("menu_main","master");	  define("menu_sub","student_homework");require_once("../includes/top.php");class Student_Homework_Manage extends DataBase{	function All_Student_Homework()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();?>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Homework </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Manage Student Homework</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn">
        <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>
<button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-homework-add-edit.php?mode=add');">Add</button><?php }?> 
      </div>
    </div>
    <div class="box box-without-bottom-padding">
      <form role="form" class="form-horizontal form-student-homework-search" method="post" action="student-homework-manage.php" id="form-student-homework-search">
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
      <div class="tableWrap dataTable table-responsive js-select">
        <table id="trustee-information-list" class="table js-datatable trustee-information-list" data-page-length='50'>
          <thead>
            <tr>
              <th width="15%">Sr. No.</th>
              <th>Standard</th>
              <th>Subject</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1;							$result=$this->Get_Rows(DB_PREFIX."student_homework","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and swkStudentStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."' and swkStudentClassId='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."'",'*','swkId desc'); 							foreach($result as $_result)							{ ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_result['swkStudentStandardId']))." - ".Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_result['swkStudentClassId'])); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_One_Name("subject","subName","subId=".Common_Nijsol_Class::Get_Value($_result['swkSubjectId'])); ?></td>
              <td><?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($_result['swkDate']); ?></td>
              <td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>student-homework-add-edit.php?id=<?php echo $_result['swkId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a><?php }?>  <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>  <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>student-homework-manage.php?id=<?php echo $_result['swkId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
            </tr>
            <?php $count++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 $common_bottom->ALL_Common_Bottom();	  ?>
<script src="<?php echo SITE_URL;?>js/student-homework-manage.js"></script>
<?php }	function Delete_Student_Homework($id)	{		$where = array(				'swkId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."student_homework", $where);		Common_Nijsol_Class::Set_Session('msg','Delete student homework details successfully.');		Common_Nijsol_Class::Set_Session('error_success','success'); 		Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-homework-manage.php');	}}$student_homework_manage = new Student_Homework_Manage();	$student_homework_manage->All_Student_Homework();if(!empty($_GET['id']) && ($_GET['mode'] == 'delete')){	$student_homework_manage->Delete_Student_Homework($_GET['id']);		}?>
