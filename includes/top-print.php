<?php require_once "general-includes-db.php";
include("number2words.php");
class Common_Top_Print extends DataBase
{	/*Top contant*/
	function ALL_Common_Top_Print()
	{?><!DOCTYPE html>
    <html lang="en">
      <head> 
       <title><?php echo SITE_NAME;?></title>
       <link rel="shortcut icon" href="<?php echo OPPS_MANAGEMENT_URL;?>assets/images/favicon.png" type="image/png">        
        <link href="<?php echo OPPS_MANAGEMENT_URL;?>css/common-print.css" rel="stylesheet"><!--Common print-->
     </head>
    <body>
<?php } 
}

 /*Bottom contant*/
class Common_Bottom_Print extends DataBase
{
	function ALL_Common_Bottom_Print()
	{?>
    <script language="javascript">
		window.print();
	</script>
	</body>
    </html>	
<?php } }?>