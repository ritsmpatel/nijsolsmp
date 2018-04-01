<?php require_once "../includes/general-includes-db.php";
	$ds= DIRECTORY_SEPARATOR;
	if (!empty($_FILES)) 
	{
		$tempFile = $_FILES['file']['tmp_name'];
		$targetPath ="../time_table/";
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$newfilename=date('YmdHis').".".$extension;
		$targetFile =  $targetPath. $newfilename;
		if(move_uploaded_file($tempFile,$targetFile))
		{
			list($width,$height)=getimagesize($targetFile);
			if($width>1024 || $height>600)
			{
				$tImage = $targetFile;
				$objimage = new SimpleImage();
				$objimage->load($tImage);
				$objimage->resize_pro(1024,600);
				$objimage->save($tImage);
			}
		}
		Common_Nijsol_Class::Set_Session('time-table-photo',$newfilename);
	}
?>