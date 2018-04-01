<?php define("menu_main","master");	  define("menu_sub","fee_receipt_cancellation");require_once("../includes/top.php");class Fee_Receipt_Cancellation extends DataBase{	function All_Fee_Receipt_Cancellation()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();			$fromDate=(empty($_POST['fromDate']))?date("01-m-Y"):Common_Nijsol_Class::Get_Value($_POST['fromDate']);$toDate=(empty($_POST['toDate']))?date("d-m-Y"):Common_Nijsol_Class::Get_Value($_POST['toDate']);	?>

<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Fee Receipt View/Cancellation </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active">Fee Receipt View/Cancellation</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <div class="box box-without-bottom-padding">
      <form role="form" class="form-horizontal form-fee-receipt-cancellation-search" method="post" action="fee-receipt-cancellation.php" id="form-fee-receipt-cancellation-search">
        <div class="box rte margin-padding-0">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="form-group">
                <label for="fromDate">From Date</label>
                <div id="fromDate" class="input-group date">
                  <input type="text" class="form-control" id="fromDate" name="fromDate" placeholder="From Date" value="<?php echo $fromDate;?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-1">
              <div class="form-group">
                <label for="toDate">To Date</label>
                <div id="toDate" class="input-group date">
                  <input type="text" class="form-control" id="fromDate" name="toDate" placeholder="To Date" value="<?php echo $toDate;?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-2">
              <div class="form-group">
                <label for="StdId">Standard</label>
                <select class="select2 js-select2 form-control" id="StdId" name="StdId" onChange="OnChanges_Standard_Cancellation('<?php echo MASTER_URL;?>',this.value,'');">
                  <option value="">- Select Standard -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",$_POST['StdId'], " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' ", "stnId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-sm-offset-1">
              <div class="form-group">
                <label for="clsId">Class Name</label>
                <select class="select2 js-select2 form-control" id="clsId" name="clsId">
                  <option value="">- Select Class -</option>
                  <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."class", "clsId", "clsName",Common_Nijsol_Class::Set_Value($_POST['clsId']), " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and clsStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."'", "clsId"); ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-sm-offset-1">
              <div class="form-group">
                <label for="SearchField">Rpt. No. / Student Name</label>
                <input type="text" class="form-control" id="SearchField" name="SearchField" placeholder="Search" value="<?php echo $_POST["SearchField"]; ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-sm-offset-1">
              <div class="form-group">
                <label>&nbsp;</label>
                <button class="<?php echo BTN_ADD;?> btn-lg" type="submit">Fetch</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="tableWrap dataTable table-responsive js-select">
        <table id="fee-receipt-cancellation-list" class="table js-datatable fee-receipt-cancellation-list" data-page-length='50'>
          <thead>
            <tr>
              <th>Rpt. No.</th>
              <th>Date</th>
              <th>Student Name</th>
              <th>Std.</th>
              <th>Term</th>
              <th>Total Fees</th>
              <th>Scholarship</th>
              <th>Rec. Amt.</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $where="";							if(!empty($_POST['StdId']))							{								$where.="and feeStandardId='".Common_Nijsol_Class::Set_Value($_POST['StdId'])."'";							}														if(!empty($_POST['clsId']))							{								$where.="and feeClassId='".Common_Nijsol_Class::Set_Value($_POST['clsId'])."'";							}														if(!empty($_POST['SearchField']))							{								$where.="and (feeReceiptNo = '".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."' OR feeStudentName LIKE '%".Common_Nijsol_Class::Set_Value($_POST['SearchField'])."%') ";							}														$result=$this->Get_Rows(DB_PREFIX."fee","schCode='".Common_Nijsol_Class::Get_Session('schCode')."' and feeDate BETWEEN '".Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($fromDate)."' and '".Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($toDate)."' ".$where,'feeId, feeReceiptNo, feeStudentName, feeTotalFees, feeDate, feeTypeTerm, feeStandard, feeClass, feeScholarshipPercentage, feeTotalReceiveAmount','feeReceiptNo'); 														foreach($result as $_result)							{ ?>
            <tr>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['feeReceiptNo']); ?></td>
              <td><?php echo Common_Nijsol_Class::Convert_Date_To_Ddmmyyyy($_result['feeDate']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['feeStudentName']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['feeStandard'])." - ".Common_Nijsol_Class::Get_Value($_result['feeClass']); ?></td>
              <td><?php echo Common_Nijsol_Class::Get_Value($_result['feeTypeTerm']); ?></td>
              <td class="text-right"><?php echo Common_Nijsol_Class::Get_Value($_result['feeTotalFees']); ?></td>
              <td class="text-right"><?php echo Common_Nijsol_Class::Get_Value($_result['feeScholarshipPercentage'])."%"; ?></td>
              <td class="text-right"><?php echo Common_Nijsol_Class::Get_Value($_result['feeTotalReceiveAmount']); ?></td>
              <td><?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perEdit')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="edit-link" onClick="window.open('<?php echo MASTER_URL;?>fee-entry-print.php?feeReceiptNo=<?php echo $_result['feeReceiptNo']; ?>&mode=print')"><i class="fa fa-fw fa-print"></i></a> <?php }?> 
 <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perDelete')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><a href="javascript:void(0);" class="delete-link" onClick="Common_Delete_Row('<?php echo MASTER_URL;?>fee-receipt-cancellation.php?id=<?php echo $_result['feeId']; ?>&mode=delete')"><i class="fa fa-fw fa-trash"></i></a><?php }?></td>
            </tr>
            <?php }						  	 ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();		 $common_bottom->ALL_Common_Bottom(); ?>
<script src="<?php echo SITE_URL;?>js/fee-entry.js"></script>
<?php }	function Delete_Fee_Receipt_Cancellation($id)	{		$where = array(				'feeId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."fee", $where);				$where = array(				'feedFeeId'=>$id		);		$result=$this->Delete_Row(DB_PREFIX."fee_details", $where);				Common_Nijsol_Class::Set_Session('msg','Cancellation fee receipt successfully.');		Common_Nijsol_Class::Set_Session('error_success','success'); 		Common_Nijsol_Class::Redirect_To(MASTER_URL.'fee-receipt-cancellation.php');	}}$fee_receipt_cancellation = new Fee_Receipt_Cancellation();	$fee_receipt_cancellation->All_Fee_Receipt_Cancellation();if(!empty($_GET['id']) && ($_GET['mode'] == 'delete')){	$fee_receipt_cancellation->Delete_Fee_Receipt_Cancellation($_GET['id']);		}?>
