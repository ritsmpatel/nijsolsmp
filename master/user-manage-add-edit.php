<?php define("menu_main","master");
	  define("menu_sub","user_manage");
require_once("../includes/top.php");
class User_Add_Edit extends DataBase
{
	function All_User_Add_Edit()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();	
?>


<div class="pageContent extended">
			<div class="container">
				
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="pageTitle">
                    Manage User
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                    <li><a href="<?php echo MASTER_URL;?>user-manage.php">Manage User</a></li>
                    <li class="active"><?php echo ucwords($_GET['mode']);?> User</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn"></div>
      </div>
			
	  <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))
        {
         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."usr WHERE usrId='".Common_Nijsol_Class::Set_Value($_GET['id'])."'"); 
    ?>   	
			<form class="form-user-add" method="post" action="user-manage-db.php">
				<div class="box rte">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="usrName">Name</label>
                                <input type="text" class="form-control" id="usrName" name="usrName" placeholder="User Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['usrName']) ?>" required>
                            </div>
                        </div>
                    
                       <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="usrUserName">Email</label>
                                <input type="text" class="form-control" id="usrUserName" name="usrUserName" placeholder="Email" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['usrUserName']) ?>" required>
                            </div>
                        </div> 
                           
                 </div>
                 
                 <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="usrPassword">Password</label>
                                <input type="password" name="usrPassword" id="usrPassword" class="form-control" placeholder="Password" value="<?php echo Common_Nijsol_Class::Decrypt_Data($result[0]['usrPassword']) ?>">
                            </div>
                        </div>
                    
                       <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="usrConfirmPassword">Confirm Password</label>
                                <input type="password" name="usrConfirmPassword" id="usrConfirmPassword" class="form-control" placeholder="Confirm Password" value="<?php echo Common_Nijsol_Class::Decrypt_Data($result[0]['usrPassword']) ?>">
                            </div>
                        </div> 
                 </div>
                 
                 <div class="row">
                   <div class="col-xs-12 col-sm-6">
                        <div class="form-group checkboxes" >
                        <label>
                          <input type="checkbox" id="usrActive" name="usrActive" data-checkbox="icheckbox_square-blue" <?php echo ($result[0]['usrActive']==1)?'checked="checked"':'';?> value="1">
                            <span>Is Active</span>
                        </label>
                        </div>
                    </div> 
                 </div>
                 
                 
                 
                 
                
            
            <div class="row">
           
                   <div class="col-xs-12 col-sm-2">
                  <span style="font-size:20px;" ><strong>User Rights</strong></span>
                  </div>
                        
               </div>
                         <div class="row">
            <div class="col-lg-12">
                    
                       
                    <div class="col-xs-12 col-sm-12 i">
                        <!--<div class="form-group checkboxes" >
                        <label>
                        <input type="hidden" name="perStnIdFeild[]" value="<?php echo $_resut_section['stnId'];?>">
                        
                          <input type="checkbox" id="perStnId<?php echo $count;?>" name="perStnId[<?php echo $count;?>]" <?php echo ($resut_per[0]['perView']==1)?'checked="checked"':'';?> value="1">
                            <span><?php echo Common_Nijsol_Class::Get_Value($_resut_section['stnName']); ?></span>
                        </label>
                        </div>-->
                        
                        
                        <table class="table">
                 		<thead>
                        <tr>
                        <th>Select All</th>
                        <th>
   <div class="form-group checkboxes" style="margin-bottom:0px">
    <label>
   <input type="checkbox" id="all_view" name="all_view" data-checkbox="icheckbox_square-blue">
   <span>&nbsp;</span></label>
   </div>
   </th>
                        <th><div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="all_add" name="all_add" data-checkbox="icheckbox_square-blue"><span>&nbsp;</span></label>
   </div></th>
                        <th><div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="all_edit" name="all_edit" data-checkbox="icheckbox_square-blue"><span>&nbsp;</span></label>
   </div></th>
                        <th><div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="all_delete" name="all_delete" data-checkbox="icheckbox_square-blue"><span>&nbsp;</span></label>
   </div></th>
                       
                      </tr>
                      
                      <tr>
                        <th>Page Name</th>
                        <th style="width:12%">View Only</th>
                        <th style="width:12%">Add</th>
                        <th style="width:12%">Edit</th>
                        <th style="width:12%">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
						$resut_section=$this->Get_Rows(DB_PREFIX."section",'1=1','*','stnId'); 
						$count=0;
						
						foreach($resut_section as $_resut_section)
						{ 
						$sql="SELECT * FROM ".DB_PREFIX."permission WHERE perStnId='".$_resut_section['stnId']."'";
						$sql.=" and perUsrId='".Common_Nijsol_Class::Get_Value($_GET['id'])."' ";
						$resut_per=$this->Direct_Query($sql);
						
						
						?>
                      <tr>
                        <td><?php echo Common_Nijsol_Class::Get_Value($_resut_section['stnName']); ?></td>
                        <td>
      <input type="hidden" name="perStnIdFeild[]" value="<?php echo $_resut_section['stnId'];?>">
                        
                        <div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="perView<?php echo $count;?>" name="perView[<?php echo $count;?>]" <?php echo ($resut_per[0]['perView']==1)?'checked="checked"':'';?> value="1"><span>&nbsp;</span></label>
   </div>
						  </td>
                        
                        <td>
							   <div class="form-group checkboxes" style="margin-bottom:0px">
    <label> <input type="checkbox" id="perAdd<?php echo $count;?>" name="perAdd[<?php echo $count;?>]" <?php echo ($resut_per[0]['perAdd']==1)?'checked="checked"':'';?> value="1"><span>&nbsp;</span></label>
   </div>
						  </td>
                        
                        <td>
							  <div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="perEdit<?php echo $count;?>" name="perEdit[<?php echo $count;?>]" <?php echo ($resut_per[0]['perEdit']==1)?'checked="checked"':'';?> value="1"><span>&nbsp;</span></label>
   </div>
						  </td>
                        
                        
                        <td>
							   <div class="form-group checkboxes" style="margin-bottom:0px">
    <label><input type="checkbox" id="perDelete<?php echo $count;?>" name="perDelete[<?php echo $count;?>]" <?php echo ($resut_per[0]['perDelete']==1)?'checked="checked"':'';?> value="1"><span>&nbsp;</span></label>
   </div>
						  </td>
                        
                        
                      </tr>
                     <?php $count++;} ?>
                     <input type="hidden" name="count" id="count" value="<?php echo $count;?>"> 
                    </tbody>
                  </table>
                        
                        
                   
                   
            </div>
          </div>
                 
     
     <div class="row">
            <div class="col-lg-12">
            		 <label><strong>User Organisation Permission<br><br></strong></label>
            </div>
     </div> 
                 
            <div class="row">
            <div class="col-lg-12">
			<?php 
$resut_section=$this->Get_Rows(DB_PREFIX."schools",'1=1','*','schCode'); 
$orgcount=0;
						
foreach($resut_section as $_resut_section)
{ 
	$sql="SELECT * FROM ".DB_PREFIX."usr_organisation_permission WHERE schCode='".$_resut_section['schCode']."'";
	$sql.=" and usrId='".Common_Nijsol_Class::Get_Value($_GET['id'])."' ";
	$resut_per=$this->Direct_Query($sql);
			?>
		   
		<div class="col-xs-12 col-sm-6 i">
			<div class="form-group checkboxes" >
			<label>
<input type="hidden" name="schCodeFeild[]" value="<?php echo $_resut_section['schCode'];?>">
			
			  <input type="checkbox" id="schCode<?php echo $orgcount;?>" name="schCode[<?php echo $orgcount;?>]" <?php echo ($resut_per[0]['perView']==1)?'checked="checked"':'';?> value="1">
				<span><?php echo Common_Nijsol_Class::Get_Value($_resut_section['schName'])." (". Common_Nijsol_Class::Get_Value($_resut_section['schDivision']).")"; ?></span>
			</label>
			</div>
		</div>
			
<?php $orgcount++;
} ?>
		 <input type="hidden" name="orgcount" id="orgcount" value="<?php echo $orgcount;?>"> 
                   
            </div>
          </div>     
                 
                 
                 
                 
                    
                 
                   <div class="row">
                        <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                            	<input type="hidden" name="type" id="type" value="<?php echo $_GET['mode'];?>">
                              	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">	
                                <button type="submit" class="<?php echo BTN_ADD;?>">Save</button>
                         </div>
                        </div>
                        
                      <div class="col-xs-12 col-sm-3">
                            <div class="form-group">
                                <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>user-manage.php');">Close</button>
                            </div>
                        </div>
                    </div>
              </div>
			</form>
    <?php }?>        
           </div>
		</div>

<?php $common_bottom = new Common_Bottom();
$common_bottom->ALL_Common_Bottom();
?>
<script src="<?php echo SITE_URL;?>js/user-manage.js"></script>
<?php }
}
$user_add_edit = new User_Add_Edit();
$user_add_edit->All_User_Add_Edit();	
?>