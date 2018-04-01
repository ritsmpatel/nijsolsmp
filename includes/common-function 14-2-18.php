<?php class Common_Nijsol_Class extends DataBase{		/*remove addslashes in string*/		public static function Set_Value ( $strvalue="" ) {		$strreturn = "";		$strreturn = strip_tags ( trim( $strvalue ) );		$strreturn = addslashes ( trim( $strreturn ) );		return $strreturn;	}	/*remove stripcslashes in string*/	

public static function Get_Value ( $strvalue = "" ) {		
$strreturn = "";		
if ( ! ( is_array($strvalue) && count($strvalue) ) ) {			$strreturn = stripcslashes( trim ( $strvalue ) ); 		}		else {			$strreturn = $strvalue;			}		return $strreturn;	}		/*Convert data in Encrypt formet*/		public static function Encrypt_Data ( $value ) {		$return = $value;		$return = strtr(base64_encode(addslashes(gzcompress(serialize($value),9))), '+/=', '-_,');		return $return;	}		/*Convert data in Decrypt formet*/	public static function Decrypt_Data ( $value ) {		$return = $value;		$return = unserialize(gzuncompress(stripslashes(base64_decode(strtr($value, '-_,', '+/=')))));			return $return;	}		/*Get session key*/		public static function Get_Session_Key ( $key ) 	{		return SESSION_PREFIX . $key;	}	/*Set session*/	public static function Set_Session ( $key, $value ) 	{		$key = self::Get_Session_Key($key);		$_SESSION[$key] = self::Encrypt_Data($value);	}	/*Remove session*/	public static function Remove_Session ( $key ) 	{		$key = self::Get_Session_Key($key);		if ( isset($_SESSION[$key]) ) 		{			unset($_SESSION[$key]);		}	}		/*check session*/		public static function Check_Session ( $key ) 	{		$key = self::Get_Session_Key($key);		if ( isset($_SESSION[$key]) ) 		{			return true;		}		return false;	}	/*get sessiion*/		public static function Get_Session ( $key ) 	{		$key = self::Get_Session_Key($key);		if ( isset($_SESSION[$key]) ) 		{			return self::Decrypt_Data($_SESSION[$key]);		}	}	/*read text file*/	public static function Read_File ( $file, $array_form = false ) 	{				if ( file_exists($file) && is_file($file) && is_readable($file) ) 		{			$strreturn = '';			$arreturn = array();			$file_handle = @fopen($file, 'r');				if ($file_handle) 			{				while (!feof($file_handle)) 				{					if ( $array_form == false ) 					{						$strreturn  .= fgets($file_handle, 4096);					}					else 					{						$arreturn[] = fgets($file_handle, 4096);					}				}				fclose($file_handle);			}				if ( $array_form == false ) 			{				return $strreturn;			}			else 			{				return $arreturn;			}					}		return false;	}		/*redirect to page*/		public static function Redirect_To ( $page ) 	{	if ( ! headers_sent() ) 	{		header('Location: ' . $page);		exit();	}	else 	{		echo '<script type="text/javascript" language="javascript">window.location.href=\'' . $page . '\'</script>';		}	}		/*check user login or not*/		public static function Is_User_Loggedin () 	{		$check_session_admin = self::Check_Session(ADMIN_LOGIN_USER_ID);		$get_session_admin =  self::Get_Session(ADMIN_LOGIN_USER_ID);		$check_session_front = self::Check_Session(FRONT_LOGIN_USER_ID);		$get_session_front =  self::Get_Session(FRONT_LOGIN_USER_ID);		if(isset($check_session_admin) == true && (!empty($get_session_admin)))		{			return self::$get_session;		}		else if(isset($check_session_front) == true && (!empty($get_session_front)))		{			return $get_session_front;		}		return false;	}		/*check in admin panel*/		public static function Is_Admin()	{				$check_session_admin = self::Check_Session(ADMIN_LOGIN_USER_ID);		$get_session_admin =  self::Get_Session(ADMIN_LOGIN_USER_ID);				if(isset($check_session_admin) == true && (!empty($get_session_admin)))		{			return true;		}		else		{			return false;		}		return false;	}		/*Convert date to mysql formet*/		public static function Convert_Date_To_Mysql_Format ( $date ) 	{		$strreturn = '';		if ( $date != '' ) 		{			$ardate = explode(DATE_SEPARATOR, $date);				if ( is_array($ardate) && count($ardate) ) 			{				$intyear = $ardate[2];				$intmonth = $ardate[1];				$intday = $ardate[0];					$strreturn = $intyear . '-' . $intmonth . '-' . $intday;			}		}		return $strreturn;	}	/*Convert date to dd-mm-yy*/	public static function Convert_Date_To_Ddmmyyyy ( $date ) 	{		$strreturn = '';				if ( $date != '' ) 		{			$ardate = explode('-', $date);				if ( is_array($ardate) && count($ardate) ) 			{				$strreturn = str_pad((int) $ardate[2], 2, '0', STR_PAD_LEFT) . '-' . str_pad((int) $ardate[1], 2, '0', STR_PAD_LEFT) . '-' . (int) $ardate[0];			}		}		return $strreturn;	}	/*file select box value*/	public function Fill_Select_Box ( $table, $value_field, $display_field, $selected_value = '', $condition="", $orderby="" ) 	{		$data = "";		if(!empty($orderby))		{			$orderby = " order by ".$orderby;			}		$strquery = ('SELECT ' . $value_field . ', ' . $display_field . ' FROM ' . $table . ' WHERE 1=1 '.$condition.$orderby);			$getdata=parent::Direct_Query($strquery);			          		 foreach($getdata as $_getdata)		 {			 			 $strselected = '';								if ( self::get_value($_getdata[$value_field]) == $selected_value ) 				{					$strselected = 'selected="selected"';				}				$data.=  '<option value="'.self::get_value($_getdata[$value_field]).'"  '.$strselected.'>'.htmlspecialchars(self::get_value($_getdata[$display_field])).'</option>';                       		 }         return $data;	}		/*set cookie*/	public static function Set_Cookie ( $key, $value, $expiry_time ) 	{		setcookie($key, $value, $expiry_time);	}		/*logout user */		public static function Logout_User ( ) 	{		self::Remove_Session(ADMIN_LOGIN_USER_ID);			self::Remove_Session(ADMIN_LOGIN_USER_NAME);			self::Remove_Session(ADMIN_LOGIN_USER_TYPE);				self::Remove_Session(FRONT_LOGIN_USER_ID);			self::Remove_Session(FRONT_LOGIN_USER_NAME);			self::Remove_Session(FRONT_LOGIN_USER_TYPE);				}						/* Login Checking	 $url parameter for redirect path*/	public function Admin_Login_Exist($url) 	{		$get_user_id = Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_ID);		$get_user_name = Common_Nijsol_Class::Get_Session(ADMIN_LOGIN_USER_NAME);		$check_user = $this->Check_User_Exitsindb(DB_PREFIX."usr",'usrId',$get_user_id);		if(empty($get_user_id) or (empty($get_user_name)) && ($check_user == 0))		{			Common_Nijsol_Class::Redirect_To($url);		}				}		/*$field_val parameter for check empty or not	Return 0 or 1*/	public static function Set_One_Zeero ( $field_val ) 	{		if(!empty($field_val) && ($field_val==1))		{			return 1;		}		else		{			return 0;		}	}		 /*$mobile_num parameter for mobile number	 Return ture or false*/	public static function Validate_Mobile_Number($mobile_num)	{		$len=strlen($mobile_num);		if(!is_numeric($mobile_num))		{			return false;		}		if($len!=10)		{			return false;		}				$first_digit=substr($mobile_num,0,1);				if(substr_count($mobile_num, $first_digit)==10)		{				return false;		}				return true;	}		 /*Only display 2 decimal places	 $remove=0 for without .00 value and $remove=1 for with .00 value 	 $number parameter for number	 Return number*/	public static function Two_Decimal_Places($number,$remove=0)	{		$two_decimal=sprintf('%0.2f', Common_Nijsol_Class::Get_Value($number));		if($remove==0)		{			$remove_zero=str_replace(".00","",$two_decimal);			return $remove_zero;		}		else		{			return $two_decimal;		}	}		/* $str_val for string value	removes special characters and allows only - and . and _ signs in string*/	public static function Remove_Special_Char($str_val)	{		/*$str_val = preg_replace('/[^A-Za-z0-9@=.,_!:;\^\/\?#\%\&\$\'\"\(\)-\*<>\{\}\[\]\|~`]/', ' ', $str_val);		$str_val = preg_replace('/[^A-Za-z0-9@.%\-,_\/\']/', '', $str_val);*/		$str_val = preg_replace('/[^A-Za-z0-9.\-_ ]/', '', $str_val);  		return Common_Nijsol_Class::Set_Value(trim($str_val));		}		/* $str_val for email 	removes special characters and allows only @ and . and _ signs in string*/	public static function Email_Checking($str_val)	{		$str_val = preg_replace('/[^A-Za-z0-9@._]/', '', $str_val);		return Common_Nijsol_Class::Set_Value(trim($str_val));		}									public static function Zero_Absent_Copy_Print($mark)	{			if($mark==111)			{return "ZOO";}			elseif($mark==112)			{return "AOO";}			elseif($mark==113)			{return "COO";}			else{return $mark;}	}		public static function Zero_Absent_Copy_Sum($mark)	{			if($mark==111 || $mark==112 || $mark==113)			{return 0;}			else{return $mark;}	}		public static function send_gcm_notify($reg_id, $message) 	{			/*define("FIREBASE_API_KEY", "AIzaSyAeV5OJYGbf97X_ykrh6M552vT5hZz-8nw");define("FIREBASE_API_KEY", $firebase_api_key);*/			define("FIREBASE_FCM_URL", "https://fcm.googleapis.com/fcm/send");						$fields = array(						'to' => $reg_id ,			'priority' => "high",			'notification' => array( "title"=>$message['notiSubject'], "body" => $message['notiDesc'],"click_action"=> "ACTIVITY_NOTI" ),'data' => array('FullData' => $message)			);			/*echo $output = "<script>console.log( 'FIREBASE Objects: " . json_encode($fields) . "' );</script>";			echo "<br>";			echo json_encode($fields);			echo "<br>";*/						$headers = array(			'Authorization: key=' . FIREBASE_API_KEY,			'Content-Type: application/json'			);						$ch = curl_init();			curl_setopt($ch, CURLOPT_URL, FIREBASE_FCM_URL);			curl_setopt($ch, CURLOPT_POST, true);			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));						$result = curl_exec($ch);			if ($result === FALSE) {			die('Problem occurred: ' . curl_error($ch));			}						curl_close($ch);			/*echo $result;*/	}


/* Send SMS*/	
public static function Send_SMS($studentName,$mobileNo,$userName="",$userPassword="",$page="",$attendance="")	{				
	/*if(SITE_NAME=="PGS")		{*/				
	$common_nijsol_class= new Common_Nijsol_Class();			
	$result_settings=$common_nijsol_class->Direct_Query("SELECT * FROM ".DB_PREFIX."settings WHERE stgId=1"); 						
	/*Your authentication key$authKey = "81079ALWkGNDKI255139312";*/			
	$authKey=Common_Nijsol_Class::Get_Value($result_settings[0]['stgSMSAuthKey']);			/*Sender ID,While using route4 sender id should be 6 characters long.			$senderId = "PRANAM";*/			
	$senderId=Common_Nijsol_Class::Get_Value($result_settings[0]['stgSMSSenderId']);							
	if(!empty($userName) && !empty($userPassword))	
	{				
		$message=$studentName." User Name : ".$userName." And Password : ".$userPassword;
		
		/*$message="Pranam\nPGS School App login info for ".$studentName."\nUser Name : ".$userName."\nPassword : ".$userPassword."\nDownload PGS app from Play Store https://play.google.com/store/apps/details?id=com.nijsol.nijsolsmp.pgs&hl=en";	*/					
	}						
		if($page=="attendance")			
		{				
			$message=" ".$attendance;			
		}						
		/*Define route */			
		$route = "4";			
		/*Prepare you post parameters*/			
		$postData = array('authkey' => $authKey,'mobiles' => $mobileNo,'message' => $message,				'sender' => $senderId,'route' => $route);						
		/*API URL $url="https://control.msg91.com/sendhttp.php";*/			
		$url=Common_Nijsol_Class::Get_Value($result_settings[0]['stgSMSUrl']);			
		/*init the resource*/			
		$ch = curl_init();			
		curl_setopt_array($ch, array(CURLOPT_URL => $url,CURLOPT_RETURNTRANSFER => true,				CURLOPT_POST => true,CURLOPT_POSTFIELDS => $postData	/*,CURLOPT_FOLLOWLOCATION => true*/			));									
		/*Ignore SSL certificate verification*/			
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);			
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);									
		/*get response*/			
		$output = curl_exec($ch);						
		/*Print error if any*/			
		if(curl_errno($ch))			
		{				
			echo 'error:' . curl_error($ch);			
		}						
		curl_close($ch);		
		/*}*/	
		}
		
		
		
		/* Send Email */	
		public static function Send_Email($page,$message,$studentid,$schoolid="")	
		{		
			include("mailer/class.phpmailer.php");		
			$common_nijsol_class= new Common_Nijsol_Class();		
			$result_settings=$common_nijsol_class->Direct_Query("SELECT * FROM ".DB_PREFIX."settings WHERE stgId=1"); 				
			if(!empty(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId'])))		
			{				
			$semail = new PHPMailer();			
			$semail->SetLanguage("en", 'mailer/language/');			
			$semail->IsSMTP(); /* telling the class to use SMTP						$semail->Host = "smtpout.asia.secureserver.net"; SMTP server						$semail->Host = "localhost";				$semail->SMTPAuth=true;			$semail->Username="navtanpuri@krishnapranami.org";			$semail->Password="krishna108";*/			
			$semail->Host = Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailHost']);		$semail->SMTPAuth=true;	
			$semail->Username=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);	
			$semail->Password=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailPassword']);						
			$result=$common_nijsol_class->Direct_Query("SELECT stdSurname, stdStudentName, stdFatherName FROM ".DB_PREFIX."student WHERE stdId='".$studentid."'");									
			$std=Common_Nijsol_Class::Get_Value($result[0]['stdSurname'])." ";			
			$std.=Common_Nijsol_Class::Get_Value($result[0]['stdStudentName'])." ";			
			$std.=Common_Nijsol_Class::Get_Value($result[0]['stdFatherName']);													
			$semail->IsHTML(true);			
			$from=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);			/*$from="navtanpuri@krishnapranami.org";*/			
			$semail->From =$from;			
			$semail->FromName = SITE_NAME;			/*$semail->AddAttachment($newpath);*/				
			if($schoolid==1)
			{
				$semail->AddAddress("admin_pgs@pranamischool.net");
				$semail->AddAddress("allemailbackup@krishnapranami.org");
				$semail->AddAddress("guruji@krishnapranami.org");
			}
			$semail->AddAddress(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId']));			
			$semail->AddReplyTo($from);			
			$semail->Subject ="Feedback Message For School";			
			$semail->Body=stripslashes($std."<br><br>".$message);						
			if(!$semail->Send())			
			{				
				echo $semail->ErrorInfo;				
				die("Not send to ");			
			}						
			$semail=NULL;		
			}	
		}				
		
		
		
		/* Send report admin */	
		public static function Send_Email_Report($page,$message,$schoolid="")	
		{	
			
			include("mailer/class.phpmailer.php");		
			$common_nijsol_class= new Common_Nijsol_Class();		
			$result_settings=$common_nijsol_class->Direct_Query("SELECT * FROM ".DB_PREFIX."settings WHERE stgId=1"); 				
			if(!empty(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId'])))		
			{				
			$semail = new PHPMailer();			
			$semail->SetLanguage("en", 'mailer/language/');			
			$semail->IsSMTP(); 		
			$semail->Host = Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailHost']);		$semail->SMTPAuth=true;	
			$semail->Username=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);	
			$semail->Password=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailPassword']);						
			
			$semail->IsHTML(true);			
			$from=Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailUsername']);							 			$semail->From =$from;			
			$semail->FromName = SITE_NAME;					
			if($schoolid==1)
			{
				 $semail->AddAddress("admin_pgs@pranamischool.net"); 
				 $semail->AddAddress("allemailbackup@krishnapranami.org");
				 $semail->AddAddress("guruji@krishnapranami.org");
			}
			$semail->AddAddress(Common_Nijsol_Class::Get_Value($result_settings[0]['stgEmailReveiceEmailId']));			
			$semail->AddReplyTo($from);			
			$semail->Subject =$page;			
			$semail->Body=$message;						
			if(!$semail->Send())			
			{				
				echo $semail->ErrorInfo;				
				die("Not send to ");			
			}						
			$semail=NULL;		
			}	
		}		
		
		
		
		
		
		public static function Get_One_Name($table_name,$get_field_name,$condition)	{			$common_nijsol_class= new Common_Nijsol_Class();			$name=$common_nijsol_class->Direct_Query("SELECT ".$get_field_name." FROM ".DB_PREFIX.$table_name." WHERE ".$condition."");			return Common_Nijsol_Class::Get_Value($name[0][$get_field_name]);	}
		
		
		
		
}
?>