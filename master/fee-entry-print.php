<?php require_once "../includes/general-includes-db.php";
	include("../includes/number2words.php");
class Fee_Entry_Print extends DataBase
{
function All_Fee_Entry_Print()
{	
require_once('../pdf/examples/tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', '', 9);	
			
$pdf->AddPage("L");
	$html_table="";
	$html_table.='
<style type="text/css">
 .table{
	font-size:16px;
}
.th{
	background-color:#CCCCCC;
	font-size:18px;
}
.padding{
	padding-top:8px;
	padding-bottom:8px;
}
.table_Width
{
	width:450px;
}
.text-left
{
	text-align:left;
}
.text-center
{
	text-align:center;
}
.text-right
{
	text-align:right;
}
.td_bg
{
	background-color:#CCCCCC;
	padding:5px 0px;
}
.bold
{
	font-weight:bold;
}
.font-size
{
	font-size:16px;
}


.border-top
{
	border-top:1px solid #000;
}
.border-bottom
{
	border-bottom:1px solid #000;
}
.border-left
{
	border-left:1px solid #000;
}
.border-right
{
	border-right:1px solid #000;
}
 </style>';

$settings=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."settings WHERE stgId=1");
$logo=$settings[0]['stgLogo'];	
$html_table.='<table class="table_Width" align="center" cellspacing="0" cellpadding="5">
    <tr>';
    	if(!empty($logo)) {
		$html_table.='<td width="140" class="font-size text-center border-left border-top"><img height="100" src="';
		$html_table.="../photo/".Common_Nijsol_Class::Get_Value($logo); 
		$html_table.='" /></td>
		
		';
		}
		$html_table.='<td ';
		if(!empty($logo)) {
			$html_table.='width="310"';
		}
		else
		{
			$html_table.='width="450"';
		}
		$html_table.=' class="font-size text-center border-right border-top ';
		if(empty($logo)) {
			$html_table.=' border-left ';
		}
		$html_table.=' ">
		<span style="font-size:18px"><strong><u>'.Common_Nijsol_Class::Get_Session('schName').'</u></strong></span>
		<br>
		<span style="font-size:14px">
		Managed By<br><strong>'.Common_Nijsol_Class::Get_Value($settings[0]['stgName']).'</strong></span>
		<br>
		<span style="font-size:12px">'.nl2br(Common_Nijsol_Class::Get_Value($settings[0]['stgAddress'])).'</span>
		</td>
    </tr>
	
	</table>
	<table class="table_Width" align="center" cellspacing="0" cellpadding="5">';
	
	
   	
$feeReceiptNo=Common_Nijsol_Class::Set_Value($_REQUEST['feeReceiptNo']);		  	 	
				
		$result=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."fee WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and feeReceiptNo='".$feeReceiptNo."' ");
		
if(!empty($feeReceiptNo) && $_REQUEST["mode"]="print")
{		
	$stdName=$this->Direct_Query("SELECT stnName FROM ".DB_PREFIX."standard WHERE schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and stnId='".Common_Nijsol_Class::Get_Value($result[0]['feeStandardId'])."' ");
	$printedBy=$this->Direct_Query("SELECT usrName FROM ".DB_PREFIX."usr WHERE usrId='".Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)."' ");
	$receiptBy=$this->Direct_Query("SELECT usrName FROM ".DB_PREFIX."usr WHERE usrId='".Common_Nijsol_Class::Get_Value($result[0]['usrId'])."' ");
$html_table.='
	<tr>
    	<th width="330" class="text-left border-left border-top" colspan="2">Student Name : '.Common_Nijsol_Class::Get_Value($result[0]['feeStudentName']).' </th>
        <th width="120" class="text-left border-right border-top">Receipt No : '.Common_Nijsol_Class::Get_Value($result[0]['feeReceiptNo']).'</th>
	</tr>
	
	<tr>
    	<th width="330" class="text-left border-left border-bottom" colspan="2">Std : '.Common_Nijsol_Class::Get_Value($stdName[0]['stnName']).'</th>
        <th width="120" class="text-left border-right border-bottom">Date : '.Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($result[0]['feeDate']).'</th>
	</tr>
	';
	
	
	
$html_table.='
	<tr>
    	<th width="30" class="text-center border-left border-right border-bottom">No.</th>
        <th width="300" class="text-center border-bottom">Particulars</th>
        <th width="120" class="text-center border-left border-right border-bottom">Amount</th>
	</tr>';
	
			$feedName=$this->Get_Rows(DB_PREFIX."fee_details"," feedFeeId='".Common_Nijsol_Class::Get_Value($result[0]['feeId'])."'",'feedFeesName, feedAmount','feedId'); 
			$count=1;$total=0;
			foreach($feedName as $_feedName)
			{
            	$html_table.='<tr>
				<td width="30" class="text-center border-left border-right">';
				$html_table.=$count++;
				$html_table.='</td>
				<td width="300" class="text-left">';
				$html_table.=Common_Nijsol_Class::Get_Value($_feedName['feedFeesName']); 
				$html_table.='</td>
				
				<td width="120" class="text-right border-left border-right">';
				$html_table.=Common_Nijsol_Class::Get_Value($_feedName['feedAmount']); 
				$total+=$_feedName['feedAmount'];
				$html_table.='</td>
			</tr>';	
			}
			for($i=13;$i>$count;$i--)
			{
				$html_table.='<tr>
					<th width="30" class="text-center border-left border-right"></th>
					<th width="300" class="text-center"></th>
					<th width="120" class="text-center border-left border-right"></th>
				</tr>';
			}
			
	$html_table.='
	<tr>
    	<td width="330"  class="text-right border-left border-bottom border-top" colspan="2">Total </td>
        <td width="120" class="text-right border-left border-right border-bottom border-top">'.Common_Nijsol_Class::Get_Value($result[0]['feeTotalFees']).'</td>
	</tr>';
	
	if($result[0]['feeScholarshipPercentage']>0)
	{
	$html_table.='
	<tr>
    	<td width="330"  class="text-right border-left border-bottom" colspan="2">Scholarship(%)</td>
        <td width="120" class="text-right border-left border-right border-bottom">'.Common_Nijsol_Class::Get_Value($result[0]['feeScholarshipPercentage']).'</td>
	</tr>';
	}
	
			$html_table.='
			<tr>
				<th width="330"  class="text-left border-left border-bottom" colspan="2">In Words : ' ;
			$numStr = new Number2Word(round(Common_Nijsol_Class::Get_Value($result[0]['feeTotalReceiveAmount'])),1);
			 $html_table.= $numStr->number_in_words;
				if($resut[0]['est_grand_total']>0)
				{
					$html_table.=" Rupees";
				}
				$paises=substr(Common_Nijsol_Class::Get_Value($result[0]['feeTotalReceiveAmount']),-2);
				if($paises>0)
				{
					$html_table.= " And ";
					$numStr = new Number2Word($paises,1);
					$html_table.= $numStr->number_in_words;
					 $html_table.= " Paises";
				}
				
				$html_table.=' </th>
				<th width="120" class="text-right border-right border-bottom">Total : '.Common_Nijsol_Class::Get_Value($result[0]['feeTotalReceiveAmount']).'</th>
			</tr>';
			
		$html_table.='
		<tr>
			<th  class="text-left">Receipt By : '.Common_Nijsol_Class::Get_Value($receiptBy[0]['usrName']).'</th>
			<th  class="text-right"></th>
			<th class="text-right"> Printed By : '.Common_Nijsol_Class::Get_Value($printedBy[0]['usrName']).'</th>
		</tr>';
}
			
			
$html_table.='</table><br><br>';
/*echo $html_table;*/
	$pdf->writeHTML($html_table, true, 0, true, 0);
	
$pdf->lastPage();
$pdf->Output('fee-receipt-'.$feeReceiptNo.'-'.date("Ymd").'.pdf', 'I');
}
}
$fee_entry_print = new Fee_Entry_Print();
$fee_entry_print->All_Fee_Entry_Print();
?>