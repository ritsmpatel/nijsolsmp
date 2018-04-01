<?php define("menu_main","master");	  define("menu_sub","user_manage");require_once("../includes/top.php");class User_Manage extends DataBase{		function All_User()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();?>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage User </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Manage User</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn">
        <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>user-manage-add-edit.php?mode=add');">Add</button>
      </div>
    </div>
    <div class="box box-without-bottom-padding">
      <div class="tableWrap dataTable table-responsive js-select">
        <table id="user-manage-list" class="table js-datatable user-manage-list" data-page-length='50'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th class="text-center" style="width:80px">Active</th>
              <th class="text-center" style="width:80px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
$result=$this->Get_Rows(DB_PREFIX."usr","1=1",'*','usrId'); 							
	foreach($result as $_result)							
	{ 							 						
		if($_result['usrId']!=1)					     
		{ ?>
            <tr>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['usrName']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['usrUserName']); ?></td>
              <td class="text-center"><?php if($_result['usrActive']==1){?>
                	<i class="fa fa-2x fa-check-square"></i>
                <?php } else {?>
                	<i class="icheckbox_square-blue" style="cursor:default"></i>
                <?php }?></td>
              <td class="text-center"><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>user-manage-add-edit.php?id=<?php echo $_result['usrId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a> <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>user-manage.php?id=<?php echo $_result['usrId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a></td>
            </tr>
	<?php }						  
	} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 
$common_bottom->ALL_Common_Bottom();	 
}	
	function Delete_User($id)	
	{		
		$where = array('usrId'=>$id);	
		$result=$this->Delete_Row(DB_PREFIX."usr", $where);				
		$where = array(	'perUsrId'=>$id);		
		$result=$this->Delete_Row(DB_PREFIX."permission", $where);	
		$where = array(	'usrId'=>$id);		
		$result=$this->Delete_Row(DB_PREFIX."usr_organisation_permission", $where);				
		Common_Nijsol_Class::Set_Session('msg','Delete user successfully.');		
		Common_Nijsol_Class::Set_Session('error_success','success'); 		
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'user-manage.php');	
	}
}

$user_manage = new User_Manage();	
$user_manage->All_User();

if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{	
	$user_manage->Delete_User($_GET['id']);		
}?>
