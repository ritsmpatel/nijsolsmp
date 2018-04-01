<?php define("menu_main","master");
	  define("menu_sub","edit_message");
require_once("../includes/top.php");
class Edit_Message_Information_Manage extends DataBase
{
	function All_Edit_Message_Information()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Edit Message
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Edit Message</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn"></div>
      </div>           
            <div class="box box-without-bottom-padding">
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="staff-information-list" class="table js-datatable staff-information-list" data-page-length='50'>
							<thead>
								<tr>
                                <th>Id</th>
                                <th>Rcd. Id</th>
                                <th>Table Name</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>School Section</th>
                                <th>User</th>
								</tr>
							</thead>
							<tbody>
	<?php $result=$this->Get_Rows(DB_PREFIX."edit_message","1=1",'*','editId'); 
							foreach($result as $_result)
							{ ?>	
    <tr>
        <td><?php echo Common_Nijsol_Class::Get_Value($_result['editId']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_Value($_result['tblRecordId']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_Value($_result['tblName']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_Value($_result['tblTitle']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_Value($_result['editMessage']); ?></td>
        <td><?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($_result['editDate']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_One_Name("schools","schName","schCode=".Common_Nijsol_Class::Get_Value($_result['schCode']));?></td>
        <td><?php echo Common_Nijsol_Class::Get_One_Name("usr","usrName","usrId=".Common_Nijsol_Class::Get_Value($_result['usrId'])); ?></td>
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
}
$edit_message_information_manage = new Edit_Message_Information_Manage();	
$edit_message_information_manage->All_Edit_Message_Information();
?>