<?php define("menu_main","master");
	  define("menu_sub","trustee_information");
require_once("../includes/top.php");
class Trustee_Information_Manage extends DataBase
{
	function All_Trustee_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Trustee Information
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Trustee Information</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn">
              <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?> <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>trustee-information-add-edit.php?mode=add');">Add</button>            <?php }?> </div>
      </div>           
            <div class="box box-without-bottom-padding">
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="trustee-information-list" class="table js-datatable trustee-information-list" data-page-length='50'>
							<thead>
								<tr>
									<th>Name</th>
									<th>Designation</th>
									<th>Mobile No.</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $result=$this->Get_Rows(DB_PREFIX."trustee","schCode='".Common_Nijsol_Class::Get_Session('schCode')."'",'trsId,trsName,trsDesignation,trsMobileNo','trsId'); 
							foreach($result as $_result)
							{ ?>	
								<tr>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['trsName']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['trsDesignation']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($_result['trsMobileNo']); ?></td>
									<td>
                                 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>   
                                    <a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>trustee-information-add-edit.php?id=<?php echo $_result['trsId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a>
                                <?php }?> 
                               <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>      
                                    <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>trustee-information-manage.php?id=<?php echo $_result['trsId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a>
                                  <?php }?>     
                                    </td>
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

	function Delete_Trustee_Information($id)
	{
		$where = array(
				'trsId'=>$id
		);
		$result=$this->Delete_Row(DB_PREFIX."trustee", $where);
		Common_Nijsol_Class::Set_Session('msg','Delete trustee information successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'trustee-information-manage.php');
	}
}
$trustee_information_manage = new Trustee_Information_Manage();	
$trustee_information_manage->All_Trustee_Information();
if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{
	$trustee_information_manage->Delete_Trustee_Information($_GET['id']);		
}

?>