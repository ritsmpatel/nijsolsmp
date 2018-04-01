<?php define("menu_main","master");
	  define("menu_sub","past_student_information");
require_once("../includes/top.php");
class Past_Student_Information_Manage extends DataBase
{
	function All_Past_Student_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Past Student Information
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Past Student Information</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn">
               <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>past-student-information-add-edit.php?mode=add');">Add</button> <?php }?>            
            </div>
      </div>           
            <div class="box box-without-bottom-padding">
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="past-student-information-list" class="table js-datatable past-student-information-list" data-page-length='50'>
							<thead>
								<tr>
									<th>GR No</th>
                                    <th>Surname</th>
									<th>Name</th>
									<th>Father Name</th>
                                  <th>Standard</th>  
                                    <th>Roll No</th>
                                    <th>City</th>
									<th style="min-width:11%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $result=$this->Get_Rows(DB_PREFIX."student","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdActive='0'",'stdId, stdGrNo, stdSurname, stdStudentName, stdFatherName, stdRollNo, stdCity, stdCurrentStandard, stdCurrentClass','stdId'); 
							
							foreach($result as $_result)
							{ ?>	
								<tr>
                                	<td><?php echo Common_Nijsol_Class::Get_Value($_result['stdGrNo']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stdSurname']); ?></td>
                                    <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdStudentName']); ?></td>
                                    <td><?php echo Common_Nijsol_Class::Get_Value($_result['stdFatherName']); ?></td>
                                   <td><?php echo Common_Nijsol_Class::Get_One_Name("standard","stnName","stnId=".Common_Nijsol_Class::Get_Value($_result['stdCurrentStandard']))." - ".Common_Nijsol_Class::Get_One_Name("class","clsName","clsId=".Common_Nijsol_Class::Get_Value($_result['stdCurrentClass'])); ?></td> 
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stdRollNo']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stdCity']); ?></td>
									<td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Restore_Admission_Cancel('<?php echo MASTER_URL;?>past-student-information-manage.php?id=<?php echo $_result['stdId']; ?>&mode=restore');" title="Restore Student Admission"><i class="fa fa-fw fa-random"></i></a>
                                    <a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>past-student-information-add-edit.php?id=<?php echo $_result['stdId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a>
                                   <?php }?> 
 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>  <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>past-student-information-manage.php?id=<?php echo $_result['stdId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
								</tr>
						  <?php } ?>    		
							</tbody>
						</table>
					</div>
				</div>
                
            
        </div>
    </div>
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom();
	 }

	function Delete_Past_Student_Information($id)
	{
		$where = array(
				'stdId'=>$id
		);
		$result=$this->Delete_Row(DB_PREFIX."student", $where);
		$where = array(
				'pstdStudentId'=>$id
		);
		$result=$this->Delete_Row(DB_PREFIX."past_student", $where);
		Common_Nijsol_Class::Set_Session('msg','Delete student information successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'past-student-information-manage.php');
	}
	
	
	function Restore_Admission_Cancel($id)
	{
		$column=array(
		  'stdActive'=>Common_Nijsol_Class::Set_Value('1'),
		  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
		);
		$where = " stdId='".$id."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
		$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
		
		Common_Nijsol_Class::Set_Session('msg','Restore student successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'past-student-information-manage.php');
	}
	
}
$student_information_manage = new Past_Student_Information_Manage();	
$student_information_manage->All_Past_Student_Information();
if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{
	$student_information_manage->Delete_Past_Student_Information($_GET['id']);		
}
if(!empty($_GET['id']) && ($_GET['mode'] == 'restore'))
{
	$student_information_manage->Restore_Admission_Cancel($_GET['id']);		
}
?>