<?php require_once "../includes/general-includes.php";
 require_once "login-class.php";
class Bill extends DataBase
{
	function All_Bill()
	{
?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:5%">School Code</th>
                    <th>School Name</th>
                    <th style="width:40%">Division</th>
                    <th style="width:15%">Students</th>
                </tr>
            </thead>
            <tbody>
        <?php 
		$totStudent=0;
		$resut=$this->Get_Rows(DB_PREFIX."schools",'1=1','*','schCode'); 
        foreach($resut as $_resut)
        { ?>	
<tr class="cursor-pointer" onClick="Redirect_To('<?php echo LOGIN_URL;?>dashboard.php?schNo=<?php echo Common_Nijsol_Class::Get_Value($_resut['schCode']); ?>');">
<th scope="row"><?php echo Common_Nijsol_Class::Get_Value($_resut['schCode']); ?></th>
<td><?php echo Common_Nijsol_Class::Get_Value($_resut['schName']); ?></td>
<td><?php echo Common_Nijsol_Class::Get_Value($_resut['schDivision']); ?></td>
<td align="center">
<?php
	$rs=$this->Direct_Query("SELECT count(stdId) as studentTotal FROM ".DB_PREFIX."student WHERE schCode='".Common_Nijsol_Class::Get_Value($_resut['schCode'])."' and stdActive='1' and isActive='Y'"); 
	echo $rs[0]['studentTotal'];
	$totStudent+=$rs[0]['studentTotal'];
?>
</td>
</tr>
     <?php } ?>  
     <tr>
     	<td colspan="3" align="right"><strong>Total Student :</strong></td>
        <td align="center"><strong><?php echo $totStudent;?></strong></td>
     </tr>
             
            </tbody>
        </table>
					
  
	<?php 
	}
}
$Bill = new Bill();	
$Bill->All_Bill();
?>