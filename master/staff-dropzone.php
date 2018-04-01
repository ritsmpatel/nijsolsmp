<?php require_once "../includes/general-includes-db.php";
	$ds= DIRECTORY_SEPARATOR;
	if (!empty($_FILES)) 
	{
		$tempFile = $_FILES['file']['tmp_name'];  
		$targetPath ="../photo/";
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$newfilename=date('YmdHis').".".$extension;
		$targetFile =  $targetPath. $newfilename;
		if(move_uploaded_file($tempFile,$targetFile))
		{
			list($width,$height)=getimagesize($targetFile);
			if($width>210 || $height>168)
			{
				$tImage = $targetFile;
				$objimage = new SimpleImage();
				$objimage->load($tImage);
				$objimage->resize_pro(210,168);
				$objimage->save($tImage);
			}
		} 
		Common_Nijsol_Class::Set_Session('staff-photo',$newfilename);
	}
?>