<?php
	//ini_set('error_reporting',E_ALL);
	error_reporting(0);
	
	$master_host="162.215.240.160";
	$master_user="nijsolsm_softwar";
	$master_pass="01Software007";
	$master_db="nijsolsm_pgs_software";
	
	$main_link=mysql_connect($master_host,$master_user,$master_pass);
	mysql_select_db($master_db,$main_link) or die(mysql_error());
	
	
	$main_row=mysql_fetch_array(mysql_query("select * from school_master where school_id='".$_REQUEST['schoolid']."'"));
	
	$db_user=$main_row['db_user'];
	$db_pass=$main_row['db_pass'];
	$db_name=$main_row['db_name'];
	$site_name=$main_row['site_name'];
	$short_name=$main_row['shortSchoolName'];
	mysql_close($main_link);
	if(!empty($db_user))
	{
		require_once("../includes/config.php");
		require_once "../includes/database-abstract.php";
		require_once "../includes/common-function.php";
	}
	else
		exit;
	

?>