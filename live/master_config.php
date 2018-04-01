<?php
	$master_host="127.0.0.1";
	$master_user="nijsolad_softwar";
	$master_pass="01Software007";
	$master_db="nijsolad_pgs_software";
	
	$main_link=mysql_connect($master_host,$master_user,$master_pass);
	mysql_select_db($master_db,$main_link);
	
	
	$main_row=mysql_fetch_array(mysql_query("select * from school_master where site_name='".$_SERVER['HTTP_HOST']."'"));
	
	$db_user=$main_row['db_user'];
	$db_pass=$main_row['db_pass'];
	$db_name=$main_row['db_name'];
	$site_name=$main_row['site_name'];
	$short_name=$main_row['shortSchoolName'];
	mysql_close($main_link);
	if(!empty($db_user))
	{
		require_once("config.php");
		//require_once $config_path."common-function.php";
		
	}
	else
		exit;
?>