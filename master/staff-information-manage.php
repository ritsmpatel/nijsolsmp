<?php define("menu_main","master");
	  define("menu_sub","staff_information");
require_once("../includes/top.php");
class Staff_Information_Manage extends DataBase
{
	function All_Staff_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Staff Information
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Staff Information</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn">
               <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>staff-information-add-edit.php?mode=add');">Add</button><?php }?>             
            </div>
      </div>           
            <div class="box box-without-bottom-padding">
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="staff-information-list" class="table js-datatable staff-information-list" data-page-length='50'>
							<thead>
								<tr>
									<th>Employee No</th>
                                    <th>Surname</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
									<th>City</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $result=$this->Get_Rows(DB_PREFIX."staff","schCode='".Common_Nijsol_Class::Get_Session('schCode')."'",'stfId, stfEmpNo, stfSurname, stfStaffName, stfFatherHusbandName, stfCity','stfId'); 
							foreach($result as $_result)
							{ ?>	
								<tr>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stfEmpNo']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stfSurname']); ?></td>
                                    <td><?php echo Common_Nijsol_Class::Get_Value($_result['stfStaffName']); ?></td>
                                    <td><?php echo Common_Nijsol_Class::Get_Value($_result['stfFatherHusbandName']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['stfCity']); ?></td>
									<td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>staff-information-add-edit.php?id=<?php echo $_result['stfId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a><?php }?> 
 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>  
                                    <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>staff-information-manage.php?id=<?php echo $_result['stfId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
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

	function Delete_Staff_Information($id)
	{
		$where = array(
				'stfId'=>$id
		);
		$result=$this->Delete_Row(DB_PREFIX."staff", $where);
		Common_Nijsol_Class::Set_Session('msg','Delete staff information successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'staff-information-manage.php');
	}
}
$staff_information_manage = new Staff_Information_Manage();	
$staff_information_manage->All_Staff_Information();
if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{
	$staff_information_manage->Delete_Staff_Information($_GET['id']);		
}

?>