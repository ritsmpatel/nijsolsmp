<?php error_reporting(1);
class dbase extends DataBase
{
    function dbase()
    {
        $dblink = parent::DataBase();
    }
}
$cmn = new Common_Nijsol_Class();
$db = new dbase();
$adminno = "";
function secCheck()
{ /*$appcheck=$_SERVER['HTTP_USER_AGENT'];	if(!strstr($appcheck,"Darwin") && !strstr($appcheck,"java")){	   echo "Unauthorized Call";		$outputjson['error'] = "Unauthorized Call" ;		$valid=false;		exit;	}*/
}
function login($params = array())
{
    global $db, $cmn, $imagePath, $SITEURL, $android;
    secCheck();
    $response = array(
        "act" => "login",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => ""
    );
    if (empty($params['studentid']))
    {
        $response["error"] = 1;
        $response["error_msg"] = "Username is blank."; /*echo "Username or Password is Blank";*/
    }
    else
    {
        $sSQL = "select * from pgs_student where stdUid='" . $cmn->Remove_Special_Char($params['studentid']) . "'";
        if ($params["sync"] == "no")
        {
            $sSQL .= " and stdPass='" . ($cmn->Set_Value($params['studentpass'])) . "'";
        }
        $row = $db->Direct_Query($sSQL);
        $data = array();
        if (count($row) > 0)
        {
            foreach ($row[0] as $k => $v)
            {
                $data[trim($k) ] = ucwords($cmn->Get_Value($v));
            }
            $stdPhoto = $db->Direct_Query("select stdPhoto,stdBirthDate,stdGender from " . DB_PREFIX . "student where stdId='" . $row[0]['stdId'] . "'");
            $data['stdPhoto'] = FILE_UPLOAD_PATH . $stdPhoto[0]['stdPhoto'];
            $data["stdBirthDate"] = $cmn->Convert_Date_To_Ddmmyyyy($stdPhoto[0]['stdBirthDate']);
            if ($stdPhoto[0]['stdGender'] == "M")
            {
                $data["stdGender"] = "Male";
            }
            else
            {
                $data["stdGender"] = "Female";
            }
            $stnName = $db->Direct_Query("select stnName from " . DB_PREFIX . "standard where stnId='" . $row[0]['stdCurrentStandard'] . "'");
            $data['stdCurrentStandard'] = ucwords($cmn->Get_Value($stnName[0]['stnName']));
            $clsName = $db->Direct_Query("select clsName from " . DB_PREFIX . "class where clsId='" . $row[0]['stdCurrentClass'] . "'");
            $data['stdCurrentClass'] = ucwords($cmn->Get_Value($clsName[0]['clsName']));
            $bgrow = $db->Direct_Query("select bgName from " . DB_PREFIX . "blood_group where bgId='" . $row[0]['stdBloodGroup'] . "'");
            if ($bgrow[0]['bgName'] == NULL)
            {
                $data['stdBloodGroup'] = "";
            }
            else
            {
                $data['stdBloodGroup'] = ucwords($cmn->Get_Value($bgrow[0]['bgName']));
            }
            $bgrow = $db->Direct_Query("select schName from " . DB_PREFIX . "schools where schCode='" . $row[0]['schCode'] . "'");
            $data['schCode'] = ucwords($cmn->Get_Value($bgrow[0]['schName']));
            $response["success"] = 1;
            $response["success_msg"] = "Login successfully.";
            $response["data"] = $data;
        }
        else
        {
            $response["error"] = 1;
            $response["error_msg"] = "Please try again. Your username or password was not valid.";
        }
    }
    echo json_encode($response);
}
function resetpassword($params = array())
{
    global $db, $cmn, $imagePath, $SITEURL, $android;
    $response = array(
        "act" => "resetpassword",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $column = array(
        'stdPass' => $cmn->Set_Value($params['newpass'])
    );
    $where = "stdUid='" . $params['studentid'] . "'";
    $result = $db->Update_Row(DB_PREFIX . "student", $column, $where);
    if ($result > 0)
    {
        $response["success"] = 1;
        $response["success_msg"] = "Password reset successfully.";
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Can not update password.";
    }
    echo json_encode($response);
}
function forgotpassword($params = array())
{
    global $db, $cmn, $imagePath, $SITEURL, $android;
    $response = array(
        "act" => "forgotpassword",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $sSQL = "select * from pgs_student where stdUid='" . $cmn->Remove_Special_Char($params['studentid']) . "'";
    $row = $db->Direct_Query($sSQL);
    $data = array();
    if (count($row) > 0)
    {
        $mobnum = $row[0]['stdMobileNo'];
        $data['stdPass'] = $row[0]['stdPass'];
        $response["success"] = 1;
        $response["success_msg"] = "Password sent to your register mobile number.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Student not found.";
    }
    echo json_encode($response);
}
function cmspage($params = array())
{
    global $db, $cmn, $imagePath, $SITEURL, $android;
    $response = array(
        "act" => "cmspage",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $sSQL = "select * from " . DB_PREFIX . "cms where cmsId='" . $cmn->Remove_Special_Char($params['pageid']) . "'";
    $row = $db->Direct_Query($sSQL);
    $data = array();
    if (count($row) > 0)
    {
        $data['pgTitle'] = $row[0]['cmsTitle'];
        $data['pgDesc'] = $row[0]['cmsDescription'];
        $response["success"] = 1;
        $response["success_msg"] = "Page content send.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Page not found.";
    }
    echo json_encode($response);
}
function photogalary($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "photogalary",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $sSQL = "select * from " . DB_PREFIX . "photo_gallery order by pgDate desc";
    $row = $db->Direct_Query($sSQL);
    $data = array();
    $datakey = array();
    if (count($row) > 0)
    {
        $i = 0;
        for ($i = 0;$i < count($row);$i++)
        {
            $newkey = ucwords($row[$i]['pgTitleName']);
            $datakey[] = $newkey;
            $data[$newkey] = array();
            $dsSQL = "select * from " . DB_PREFIX . "photo_gallery_details where pgdPgId='" . $row[$i]['pgId'] . "' order by pgdId desc";
            $drow = $db->Direct_Query($dsSQL);
            for ($j = 0;$j < count($drow);$j++)
            {
                $data[$newkey][] = FILE_UPLOAD_PATH . $drow[$j]['pgdPhotoName'];
            }
        }
        $response["success"] = 1;
        $response["success_msg"] = "Image sent.";
        $response["data"]["datakey"] = $datakey;
        $response["data"]["datavalue"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Image not found.";
    }
    echo json_encode($response);
}
function getTestDetails($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getTestDetails",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select stdCurrentStandard,stdCurrentClass from " . DB_PREFIX . "student where stdId='" . $params['studentid'] . "'";
    $row = $db->Direct_Query($stsql);
    $stsql = "select sm.*,ses.* from " . DB_PREFIX . "special_mark sm, " . DB_PREFIX . "special_exam_structure ses  where sm.smStdId='" . $params['studentid'] . "' and sm.smStandardId='" . $row[0]['stdCurrentStandard'] . "' and ses.sesId=sm.smChapterNameId order by ses.sesExamDate desc";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $i = 0;
        foreach ($row as $_row)
        {
            $data[$i]["subject"] = ucwords(strtolower($cmn->Get_One_Name("subject", "subName", "subId='" . $cmn->Get_Value($_row['sesSubjectId']) . "'")));
            $data[$i]["examDate"] = $cmn->Convert_Date_To_Ddmmyyyy($_row['sesExamDate']);
            $data[$i]["chapterName"] = ucwords(strtolower($cmn->Get_Value($_row['sesChapterName'])));
            $data[$i]["examMark"] = $cmn->Get_Value($_row['sesExamMark']);
            $data[$i]["obtnMark"] = $cmn->Get_Value($_row['smMark']);
            $i++;
        }
        $response["success"] = 1;
        $response["success_msg"] = "Data sent.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
}
function getHomework($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getHomework",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select stdCurrentStandard,stdCurrentClass from " . DB_PREFIX . "student where stdId='" . $params['studentid'] . "'";
    $row = $db->Direct_Query($stsql);
    $stsql = "select * from " . DB_PREFIX . "student_homework where swkStudentStandardId='" . $row[0]['stdCurrentStandard'] . "' and ( swkStudentId like '" . $params['studentid'] . "' or swkStudentId like '" . $params['studentid'] . ",%' or swkStudentId like '%," . $params['studentid'] . ",%' or swkStudentId like '%," . $params['studentid'] . "' ) order by swkDate desc";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $i = 0;
        foreach ($row as $_row)
        {
            if ($_row['swkSubjectId'] == 0)
            {
                $data[$i]["swkSubjectId"] = "";
            }
            else
            {
                $data[$i]["swkSubjectId"] = ucwords(strtolower($cmn->Get_One_Name("subject", "subName", "subId=" . $cmn->Get_Value($_row['swkSubjectId']))));
            }
            $data[$i]["swkHomeworkDetails"] = $cmn->Get_Value($_row['swkHomeworkDetails']);
            $data[$i]["swkDate"] = $cmn->Convert_Date_To_Ddmmyyyy($_row['swkDate']);
            $i++;
        }
        $response["success"] = 1;
        $response["success_msg"] = "Data sent.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
}
function getAttendance($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getAttendance",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select stdCurrentStandard,stdCurrentClass from " . DB_PREFIX . "student where stdId='" . $params['studentid'] . "'";
    $row = $db->Direct_Query($stsql);
    $stsql = "select * from " . DB_PREFIX . "student_attendance sa, " . DB_PREFIX . "student_attendance_details sd where sa.stndStudentStandardId='" . $row[0]['stdCurrentStandard'] . "' and sd.sadStudentId = '" . $params['studentid'] . "' and sa.stndId=sd.sadStndId  order by sa.stndDate desc";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $i = 0;
        foreach ($row as $_row)
        {
            if ($_row['sadPresent'] == 1) $data[$i]["sadPresent"] = 'P';
            else $data[$i]["sadPresent"] = 'A';
            $data[$i]["stndDate"] = $cmn->Convert_Date_To_Ddmmyyyy($_row['stndDate']);
            $i++;
        }
        $response["success"] = 1;
        $response["success_msg"] = "Data sent.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
}
function getLectureAndExamTimeTable($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getLectureAndExamTimeTable",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select stdCurrentStandard,stdCurrentClass from " . DB_PREFIX . "student where stdId='" . $params['studentid'] . "'";
    $row = $db->Direct_Query($stsql);
    $stsql = "select * from " . DB_PREFIX . "time_table where ttClassId='" . $row[0]['stdCurrentClass'] . "' and ttStandardId = '" . $row[0]['stdCurrentStandard'] . "' and ttType = '" . $params['type'] . "'  order by ttId desc";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $i = 0;
        foreach ($row as $_row)
        {
            $response["data"]["ttPhoto"] = FILE_UPLOAD_PATH_TIME_TABLE . $_row['ttPhoto'];
            $i++;
        }
        $response["success"] = 1;
        $response["success_msg"] = "Time table sent.";
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
} /*function getNotificationHomework($params=array()){	global $db,$cmn,$imagePath,$android;	$response = array("act" => "getNotificationHomework", "schoolid" => $_REQUEST['schoolid'], "success" => 0, "success_msg" => "", "error" => 0, "error_msg" => "","data"=>"");		$data=array();		$stsql="select * from ".DB_PREFIX."notification where notiType='".$params['notitype']."' and notiUse='".$params['notiuse']."' and notiSendType='".$params['notisendtype']."' and ( notiStudentId like '".$params['studentid']."' or notiStudentId like '".$params['studentid'].",%' or notiStudentId like '%,".$params['studentid'].",%' or notiStudentId like '%,".$params['studentid']."' ) order by notiDate desc";			$row=$db->Direct_Query($stsql);		if(count($row)>0)	{			$i=0;			foreach($row as $_row)		{			$data[$i]["notiSubject"]=$cmn->Get_Value($_row['notiSubject']);			$data[$i]["notiDesc"]=$cmn->Get_Value($_row['notiDesc']);			$data[$i]["notiDate"]=$cmn->Convert_Date_To_Ddmmyyyy($_row['notiDate']);			$i++;		}				$response["success"] = 1;		$response["success_msg"] = "Data sent.";		$response["data"]=$data;	}	else	{		$response["error"] = 1;		$response["error_msg"] = "Data not found.";	}		echo json_encode($response);}function getNotificationAttendance($params=array()){	global $db,$cmn,$imagePath,$android;	$response = array("act" => "getNotificationAttendance", "schoolid" => $_REQUEST['schoolid'], "success" => 0, "success_msg" => "", "error" => 0, "error_msg" => "","data"=>"");		$data=array();		$stsql="select * from ".DB_PREFIX."notification where notiType='".$params['notitype']."' and notiUse='".$params['notiuse']."' and notiSendType='".$params['notisendtype']."' and ( notiStudentId like '".$params['studentid']."' or notiStudentId like '".$params['studentid'].",%' or notiStudentId like '%,".$params['studentid'].",%' or notiStudentId like '%,".$params['studentid']."' ) order by notiDate desc";		$row=$db->Direct_Query($stsql);		if(count($row)>0)	{			$i=0;			foreach($row as $_row)		{			$data[$i]["notiSubject"]=$cmn->Get_Value($_row['notiSubject']);			$data[$i]["notiDesc"]=$cmn->Get_Value($_row['notiDesc']);			$data[$i]["notiPresentAbsent"]=$cmn->Get_Value($_row['notiPresentAbsent']);			$data[$i]["notiDate"]=$cmn->Convert_Date_To_Ddmmyyyy($_row['notiDate']);			$i++;		}				$response["success"] = 1;		$response["success_msg"] = "Data sent.";		$response["data"]=$data;	}	else	{		$response["error"] = 1;		$response["error_msg"] = "Data not found.";	}		echo json_encode($response);}*/
function getNotificationStudent($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getNotificationStudent",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select notiType from " . DB_PREFIX . "notification where notiUse='student' group by notiType";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $flag = 0;
        foreach ($row as $_row)
        {
            $notisql = "select * from " . DB_PREFIX . "notification where notiUse='student' and notiType='" . $_row['notiType'] . "' and ( notiStudentId like '" . $params['studentid'] . "' or notiStudentId like '" . $params['studentid'] . ",%' or notiStudentId like '%," . $params['studentid'] . ",%' or notiStudentId like '%," . $params['studentid'] . "' ) order by notiDate desc";
            $notirow = $db->Direct_Query($notisql);
            $dataInner = "";
            $dataInner[] = array();
            $i = 0;
            foreach ($notirow as $_notirow)
            {
                $flag = 1;
                $dataInner[$i]["notiId"] = $cmn->Get_Value($_notirow['notiId']);
                $dataInner[$i]["notiType"] = ucwords(strtolower($cmn->Get_Value($_notirow['notiType'])));
                $dataInner[$i]["notiSubject"] = ucwords(strtolower($cmn->Get_Value($_notirow['notiSubject'])));
                if ($_row['notiType'] == "attendance")
                {
                    $stud = $db->Direct_Query("SELECT stdMobileNo,stdSurname,stdStudentName,stdFatherName,stdFcmId FROM " . DB_PREFIX . "student WHERE stdId=" . $params['studentid']);
                    $studentName = $cmn->Get_Value($stud[0]['stdSurname']) . " " . $cmn->Get_Value($stud[0]['stdStudentName']) . " " . $cmn->Get_Value($stud[0]['stdFatherName']);
                    if ($cmn->Get_Value($_notirow['notiPresentAbsent']) == "P") $desc = "present";
                    else $desc = "absent";
                    $dataInner[$i]["notiDesc"] = $studentName . " is " . $desc;
                }
                else
                {
                    $dataInner[$i]["notiDesc"] = $cmn->Get_Value($_notirow['notiDesc']);
                }
                $dataInner[$i]["notiDate"] = $cmn->Convert_Date_To_Ddmmyyyy($_notirow['notiDate']);
                $i++;
            }
            $data[ucwords($_row['notiType']) ] = $dataInner;
        }
        if ($flag == 1)
        {
            $response["success"] = 1;
            $response["success_msg"] = "Data sent.";
            $response["data"] = $data;
        }
        else
        {
            $response["error"] = 1;
            $response["error_msg"] = "Data not found.";
        }
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
}
function getNotificationCommon($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "getNotificationCommon",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $stsql = "select * from " . DB_PREFIX . "notification where notiUse='common' order by notiDate desc";
    $row = $db->Direct_Query($stsql);
    if (count($row) > 0)
    {
        $i = 0;
        foreach ($row as $_row)
        {
            $data[$i]["notiId"] = $cmn->Get_Value($_row['notiId']);
            $data[$i]["notiType"] = ucwords(strtolower($cmn->Get_Value($_row['notiType'])));
            $data[$i]["notiSubject"] = ucwords(strtolower($cmn->Get_Value($_row['notiSubject'])));
            $data[$i]["notiDesc"] = $cmn->Get_Value($_row['notiDesc']);
            $data[$i]["notiDate"] = $cmn->Convert_Date_To_Ddmmyyyy($_row['notiDate']);
            $i++;
        }
        $response["success"] = 1;
        $response["success_msg"] = "Data sent.";
        $response["data"] = $data;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Data not found.";
    }
    echo json_encode($response);
}
function setNotificationToRead($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "setNotificationToRead",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    $notiId = trim($params['notiId'], ",");
    $studentid = $params['studentid'];
    if (!empty($notiId))
    {
        $stsql = "select notiId,notiStudentId from " . DB_PREFIX . "notification where notiId in (" . $notiId . ")";
        $row = $db->Direct_Query($stsql);
        if (count($row) > 0)
        {
            foreach ($row as $_row)
            {
                $studId = explode(",", $_row['notiStudentId']);
                for ($j = 0;$j < count($studId);$j++)
                {
                    if ($studId[$j] == $studentid)
                    {
                        unset($studId[$j]);
                    }
                }
                $pendingStudId = implode(",", $studId);
                $column = array(
                    'notiStudentId' => $cmn->Set_Value($pendingStudId)
                );
                $where = "notiId='" . $_row['notiId'] . "'";
                $result = $db->Update_Row(DB_PREFIX . "notification", $column, $where);
            }
            $response["success"] = 1;
            $response["success_msg"] = "Data read.";
            $response["data"] = $data;
        }
        else
        {
            $response["error"] = 1;
            $response["error_msg"] = "Data not found.";
        }
    }
    echo json_encode($response);
}
function updatefcm($params = array())
{
    global $db, $cmn, $imagePath, $SITEURL, $android;
    $response = array(
        "act" => "updatefcm",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $column = array(
        'stdFcmId' => $cmn->Set_Value($_REQUEST['stdFcmId'])
    );
    $where = "stdId='" . $_REQUEST['studentid'] . "'";
    $result = $db->Update_Row(DB_PREFIX . "student", $column, $where);
    if ($result > 0)
    {
        $response["success"] = 1;
        $response["success_msg"] = "Token update successfully.";
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Can not update token.";
    }
    echo json_encode($response);
}

function insertfeedback($params = array())
{
    global $db, $cmn, $imagePath, $android;
    $response = array(
        "act" => "insertfeedback",
        "schoolid" => $_REQUEST['schoolid'],
        "success" => 0,
        "success_msg" => "",
        "error" => 0,
        "error_msg" => "",
        "data" => ""
    );
    $data = array();
    if (!empty($params['comment']))
    {
        $column = array(
            'fdStudentId' => $cmn->Set_Value($params['studentid']) ,
            'fdComment' => $cmn->Set_Value($params['comment']) ,
            'fdDate' => date("Y-m-d")
        );
        $result = $db->Insert_Row(DB_PREFIX . "feedback", $column);
    }
    if (!empty($result) && !empty($params['comment']))
    {
        $cmn->Send_Email("application", $params['comment'], $params['studentid'], $_REQUEST['schoolid']);
        $response["success"] = 1;
        $response["success_msg"] = "Send feedback successfully.";
        $response["data"] = 1;
    }
    else
    {
        $response["error"] = 1;
        $response["error_msg"] = "Something is wrong please try again later.";
    }
    echo json_encode($response);
}

?>
