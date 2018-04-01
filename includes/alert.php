<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.leanModal.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>css/alert.css" />
<script type="text/javascript">
$(function() {
$('a[rel*=leanModal]').leanModal({ top :100, closeButton: ".modal_close" });
});
</script>

<?php if(Common_Nijsol_Class::Get_Session('error_success')=='error'){?>
<script language="javascript">
$( document ).ready(function() {
	$("#aerrormsg1")[0].click();

setTimeout(function(){
  $("#errorOk").trigger("click");
}, 1000);

});
</script>

<a id="aerrormsg1" href="#errormsg1" rel="leanModal"></a>
	<div class="errormsg" id="errormsg1" align="center">
		<div class="errorcol">
			<div class="almsbox">
				<!--<div class="aletit">
					Aleart
				</div>-->
				<div id="reseterr" class="allerror">
					<span id="msgerr"><?php echo Common_Nijsol_Class::Get_Session('msg');?></span>
				</div>
				<div class="aleokbtn modal_close" id="errorOk">
					OK
				</div>
			</div>
		</div>
	</div>
<?php }
if(Common_Nijsol_Class::Get_Session('error_success')=='success'){?> 

<script language="javascript">
$( document ).ready(function() {
$("#asusmsg1")[0].click();

setTimeout(function(){
  $("#successOk").trigger("click");
}, 1000);

});
</script>   
<a id="asusmsg1" href="#susmsg1" rel="leanModal"></a>
	<div class="errormsg" id="susmsg1" align="center">
		<div class="successcol">
			<div class="almsbox">
				<!--<div class="aletit">
					Success
				</div>-->
				<div id="reseterr" class="allsuccess">
					<span id="msgsus"><?php echo Common_Nijsol_Class::Get_Session('msg');?></span>
				</div>
				<div class="aleokbtn modal_close" id="successOk">
					OK
				</div>
			</div>
		</div>
	</div>
 <?php }		
 Common_Nijsol_Class::Remove_Session('msg');
 Common_Nijsol_Class::Remove_Session('error_success');
 ?>