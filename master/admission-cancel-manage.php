<?php define("menu_main","master");
	  define("menu_sub","admission_cancel");
require_once("../includes/top.php");
class Admission_Cancel_Manage extends DataBase
{
	function All_Admission_Cancel()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
    <div class="pageContent extended">
        <div class="container">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage Admission Cancel
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li class="active">Manage Admission Cancel</li>
                </ol>
            </div>
        </div>           
            <div class="box box-without-bottom-padding">
            <form method="post">
            <div class="row customSelectWrap">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                    
                            <label for="pstdLeavingDate">Admission Cancel Date</label>
                            <div class="input-group date">
                            <input type="text" class="form-control" id="pstdLeavingDate" name="pstdLeavingDate" placeholder="Admission Cancel Date" value="<?php echo date("d-m-Y");?>">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						       </div>   
                    </div>
                </div>
            </div>
          </form>  
            
					<div class="tableWrap dataTable table-responsive js-select">
						<table id="admission-cancel-list" class="table js-datatable admission-cancel-list" data-page-length='50'>
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
							<?php $result=$this->Get_Rows(DB_PREFIX."student","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdActive='1'",'stdId, stdGrNo, stdSurname, stdStudentName, stdFatherName, stdRollNo, stdCity, stdCurrentStandard, stdCurrentClass','stdId'); 
							
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
									<td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>   <a href="javascript:void(0);" class="edit-link" onClick="Admission_Cancel('<?php echo MASTER_URL;?>admission-cancel-manage.php?id=<?php echo $_result['stdId']; ?>&mode=cancel')" title="Student Admission Cancel"><i class="fa fa-fw fa-power-off"></i></a><?php }?> 
                   <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?>                  <a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>admission-cancel-manage.php?id=<?php echo $_result['stdId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?>   </td>
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
?>
         
<script src="<?php echo SITE_URL;?>js/admission-cancel-manage.js"></script>         
<?php } 
	function Delete_Admission_Cancel($id)
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
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'admission-cancel-manage.php');
	}
	
	function Admission_Cancel($id)
	{
		$column=array(
		  'stdActive'=>Common_Nijsol_Class::Set_Value('0'),
		  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
		);
		$where = " stdId='".$id."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
		$result=$this->Update_Row(DB_PREFIX."student",$column, $where);
		
		
		$column=array(
		  'pstdStudentId'=>Common_Nijsol_Class::Set_Value($id),
		  'pstdLeavingDate'=>Common_Nijsol_Class::Convert_Date_To_Mysql_Format($_GET['pstdLeavingDate']),
		  'schCode'=>Common_Nijsol_Class::Get_Session('schCode'),
		  'usrId'=>Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)
		);
		$result=$this->Insert_Row(DB_PREFIX."past_student",$column);
		
		Common_Nijsol_Class::Set_Session('msg','Admission cancel successfully.');
		Common_Nijsol_Class::Set_Session('error_success','success'); 
		Common_Nijsol_Class::Redirect_To(MASTER_URL.'admission-cancel-manage.php');
	}
	
}
$admission_cancel_manage = new Admission_Cancel_Manage();	
$admission_cancel_manage->All_Admission_Cancel();
if(!empty($_GET['id']) && ($_GET['mode'] == 'delete'))
{
	$admission_cancel_manage->Delete_Admission_Cancel($_GET['id']);		
}
if(!empty($_GET['id']) && ($_GET['mode'] == 'cancel') && ($_GET['pstdLeavingDate'] != ""))
{
	$admission_cancel_manage->Admission_Cancel($_GET['id']);		
}

?>