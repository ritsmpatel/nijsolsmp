<?php define("menu_main","master");	  define("menu_sub","student_information");require_once("../includes/top.php");class Student_Information_Manage extends DataBase{	function All_Student_Information()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();?>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Student Information </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Manage Student Information</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn">
        <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>student-information-add-edit.php?mode=add');">Add</button><?php }?>
      </div>
    </div>
    <div class="box box-without-bottom-padding">
      <form role="form" class="form-horizontal form-student-information-search" method="post" action="student-information-manage.php" id="form-student-information-search">
        <div class="box rte margin-padding-0">
          <div class="row">
            <div class="col-xs-12 col-sm-2">
              <div class="form-group">
                <label for="StdId">Standard</label>
                <select class="select2 js-select2 form-control" id="StdId" name="StdId" onChange="OnChanges_Standard_Manage('<?php echo MASTER_URL;?>',this.value,'');">
                  <option value="">- Select Standard -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$_POST['StdId'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' ", "stnId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-sm-offset-1">
              <div class="form-group">
                <label for="clsId">Class Name</label>
                <select class="select2 js-select2 form-control" id="clsId" name="clsId">
                  <option value="">- Select Class -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_POST['clsId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."'", "clsId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-sm-offset-1">
              <div class="form-group">
                <label for="SearchField">GR/Surname/Name/Father</label>
                <input type="text" class="form-control" id="SearchField" name="SearchField" placeholder="Search" value="<?php echo $_POST["SearchField"]; ?>">
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
        <table id="student-information-list" class="table js-datatable student-information-list" data-page-length='50'>
          <thead>
            <tr>
              <th>GR No</th>
              <th>Surname</th>
              <th>Name</th>
              <th>Father Name</th>
              <th>Standard</th>
              <th>Roll No</th>
              <th>City</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $where="";							if(!empty($_POST['StdId']))							{								$where.="and stdCurrentStandard='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."'";							}														if(!empty($_POST['clsId']))							{								$where.="and stdCurrentClass='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."'";							}														if(!empty($_POST['SearchField']))							{								$where.="and (stdGrNo = '".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."' OR stdSurname LIKE '%".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."%' OR stdStudentName LIKE '%".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."%' OR stdFatherName LIKE '%".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."%')";							}														if(!empty($where))							{							$result=$this->Get_Rows(DB_PREFIX."student","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdActive='1' ".$where,'stdId, stdGrNo, stdSurname, stdStudentName, stdFatherName, stdRollNo, stdCity, stdCurrentStandard, stdCurrentClass','stdRollNo'); 							foreach($result as $_result)							{ ?>
            <tr>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdGrNo']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdSurname']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdStudentName']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdFatherName']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_result['stdCurrentStandard']))." - ".Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_result['stdCurrentClass'])); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdRollNo']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdCity']); ?></td>
              <td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>student-information-add-edit.php?id=<?php echo $_result['stdId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a><?php }?>
              <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?> 
              <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>student-information-manage.php?id=<?php echo $_result['stdId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a>
              <?php }?></td>
            </tr>
            <?php }						  	
			} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 $common_bottom->ALL_Common_Bottom(); ?>
<script src="<?php echo SITE_URL;?>js/student-information-manage.js"></script>
<?php if(!empty($_POST['StdId'])){?>
<script language="javascript">	OnChanges_Standard_Manage('<?php echo MASTER_URL;?>',<?php echo $_POST['StdId'];?>,<?php echo $_POST['clsId'];?>);</script>
<?php }?>
<?php }	function Delete_Student_Information($id)	{		$where = array(				'stdId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."student", $where);		Common_Nijsol_Class::Set_Session('msg','Delete student information successfully.');		Common_Nijsol_Class::Set_Session('error_success','success'); 		Common_Nijsol_Class::Redirect_To(MASTER_URL.'student-information-manage.php');	}}$student_information_manage = new Student_Information_Manage();	$student_information_manage->All_Student_Information();if(!empty($_GET['id']) && ($_GET['mode'] == 'delete')){	$student_information_manage->Delete_Student_Information($_GET['id']);		}?>
