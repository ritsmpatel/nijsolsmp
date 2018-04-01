<?php
error_reporting(1);
ini_set("display_errors", 1);
include("master_config.php");
//error_reporting(E_ALL);

$iphone=1;

$appcheck=$_SERVER['HTTP_USER_AGENT'];
/*if(!strstr($appcheck,"Darwin") && !strstr($appcheck,"java")){
   echo "Unauthorized Call";
    $outputjson['error'] = "Unauthorized Call" ;
        $valid=false;
        exit;
}
*/
$android="";
$android="true";
/*foreach (getallheaders() as $key => $value) {
    if($key=="device")
	{
		$android="true";
	}
}*/

include("user.php");
//include('data.php');

global $outputjson , $is_login ; 

$op = '';

//echo '<pre>'; print_r($_REQUEST); exit;

if(!isset($_REQUEST['act'])){
   
    $outputjson['error'] = "Operation missing" ;
   
}
else
{
	$op=$_REQUEST['act'];
}
if(!isset($_REQUEST['params'])){
   
    $_REQUEST['params'] =  array();
   
}
// need to check auth every request ; 

if(!in_array($op,$ops_withoutlogin))
{
	if(!isset($_REQUEST['params']['login_auth']))
	{
		$outputjson['error'] = "Login fail." ;
		$valid =  false ;
	}
	else
	{
		$valid = auth_user($_REQUEST['params']['login_auth']);
	}
}
else
{
    $valid =  true ;	
}

$valid=true;


@$op = $_REQUEST['act'];
$params = $_REQUEST['params'];

if($valid)
{	
	if(is_callable($op) )
	{
		 if(isset($params['login_auth']))		
	 		 unset($params['login_auth']);
		 $op($params);
	}
	else
	{
		$outputjson['error'] = " Operation does not exists" ;
	}
	
}
else
{
	$outputjson['error'] = "Login require" ;
}
/*echo '<pre>';
print_r($outputjson);*/
function removeNULL($input)
{
	$return = array();
	
	foreach ($input as $key => $val)
	{
		if( is_array($val) )
		{
			$return[$key] = removeNULL($val);
		}
		else
		{	
			if($val == NULL)
			{
				$return[$key] = "";
			}
			else
			{
				$return[$key] = $val;
			}
			
		}
	}
	return $return;          
} 

function auth_user($login_auth)
{
	/*$conn = new DBConnection();
	$mysql_s = $conn->connect();
	$sql_s="SELECT userid FROM users WHERE sessionid = '".$login_auth."'";
	$result_s = $mysql_s->query($sql_s);
	$affected_rows_s = $mysql_s->affected_rows;
	
	if($affected_rows_s > 0)
	{
		return true;
	}
	else
	{
		return false;
	}*/
}

//$temp_outputjson = removeNULL($outputjson);

//echo json_encode($temp_outputjson);

?>
