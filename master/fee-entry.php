<?php define("menu_main","master");	  define("menu_sub","fee_entry");require_once("../includes/top.php");class Fee_Entry_Add_Edit extends DataBase{	function All_Fee_Entry_Add_Edit()	{		$common_top = new Common_Top();		$common_top->ALL_Common_Top();	?>
<div class="pageContent extended">
  <div class="container">
    <div class="clearfix">
      <div class="pull-left">
        <h1 class="pageTitle"> Manage Fee Receipt Entry </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
          <li class="active"><?php echo ucwords($_GET['mode']);?> Fee Receipt Entry</li>
        </ol>
      </div>
      <div class="pull-right margin-top-btn"></div>
    </div>
    <form class="form-fee-entry" method="post" action="fee-entry-db.php">
      <div class="box rte">
        <div class="row">
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="feeReceiptNo">Receipt No</label>
              <input type="text" class="form-control" id="feeReceiptNo" name="feeReceiptNo" placeholder="Receipt No" onkeypress="return Is_Number(event);">
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="feeStandardId">Standard</label>
              <select class="select2 js-select2 form-control" id="feeStandardId" name="feeStandardId" required onChange="OnChanges_Standard_Manage('<?php echo MASTER_URL;?>',this.value);">
                <option value="">- Select Standard -</option>
                <?php echo Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX."standard", "stnId", "stnName",'', " and schCode='".Common_Nijsol_Class::Get_Session('schCode')."' ", "stnId"); ?>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="feeClassId">Class</label>
              <select class="select2 js-select2 form-control" id="feeClassId" name="feeClassId" onChange="OnChanges_Class('<?php echo MASTER_URL;?>','',this.value);"  required>
                <option value="">- Select Class -</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <label for="feeDate">Date</label>
              <div id="feeDate" class="input-group date">
                <input type="text" class="form-control" id="feeDate" name="feeDate" placeholder="Fee Date" value="<?php echo date('d-m-Y');?>" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="feeStudentName">Student Name</label>
              <select class="select2 js-select2 form-control" id="feeStudentId" name="feeStudentId" required onChange="Blank_Fee_Term();">
                <option value="">- Select Student Name -</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="feeTypeTermId">Fee Term</label>
              <select class="select2 js-select2 form-control" id="feeTypeTermId" name="feeTypeTermId" onChange="OnChanges_Term('<?php echo MASTER_URL;?>',this.value);"  required>
                <option value="">- Select Term -</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="feeTypeHeadId">Fee Head</label>
              <select class="select2 js-select2 form-control" id="feeTypeHeadId" name="feeTypeHeadId" required>
                <option value="">- Select Head -</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row" style="margin-left:-20px;margin-right:-20px">
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading"> Remaining Fees </div>
                  <div class="panel-body">
                    <div class="box rte margin-padding-0" id="div_fees"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-2">
            <label>&nbsp;</label>
            <div class="form-group checkboxes">
              <label for="feeByCheque">
                <input type="checkbox" id="feeByCheque" name="feeByCheque" data-checkbox="icheckbox_square-blue">
                <span><strong>By Cheque</strong></span> </label>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <label for="feeChequeNo">Cheque No</label>
              <input type="text" class="form-control" id="feeChequeNo" name="feeChequeNo" placeholder="Cheque No">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="feeRemarks">Remarks</label>
              <input type="text" class="form-control" id="feeRemarks" name="feeRemarks" placeholder="Remarks">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <input type="hidden" name="type" id="type" value="<?php echo $_GET['mode'];?>">
              <?php if((Common_Nijsol_Class::Get_Session('perView')==1 && Common_Nijsol_Class::Get_Session('perAdd')==1) || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)==1){?><button type="submit" class="<?php echo BTN_ADD;?>">Save</button><?php }?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3">
            <div class="form-group">
              <button type="reset" class="<?php echo BTN_ADD;?>" onClick="Redirect_To('<?php echo MASTER_URL;?>fee-entry.php');">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $common_bottom = new Common_Bottom();$common_bottom->ALL_Common_Bottom();?>
<script src="<?php echo SITE_URL;?>js/fee-entry.js"></script>
<?php }}$fee_entry_add_edit = new Fee_Entry_Add_Edit();$fee_entry_add_edit->All_Fee_Entry_Add_Edit();	?>
