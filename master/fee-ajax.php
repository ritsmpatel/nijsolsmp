<?php require_once "../includes/general-includes-db.php";
class Ajax_Fee_Class extends DataBase
{
		
	   function Ajax_Select_Student()
	   {?>
       <option value="">- Select Student Name -</option>
		<?php $result=$this->Get_Rows(DB_PREFIX."student"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdCurrentStandard='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."' and stdCurrentClass='".Common_Nijsol_Class::Set_Value($_GET['feeClassId'])."' and stdActive='1'",'stdId, stdSurname, stdStudentName, stdFatherName','stdSurname'); 
    	foreach($result as $_result)
		{ ?>
		<option value="<?php echo Common_Nijsol_Class::Get_Value($_result['stdId']);?>"><?php echo Common_Nijsol_Class::Get_Value($_result['stdSurname'])." ".Common_Nijsol_Class::Get_Value($_result['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($_result['stdFatherName']);?></option>	
			
	<?php } 
     }
	 
	 
	 function Ajax_Select_Term()
	   {?>
       	<option value="">- Select Term -</option>
		<?php $result=$this->Get_Rows(DB_PREFIX."fee_structure_setup"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and fssStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."'",'distinct fssFeeCollectionId','fssFeeCollectionId');
		foreach($result as $_result)
		{ 
		?>
		<option value="<?php echo Common_Nijsol_Class::Get_Value($_result['fssFeeCollectionId']);?>"><?php echo Common_Nijsol_Class::Get_One_Name("fee_collection_type","fctType","fctId=".Common_Nijsol_Class::Get_Value($_result['fssFeeCollectionId']));?></option>	
	<?php } 
     }
	 
	 
	 function Ajax_Select_Head()
	   {?>
       <option value="">- Select Head -</option>
		<?php $result=$this->Get_Rows(DB_PREFIX."fee_structure_setup"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and fssStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."'",'distinct fssOrganisationId','fssFeeCollectionId'); 
    	foreach($result as $_result)
		{ 
		?>
		<option value="<?php echo Common_Nijsol_Class::Get_Value($_result['fssOrganisationId']);?>"><?php echo Common_Nijsol_Class::Get_One_Name("organisation_name","orgShortName","orgId=".Common_Nijsol_Class::Get_Value($_result['fssOrganisationId']));?></option>	
	<?php } 
     }
	 
	 
	 function Ajax_Select_Fees()
	   {?>
       <?php $result=$this->Direct_Query("SELECT sum(feeTotalFees) as feeTotalFees FROM ".DB_PREFIX."fee WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and feeStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."' and feeStudentId='".Common_Nijsol_Class::Set_Value($_GET['feeStudentId'])."' and feeTypeTermId='".Common_Nijsol_Class::Set_Value($_GET['feeTypeTermId'])."'");
	    $feeTotalFees=Common_Nijsol_Class::Get_Value($result[0]['feeTotalFees']);
		
		$result=$this->Direct_Query("SELECT sum(fssFeeAmount) as fssFeeAmount FROM ".DB_PREFIX."fee_structure_setup WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and fssStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."' and fssFeeCollectionId='".Common_Nijsol_Class::Set_Value($_GET['feeTypeTermId'])."'");
	    $perStdTotalFees=Common_Nijsol_Class::Get_Value($result[0]['fssFeeAmount']);
		
		$remainingFees=$perStdTotalFees-$feeTotalFees;
		?>
		
        
      <div class="row">
			<div class="col-xs-12 col-sm-4">
                    	<div class="tableWrap table-responsive">
                    		<table class="table">
							<thead>
								<tr>
									<th>Fees Head</th>
									<th style="width:80px">Amount</th>
								</tr>
							</thead>
							<tbody>
                            
                            <?php if($remainingFees>0){	?>
                           <tr>
                           		<td><?php echo Common_Nijsol_Class::Get_One_Name("fee_collection_type","fctType","fctId=".Common_Nijsol_Class::Get_Value($_GET['feeTypeTermId']));?></td>
                           		<td class="text-right"><?php echo $remainingFees;?></td>
                           </tr>
							 <?php } else {?>    
                           <tr><td class="text-center" colspan="2">No Remaining Fees</td></tr>
							  <?php }?>    
							</tbody>
						</table>
                </div>
           </div>         
                    <div class="col-xs-12 col-sm-6  col-md-offset-2">
                    
                    <?php if($remainingFees>0){	?>
                    
                    		<div class="tableWrap table-responsive">
                    		<table class="table">
							<thead>
								<tr>
									<th>Fees Name</th>
									<th style="width:100px">Amount</th>
								</tr>
							</thead>
							<tbody>
                          <?php $result=$this->Get_Rows(DB_PREFIX."fee_structure_setup"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and fssStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."' and fssFeeCollectionId='".Common_Nijsol_Class::Set_Value($_GET['feeTypeTermId'])."'",'fssId,fssFeeNameId,fssFeeAmount','fssId'); 
		$count=0;
		$totalFees=0;	
    	foreach($result as $_result)
		{ 
			$result_paid=$this->Direct_Query("SELECT sum(feedAmount) as feedAmount FROM ".DB_PREFIX."fee fe,".DB_PREFIX."fee_details fd  WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and feeStandardId='".Common_Nijsol_Class::Set_Value($_GET['feeStandardId'])."' and feeStudentId='".Common_Nijsol_Class::Set_Value($_GET['feeStudentId'])."' and feeTypeTermId='".Common_Nijsol_Class::Set_Value($_GET['feeTypeTermId'])."' and fe.feeId=fd.feedFeeId and feedFeesNameId='".Common_Nijsol_Class::Get_Value($_result['fssFeeNameId'])."'");
	    $feedAmount_paid=Common_Nijsol_Class::Get_Value($result_paid[0]['feedAmount']);
		
		if($_result['fssFeeAmount']>$feedAmount_paid)
		{
			$amount=$_result['fssFeeAmount']-$feedAmount_paid;
			$totalFees+=$amount;
		?>
       <tr>
            <td style="vertical-align:middle"><?php echo Common_Nijsol_Class::Get_One_Name("fee_name_setup","fnsName","fnsId=".Common_Nijsol_Class::Get_Value($_result['fssFeeNameId']));?></td>
            <td class="text-right"><input type="text" class="form-control" id="feedAmount<?php echo $count;?>" name="feedAmount[<?php echo $_result['fssFeeNameId'];?>]" value="<?php echo Common_Nijsol_Class::Get_Value($amount);?>" onkeypress="return Is_Number(event);" style="margin-bottom: 0px;" onBlur="Total_Fees();">
            
            <input type="hidden" id="feedFeesNameId" name="feedFeesNameId[<?php echo $_result['fssFeeNameId'];?>]" value="<?php echo Common_Nijsol_Class::Get_Value($_result['fssFeeNameId']);?>"></td>
       </tr>
	<?php $count++; 
		}
		
		} 
	   ?>
       
     <tr>
            <td class="text-right" style="vertical-align:middle"><strong>Total Fees</strong></td>
            <td><input type="text" class="form-control" id="feeTotalFees" name="feeTotalFees" placeholder="Total Fees" readonly onkeypress="return Is_Number(event);" value="<?php echo Common_Nijsol_Class::Get_Value($totalFees);?>" style="margin-bottom: 0px;" required></td>
     </tr>  
     
      <tr>
            <td class="text-right" style="vertical-align:middle"><strong>Scholarship(%)</strong></td>
            <td><?php $stdFeeInPercentage=Common_Nijsol_Class::Get_One_Name("student","stdFeeInPercentage","stdId=".Common_Nijsol_Class::Get_Value($_GET['feeStudentId']));
			
			if(empty($stdFeeInPercentage))
			{
				$stdFeeInPercentage=100;
			}
			$feeScholarshipPercentage=100-$stdFeeInPercentage;
			$feeTotalReceiveAmount=$totalFees-($totalFees*$feeScholarshipPercentage)/100;
			
			?>
            <input type="text" class="form-control" id="feeScholarshipPercentage" name="feeScholarshipPercentage" placeholder="Scholarship" onkeypress="return Is_Number(event);" style="margin-bottom: 0px;" required onBlur="Total_Fees();" value="<?php echo $feeScholarshipPercentage;?>"></td>
     </tr>  
     
     <tr>
            <td class="text-right" style="vertical-align:middle"><strong>Total</strong></td>
            <td><input type="text" class="form-control" id="feeTotalReceiveAmount" name="feeTotalReceiveAmount" placeholder="Total Fees" readonly onkeypress="return Is_Number(event);" style="margin-bottom: 0px;" required value="<?php echo $feeTotalReceiveAmount;?>"></td>
     </tr>         
      <input type="hidden" id="totalRow" name="totalRow" value="<?php echo $count;?>" required>  
							</tbody>
						</table>
                </div>
                            
          <?php }?>          		
                  
       
      </div>    
          
    <?php }
	 
}	
if($_GET['act']=="select_student" && $_GET['type']=="select")
{
	$ajax_fee_class= new Ajax_Fee_Class();
	$result=$ajax_fee_class->Ajax_Select_Student();	 
}


if($_GET['act']=="select_term" && $_GET['type']=="select")
{
	$ajax_fee_class= new Ajax_Fee_Class();
	$result=$ajax_fee_class->Ajax_Select_Term();	 
}

if($_GET['act']=="select_head" && $_GET['type']=="select")
{
	$ajax_fee_class= new Ajax_Fee_Class();
	$result=$ajax_fee_class->Ajax_Select_Head();	 
}

if($_GET['act']=="select_fees" && $_GET['type']=="select")
{
	$ajax_fee_class= new Ajax_Fee_Class();
	$result=$ajax_fee_class->Ajax_Select_Fees();	 
}

?>