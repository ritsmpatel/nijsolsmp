<?php define("menu_main","master");
	  define("menu_sub","trustee_information");
require_once("../includes/top.php");
class Trustee_Information_Add_Edit extends DataBase
{
	function All_Trustee_Information_Add_Edit()
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
                    <li><a href="<?php echo MASTER_URL;?>trustee-information-manage.php">Manage Trustee Information</a></li>
                    <li class="active"><?php echo ucwords($_GET['mode']);?> Trustee Information</li>
                </ol>
            </div>
            <div class="pull-right margin-top-btn"></div>
      </div>
			
	  <?php if((!empty($_GET['id']) && (!empty($_GET['mode']) == 'edit')) || (!empty($_GET['mode']) == 'add'))
        {
         $result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."trustee WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and trsId='".Common_Nijsol_Class::Set_Value($_GET['id'])."'"); 
    ?>   	
			<form class="form-trustee" method="post" action="trustee-information-db.php">
				<div class="box rte">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsName">Trustee Name</label>
                                <input type="text" class="form-control" id="trsName" name="trsName" placeholder="Trustee Name" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsName']) ?>" required>
                            </div>
                        </div>
                    
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsDesignation">Designation</label>
                                <input type="text" class="form-control" id="trsDesignation" name="trsDesignation" placeholder="Designation" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsDesignation']) ?>" >
                            </div>
                        </div>
                           
                 </div>
                    
                    
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="trsAddress">Address</label>
                                <textarea id="trsAddress" name="trsAddress" class="form-control" rows="3" placeholder="Address"><?php echo Common_Nijsol_Class::Get_Value($result[0]['trsAddress'])?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                    <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsTaluka">Taluka</label>
                                <input type="text" class="form-control" id="trsTaluka" name="trsTaluka" placeholder="Taluka" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsTaluka']) ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsCity">City</label>
                                <input type="text" class="form-control" id="trsCity" name="trsCity" placeholder="City" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsCity']) ?>">
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsDistrict">District</label>
                                <input type="text" class="form-control" id="trsDistrict" name="trsDistrict" placeholder="District" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsDistrict']) ?>" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsState">State</label>
                                <input type="text" class="form-control" id="trsState" name="trsState" placeholder="State" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsState']) ?>" >
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsPinCode">PinCode</label>
                                <input type="text" class="form-control" id="trsPinCode" name="trsPinCode" placeholder="PinCode" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsPinCode']) ?>" maxlength="6" onkeypress="return Is_Number(event);" >
                            </div>
                        </div>
                      <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsSTDCode">STD Code</label>
                                <input type="text" class="form-control" id="trsSTDCode" name="trsSTDCode" placeholder="STD Code" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsSTDCode']) ?>" >
                            </div>
                        </div>  
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsPhoneOffice">Phone (O)</label>
                                <input type="text" class="form-control" id="trsPhoneOffice" name="trsPhoneOffice" placeholder="Phone (O)" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsPhoneOffice']) ?>" onkeypress="return Is_Number(event);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsPhoneResidence">Phone (R)</label>
                                <input type="text" class="form-control" id="trsPhoneResidence" name="trsPhoneResidence" placeholder="Phone (R)" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsPhoneResidence']) ?>" onkeypress="return Is_Number(event);">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsMobileNo">Mobile No.</label>
                                <input type="text" class="form-control" id="trsMobileNo" name="trsMobileNo" placeholder="Mobile No." value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsMobileNo']) ?>" maxlength="10" onkeypress="return Is_Number(event);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsFax">Fax</label>
                                <input type="text" class="form-control" id="trsFax" name="trsFax" placeholder="Fax" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsFax']) ?>" >
                            </div>
                        </div>
                  </div>
                    
                    
                   <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="trsEmail">Email</label>
                                <input type="email" class="form-control" id="trsEmail" name="trsEmail" placeholder="Email" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['trsEmail']) ?>" >
                            </div>
                        </div>
                        
                      <?php
						if(!empty($_GET['id']))
						{ ?>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="editMessage">Edit Message</label>
                                <input type="text" class="form-control" id="editMessage" name="editMessage" placeholder="Edit Message" value="<?php echo Common_Nijsol_Class::Get_Value($result[0]['editMessage']) ?>" >
                            </div>
                        </div>
                     <?php }?>
                        
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
                                <button type="button" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>trustee-information-manage.php');">Close</button>
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
<script src="<?php echo SITE_URL;?>js/trustee-information-manage.js"></script>
<?php }
}
$trustee_information_add_edit = new Trustee_Information_Add_Edit();
$trustee_information_add_edit->All_Trustee_Information_Add_Edit();	
?>