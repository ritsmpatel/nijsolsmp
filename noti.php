<?php

//require("config.php");

//if (!empty($_POST)) 

{



$response = array("error" => FALSE);



function send_gcm_notify($reg_id,$label, $message) {



define("FIREBASE_API_KEY", "AIzaSyAeV5OJYGbf97X_ykrh6M552vT5hZz-8nw");//pgs

//define("FIREBASE_API_KEY", "AIzaSyBzRJ9-hHNurb726JntRI0A4J3YCOpXduk");//avm

define("FIREBASE_FCM_URL", "https://fcm.googleapis.com/fcm/send");



$fields = array(



'to' => $reg_id ,

'priority' => "high",

'notification' => array( "title"=>$message['notiSubject'], "body" => $message['notiDesc'],"click_action"=> "ACTIVITY_NOTI" ),

'data' => array('FullData' => $message)

);



echo "<br>";

echo json_encode($fields);

echo "<br>";



$headers = array(

'Authorization: key=' . FIREBASE_API_KEY,

'Content-Type: application/json'

);



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, FIREBASE_FCM_URL);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));



$result = curl_exec($ch);

if ($result === FALSE) {

die('Problem occurred: ' . curl_error($ch));

}



curl_close($ch);

echo $result;

}



$reg_id = "DY7u4bLW6xo:APA91bGGKcrtuPQ7Vnj7oErm7Xt-_g7vo1-VTRkz3cQJl7zl_LjDIx_kPjM6eQ-b6ZZgnerkhEievM-ZXQBwX5I8Mj6qRYuxaxqBW_W-xgk4Lto8Ie8qhL3zTEVDGmj6zv-mcmfi4Dg8";

$reg_id = "eQ4XiPaJNEg:APA91bEVleSrxyfZLm3ccSw3YohwX4W07f_HiZ6QjIam-HN1DhlajxjqKqyQAD2ctq2SGvKLwqz6iLgN3sSNA5WPbnRQL9oY_u9RKraj0sjUY9IPoFUYEnqJXdFi-oLJSFI7rK6OJkCT";

$reg_id = "fvxQqHvMa-Y:APA91bH5aQAhVcUCHLvS5xjAhgElRJujaz04DrihBqMGEul14ns_M4DnDJF4G54gQdLhmS2QlryQ3-SnzQO_ckDVVb9W3Kd8dZPfCMi7htdDRxBlEt2sfPR4wA-0qoGNAheZveHooFys";

$reg_id = "efyNU7ZHZb8:APA91bGbUnGtjC94-TIxbMtV_JWCx_9Er83lnJPPLEhVsq0AjVeX6NSLH2eHoFEcNUCGuV3gF0RoMdrMy-pWNWt1-dipRuusRM9x3liFBbBcZno7dKsflOQ7Ff69ghbTjTP9K0sOmiWb";

$reg_id = "eoaXECgCJHo:APA91bEF6Dcz3XXrGnGnyc0XwYbiA3nj4Jv_ktl4JOhg3pqTeis7Fq2Sh58L4l0NLeo8jomNQjar3_YgWHw8527fza_bPMqAcAtGTMbwngjchwqR2_dvUEJjNnCOW3_uVTCZdPrg8YoX";

$label = "test from php";





$dataInner=array();

$dataInner["notiId"]="16";

$dataInner["notiType"]=ucwords("attendance");

$dataInner["notiSubject"]=ucwords("Student attendance");

$dataInner["notiDesc"]="attendance is p 17 ફકરો, પરિચ્છેદ, કંડિકા, પરિચ્છેદનું ચિહ્ન, વર્તમાનપત્રમાં સમાચારનો અલગ ફકરો અથવા એકબીજા સાથે સુસંગત વાક્યોનો સમૂહ, કંડિકાઓ પાડવી, -ના ઉપર નાની કંડિકાઓ લખવી કે પ્રગટ કરવી";

$dataInner["notiDate"]=date("d-m-Y ");

//$dataInner["notiDate"]=date("Y-m-d H:i:s");

print_r($dataInner);

$msg = $dataInner;

send_gcm_notify($reg_id,$label, $msg);



}

?>



<!Doctype html>

<html>

<head>

<meta charset="utf-8">

<!--Import Google Icon Font-->

<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Import materialize.css-->

<link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>



<!--Let browser know website is optimized for mobile-->

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>



<title>Admin | Firebase Console</title>



<style>body, .row{ text-align: center;}</style>



<script>

$(function(){

$("textarea").val("");

});

function checkTextAreaLen(){

var msgLength = $.trim($("textarea").val()).length;

if(msgLength == 0){

alert("Please enter message before hitting submit button");

return false;

}else{

return true;

}

}

</script>



</head>



<body>





</body>

</html>