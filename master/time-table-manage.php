<?php define("menu_main","master");
	  define("menu_sub","time_table");
require_once("../includes/top.php");
class Time_Table_Manage extends DataBase
{
	function All_Time_Table()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Time Table
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Time Table</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn">
               <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>time-table-add-edit.php?mode=add');">Add</button><?php }?>            
            </div>
      </div>           
            <div class="box box-without-bottom-padding">
            
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="time-table-list" class="table js-datatable time-table-list" data-page-length='50'>
							<thead>
								<tr>
									<th>Standard</th>
                                    <th>Class</th>
									<th>Time Table Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $result=$this->Get_Rows(DB_PREFIX."time_table","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' " ,'ttId,ttStandardId,ttClassId,ttType','ttId'); 
							
							foreach($result as $_result)
							{
								$standard=$this->Get_Rows(DB_PREFIX."standard","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stnId='".Common_Nijsol_Class::Get_Value($_result['ttStandardId'])."' " ,'stnName','stnId');
								$class=$this->Get_Rows(DB_PREFIX."class","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Get_Value($_result['ttStandardId'])."' and clsId='".Common_Nijsol_Class::Get_Value($_result['ttClassId'])."' " ,'clsName','clsId');
								
								 ?>	
								<tr>
                                	<td><?php echo Common_Nijsol_Class::Get_Value($standard[0]['stnName']); ?></td>
									<td><?php echo Common_Nijsol_Class::Get_Value($class[0]['clsName']); ?></td>
                                    <td><?php if(Common_Nijsol_Class::Set_Value($_result['ttType'])==1)
										{echo "Lecture Time Table";}
										if(Common_Nijsol_Class::Set_Value($_result['ttType'])==2)
										{echo "Exam Time Table";}
									 ?></td>
                                    <td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="Redirect_To('<?php echo MASTER_URL;?>time-table-add-edit.php?id=<?php echo $_result['ttId']; ?>&mode=edit');"><i class="fa fa-fw fa-edit"></i></a><?php }?> 
 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>  
                                    <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>time-table-manage.php?id=<?php echo $_result['ttId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
								</tr>
						  <?php } ?>    		
							</tbody>
						</table>
					</div>
				</div>
                
            
        </div>
    </div>
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom(); ?>

<script src="<?php echo SITE_URL;?>js/time-table-manage.js"></script>    

<?php }
	function Delete_Time_Table($id)
	{
		$where = array(
				'ttId'=>$id
		);
		$result=$this->Delete_Row(DB_PREFIX."time_table", $where);
		Common_Nijsol_Class::Set_Session('msg','Delete time table successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'time-table-manage.php');
	}
}
$time_table_manage = new Time_Table_Manage();	
$time_table_manage->All_Time_Table();
if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{
	$time_table_manage->Delete_Time_Table($_GET['id']);		
}

?>