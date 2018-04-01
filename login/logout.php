<?php require_once "../includes/general-includes.php";
 Common_Nijsol_Class::Logout_User(); 
 Common_Nijsol_Class::Remove_Session('schCode');
 Common_Nijsol_Class::Remove_Session('schName');
 Common_Nijsol_Class::Redirect_To(SITE_URL.'index.php');
?>