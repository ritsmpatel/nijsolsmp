<?php define("menu_main","dashboard");
	  define("menu_sub","dashboard");
require_once("../includes/top.php");
class Admin_Dashboard extends DataBase
{
	function All_Admin_Dashboard()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
		
		if(!empty($_REQUEST['schNo']))
		{	
			$sch=$this->Direct_Query("SELECT * FROM ".DB_PREFIX."schools WHERE schCode='".Common_Nijsol_Class::Set_Value($_REQUEST['schNo'])."'");
			if(empty($sch[0]['schCode']))
			{
				Common_Nijsol_Class::Redirect_To(LOGIN_URL.'select-school.php');
			}
			else
			{
				Common_Nijsol_Class::Set_Session('schCode',$sch[0]['schCode']);
				Common_Nijsol_Class::Set_Session('schName',$sch[0]['schName']);
				Common_Nijsol_Class::Redirect_To(LOGIN_URL.'dashboard.php');
			}
		}		
?> 
    <div class="pageContent extended">
        <div class="container">
            <h1 class="pageTitle">
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo LOGIN_URL;?>dashboard.php">Dashboard</a></li>
                <li class="active">Dashboard</li>
            </ol>
            
            <div class="box rte">
                <h2 class="boxHeadline">Welcome <?php echo Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_PROPER_NAME);?></h2>
                
                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas porta aliquet odio sit amet tincidunt. Curabitur consectetur dolor in nisl dignissim., ac fermentum nibh placerat. Aliquam dolor libero, eleifend a diam eu, sodales finibus velit. Donec convallis leo et tortor commodo, lobortis ornare mauris feugiat.</p>
                <p><a href="#" class="btn btn-primary btn">Add question</a></p>-->
            </div>
        </div>
    </div>
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom();
	 }
}
$admin_dashboard = new Admin_Dashboard();	
$admin_dashboard->All_Admin_Dashboard();
?>