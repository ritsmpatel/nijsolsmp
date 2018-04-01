<?php define("menu_main","login");
	  define("menu_sub","select_school");
require_once("../includes/top.php");
class Select_School extends DataBase
{
	function All_Select_School()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();

	if(empty(Common_Nijsol_Class::Get_Session('schCode')))
	{
?>
<!--<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header rte">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Enable Smoking</h2>
            </div>
            <div class="modal-body">
                <p>Maecenas at ante ac purus ultricies porttitor. Nulla egestas, erat ac gravida molestie, nunc diam condimentum lectus, sed ultricies dui elit ut urna. Aenean eu mi turpis. Sed interdum velit vel tortor porta sodales. Proin ut purus risus. Mauris tortor magna, dignissim viverra leo ac, suscipit pretium augue.interdum velit vel tortor porta.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Disagree</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Agree</button>
            </div>
        </div>
    </div>
</div>-->
<input type="hidden" id="select_school" data-toggle="modal" data-target="#myModal">
<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
        	 <div class="modal-header rte">
                <h2 class="modal-title text-center">Principal</h2>
            </div>
            
            <div class="modal-body">
            	 	<div class="tableWrap table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="width:5%">School Code</th>
									<th>School Name</th>
									<th style="width:40%">Division</th>
								</tr>
							</thead>
							<tbody>
						<?php $resut=$this->Get_Rows(DB_PREFIX."schools",'1=1','*','schCode'); 
						foreach($resut as $_resut)
						{ 
						
	$sql="SELECT * FROM ".DB_PREFIX."usr_organisation_permission WHERE schCode='".$_resut['schCode']."' and usrId='".Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID)."' ";
	$resut_per=$this->Direct_Query($sql);
		
		if($resut_per[0]['perView']==1 || Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_TYPE)==1)
		{	?>             	
 <tr class="cursor-pointer" onClick="Redirect_To('<?php echo LOGIN_URL;?>dashboard.php?schNo=<?php echo Common_Nijsol_Class::Get_Value($_resut['schCode']); ?>');">
        <th scope="row"><?php echo Common_Nijsol_Class::Get_Value($_resut['schCode']); ?></th>
        <td><?php echo Common_Nijsol_Class::Get_Value($_resut['schName']); ?></td>
        <td><?php echo Common_Nijsol_Class::Get_Value($_resut['schDivision']); ?></td>
    </tr>
    <?php }?>
                     <?php } ?>          
							</tbody>
						</table>
					</div>
                 
                 
                 
                 
                    <form>
                        <!--<div class="form-group">
                            <label for="classic-select">Select School</label>
                            <select class="js-select">
                                <option disabled selected>Select School</option>
                                <?php /*$select_school = Common_Nijsol_Class::Fill_Select_Box(DB_PREFIX.'schools','schCode','schName','','','schCode');
                                  echo $select_school;	*/
                             	?>
                            </select>
                        </div>-->
                    </form>
                
                
            </div>
        </div>
    </div>
</div>
<?php $common_bottom = new Common_Bottom();
	 $common_bottom->ALL_Common_Bottom();
?>
    <script language="javascript">
		$("#select_school").trigger("click");
	</script>
	<?php }
	else
	{
		Common_Nijsol_Class::Redirect_To(LOGIN_URL.'dashboard.php');
	}
	}
}
$select_school = new Select_School();	
$select_school->All_Select_School();
?>