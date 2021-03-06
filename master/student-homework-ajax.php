<?php require_once "../includes/general-includes-db.php";
class Ajax_Student_Class extends DataBase
{
		function Ajax_Select_Class()
		{
			?>
			<option value="">- Select Class -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_GET['swkStudentClassId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_GET['swkStudentStandardId'])."'", "clsId"); 
		}	
		
		function Ajax_Select_Subject()
		{
			?>
			<option value="">- Select Subject -</option>
       		<?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."subject", "subId", "subName",Common_Nijsol_Class::Set_Value($_GET['swkSubjectId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and subStandardId='".Common_Nijsol_Class::Set_Value($_GET['swkStudentStandardId'])."'", "subId"); ?>
		<?php }
		
		
		function Ajax_Select_Student()
	   {?>
		   <label for="swkStudentId"><strong>Student List</strong></label>
            <div class="row">
            	<div class="col-xs-12 col-sm-4 i">   
            		<label>
   						 <input type="checkbox" id="selectAll" name="selectAll" data-checkbox="icheckbox_square-blue" onClick="Select_All_Student();" <?php echo empty($_GET['id'])?'checked="checked"':"";?>><span>Select All Students</span>
                    </label>     
                </div>
            </div>
           <div class="row"> 
                   	<?php $result_student=$this->Get_Rows(DB_PREFIX."student"," schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stdActive=1 and stdCurrentStandard='".Common_Nijsol_Class::Set_Value($_GET['swkStudentStandardId'])."' and stdCurrentClass='".Common_Nijsol_Class::Set_Value($_GET['swkStudentClassId'])."'",'stdId, stdSurname,stdStudentName,stdFatherName,stdRollNo','stdRollNo'); 
						$swkStudentId=explode(",", $_GET['swkStudentId']);
						$count=0;
								  foreach($result_student as $_result_student)
                                { ?>
    <div class="col-xs-12 col-sm-4 i">  
    <label>
    <input type="checkbox" id="swkStudentId<?php echo $count;?>" name="swkStudentId[<?php echo $_result_student['stdId'];?>]"  <?php echo !empty($_GET['id'])?(in_array($_result_student['stdId'], $swkStudentId))?'checked="checked"':'':'checked="checked"';?> data-checkbox="icheckbox_square-blue" value="1">
    <span><?php echo Common_Nijsol_Class::Get_Value($_result_student['stdRollNo'])." - ".Common_Nijsol_Class::Get_Value($_result_student['stdSurname'])." ".Common_Nijsol_Class::Get_Value($_result_student['stdStudentName'])." ".Common_Nijsol_Class::Get_Value($_result_student['stdFatherName']);?></span>
    </label>
   </div>
	<?php $count++; } ?>
	</div>
    <input type="hidden" id="countRow" name="countRow" value="<?php echo $count;?>">
    <?php }
}	
if($_GET['act']=="class" && $_GET['type']=="select" && !empty($_GET['swkStudentStandardId']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Class();	 
}

if($_GET['act']=="subject" && $_GET['type']=="select" && !empty($_GET['swkStudentStandardId']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Subject();	 
}

if($_GET['act']=="select_student" && $_GET['type']=="select" && !empty($_GET['swkStudentStandardId']))
{
	$ajax_student_class= new Ajax_Student_Class();
	$result=$ajax_student_class->Ajax_Select_Student();	 
}
?>