<?php require_once "../includes/general-includes-db.php";
class Ajax_Student_Class extends DataBase
{
		function Ajax_Exists_GrNo(){
			$column=" stdGrNo='".Common_Nijsol_Class::Set_Value($_POST['stdGrNo'])."' and schCode='".Common_Nijsol_Class::Get_Session('schCode')."'";
			
			 if(!empty($_POST['id']))
			 {
				  $column.=" and stdId!='".Common_Nijsol_Class::Set_Value($_POST['id'])."'";
			 }
			
					 $field = 'count(stdGrNo) as total';
					$result=$this->Get_Rows(DB_PREFIX."student",$column,$field);
					
					if($result[0]['total'] > 0)	
					{
						echo "false";
					}
					else
					{
						echo "true";
					}
			
		}
		
	
		function Ajax_Remove_Student_Photo()
		{
			  $column=array('stdPhoto'=>'');
			  $where = array('stdId'=>$_GET['stdId']);	
			  $resut=$this->Update_Row(DB_PREFIX."student",$column, $where);
			  Common_Nijsol_Class::Remove_Session('student-photo');
		}
		
		function Ajax_Select_Standard_Class()
		{ ?> 
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['clsId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['StdId'])."'", "clsId"); 
		
		}
		
		function Ajax_Select_Class()
		{
			?>
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['stdAdmissionClass']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdAdmissionStandard'])."'", "clsId"); 
		}	
	   function Ajax_Select_Current_Class()
		{
			?>
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['stdCurrentClass']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdCurrentStandard'])."'", "clsId"); ?>
       <?php }	
	   
	   function Ajax_Select_Compulsary_Subject()
	   {?>
		   <label for="stdCompulsarySubject"><strong>Compulsary Subject</strong></label>
								<?php $result_com_sub=$this->Get_Rows(DB_PREFIX."subject"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and subStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdCurrentStandard'])."' and subType='Compalsary'",'subId, subName','subId'); 
						$stdCompulsarySubject=explode(",", $_GET['stdCompulsarySubject']);
								  foreach($result_com_sub as $_result_com_sub)
                                { ?>
    <label>
    <input type="checkbox" id="stdCompulsarySubject<?php echo $_result_com_sub['subId'];?>" name="stdCompulsarySubject[<?php echo $_result_com_sub['subId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_com_sub['subId'], $stdCompulsarySubject))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_com_sub['subName']);?></span>
    </label>
	<?php } 
     }
	 
	 
	 function Ajax_Select_Group_Subject()
	   {?>
		   <label for="stdGroupedSubject"><strong>Grouped Subject</strong></label>
								<?php $result_com_sub=$this->Get_Rows(DB_PREFIX."subject"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and subStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdCurrentStandard'])."' and subType='Group'",'subId, subName','subId'); 
						$stdGroupedSubject=explode(",", $_GET['stdGroupedSubject']);
								  foreach($result_com_sub as $_result_com_sub)
                                { ?>
    <label>
    <input type="checkbox" id="stdGroupedSubject<?php echo $_result_com_sub['subId'];?>" name="stdGroupedSubject[<?php echo $_result_com_sub['subId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_com_sub['subId'], $stdGroupedSubject))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_com_sub['subName']);?></span>
    </label>
	<?php } 
     }
	 
	  
	 function Ajax_Select_Optional_Subject()
	   {?>
		   <label for="stdOptionalSubject"><strong>Optional Subject</strong></label>
								<?php $result_com_sub=$this->Get_Rows(DB_PREFIX."subject"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and subStandardId='".Common_Nijsol_Class::Set_Value($_GET['stdCurrentStandard'])."' and subType='Optional'",'subId, subName','subId'); 
						$stdOptionalSubject=explode(",", $_GET['stdOptionalSubject']);
								  foreach($result_com_sub as $_result_com_sub)
                                { ?>
    <label>
    <input type="checkbox" id="stdOptionalSubject<?php echo $_result_com_sub['subId'];?>" name="stdOptionalSubject[<?php echo $_result_com_sub['subId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_com_sub['subId'], $stdOptionalSubject))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_com_sub['subName']);?></span>
    </label>
	<?php } 
     }
	 
	 
	 
	 
	 
	 function Ajax_Select_ValidFeeCollection()
	   {?>
		   <label for="stdValidFeeCollection"><strong>Valid Fee Collection</strong></label>
								<?php $result_freecol=$this->Get_Rows(DB_PREFIX."fee_collection_type"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and fctCategory='".Common_Nijsol_Class::Set_Value($_GET['stdFeeCategory'])."'",'fctId, fctType','fctId'); 
						
						$stdValidFeeCollection=explode(",", $_GET['stdValidFeeCollection']);
								  foreach($result_freecol as $_result_freecol)
                                { ?>
    <label>
    <input type="checkbox" id="stdValidFeeCollection<?php echo $_result_freecol['fctId'];?>" name="stdValidFeeCollection[<?php echo $_result_freecol['fctId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_freecol['fctId'], $stdValidFeeCollection))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_freecol['fctType']);?></span>
    </label>
	<?php } 
     }   
}	

if($_GET['act']=="student" && $_GET['type']=="remove")
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Remove_Student_Photo();	 
}
if($_GET['act']=="class" && $_GET['type']=="select" && !empty($_GET['stdAdmissionStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Class();	 
}

if($_GET['act']=="class" && $_GET['type']=="select" && !empty($_GET['stdCurrentStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Current_Class();	 
}


if($_GET['act']=="compulsary_subject" && $_GET['type']=="select" && !empty($_GET['stdCurrentStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Compulsary_Subject();	 
}

if($_GET['act']=="group_subject" && $_GET['type']=="select" && !empty($_GET['stdCurrentStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Group_Subject();	 
}

if($_GET['act']=="optional_subject" && $_GET['type']=="select" && !empty($_GET['stdCurrentStandard']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Optional_Subject();	 
}

if($_GET['act']=="valid_fee_collection" && $_GET['type']=="select" && !empty($_GET['stdFeeCategory']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_ValidFeeCollection();	 
}

if($_GET['act']=="standard_class" && $_GET['type']=="select" && !empty($_GET['StdId']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Standard_Class();	 
}

if($_POST['act']=="grNo")
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Exists_GrNo();	 
}
?>