<?php
class SimpleImage {
   
   var $image;
   var $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }
   function resize_pro($max_width,$max_height) {
		
		if($this->getWidth() > $max_width || $this->getHeight() > $max_height)
		{
			
			$aspect_ratio = $this->getWidth()/$this->getHeight();
			
			if( $aspect_ratio > 1) {
			    $width = $max_width;
			    $height = $max_width/$aspect_ratio;
			}
			else {
			    $width = $max_height*$aspect_ratio;
			    $height = $max_height;
			}
		}else{
			$width = $max_width;
		    $height = $max_height;
		}
		
		$new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
	}
   function crop($width,$height) {
   		/*
   		$source_aspect_ratio = $this->getWidth() / $this->getHeight();
  		$desired_aspect_ratio = $width / $height;
  		if($source_aspect_ratio > $desired_aspect_ratio){
		    $temp_height = $height;
		    $temp_width = (int)($height * $source_aspect_ratio);
		  }else{
		    $temp_width = $width;
		    $temp_height = (int)($width / $source_aspect_ratio);
		  }
		  $temp_gdim = imagecreatetruecolor($temp_width,$temp_height);
  		imagecopyresampled($temp_gdim, $this->image, 0, 0, 0, 0, $temp_width, $temp_height, $this->getWidth(), $this->getHeight());
   		
   		$x0 = ( $temp_width - $width ) / 2;
		  $y0 = ( $temp_height - $height ) / 2;
		
		  $desired_gdim = imagecreatetruecolor($width, $height);
		  imagecopy($desired_gdim, $temp_gdim, 0, 0, $x0, $y0, $width, $height );
   		$this->image = $desired_gdim;   
   		*/
   		
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $width, $height);
      $this->image = $new_image;   
      
   }      
}
?>