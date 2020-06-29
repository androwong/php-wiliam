<?php
include_once("config.php");
header_remove('X-Powered-By');
date_default_timezone_set('Europe/London');
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
function brand($task, $id, $brand, $tagline, $value, $type, $code, $url, $rating, $description, $terms, $img) {
   global $mysqli;
   $brand = mysqli_real_escape_string($mysqli,$brand);
   $tagline = mysqli_real_escape_string($mysqli,$tagline);
   $description = mysqli_real_escape_string($mysqli,$description);
   $terms = mysqli_real_escape_string($mysqli,$terms);
   if($img <> "") {
		$check = getimagesize($img);
      $imageFileType = ".jpg";
    	if($check !== false) {
         switch ($check[2]) {
				case IMAGETYPE_JPEG:
					$imageFileType = ".jpg";
					break;
				case IMAGETYPE_GIF:
					$imageFileType = ".gif";
					break;
				case IMAGETYPE_PNG:
					$imageFileType = ".png";
					break;
				default:
					$imageFileType = ".jpg";
					break;
			}
         $file_path = trim(preg_replace('/-+/', '-', preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($brand))),'-').$imageFileType;
			create_cropped_thumbnail($img, $check[2], 200, 200, "../../img/logos/200/" . $file_path);
			create_cropped_thumbnail($img, $check[2], 100, 100, "../../img/logos/100/" . $file_path);
			create_cropped_thumbnail($img, $check[2], 50, 50, "../../img/logos/50/" . $file_path);
		}
	}
   if ($task == "insert") {
      $sql = "INSERT INTO brands SET title='$brand',tagline='$tagline',value='$value',type='$type',code='$code',url='$url',rating='$rating',description='$description',terms='$terms',img='$file_path'";
      $msg = "inserted";
   }
   if ($task == "update") {
      if ($img == "") {
         $sql = "UPDATE brands SET title='$brand',tagline='$tagline',value='$value',type='$type',code='$code',url='$url',rating='$rating',description='$description',terms='$terms' WHERE brand_id = '$id'";
      }
      else {
         $sql = "UPDATE brands SET title='$brand',tagline='$tagline',value='$value',type='$type',code='$code',url='$url',rating='$rating',description='$description',terms='$terms',img='$file_path' WHERE brand_id = '$id'";
      }
      $msg = "updated";
   }
   if (mysqli_query($mysqli,$sql)) {
		$status = "has been";
      $bg = "success";
	}
	else {
		$status = "could not be";
      $bg = "danger";
	}
   echo json_encode(array("msg"=>'<div class="alert alert-'.$bg.' mt-3 mb-0">Brand '.$status.' '.$msg.'.</div><script>setTimeout(function(){window.location.reload(1);},1000);</script>'));
}
function delete($table, $id)
{
	global $mysqli;
	if ($table == "brands") {
		$sql = "Delete from brands WHERE brand_id='$id'";
      $mysqli->query($sql);
	}
	if ($table == "admins") {
		$sql = "Delete from admins WHERE admin_id='$id'";
      $mysqli->query($sql);
	}
   echo "<script>location.href='/admin/db?function=all&table=".$table."';</script>";
}
function create_cropped_thumbnail($image_path, $extension, $thumb_width, $thumb_height, $new_filepath) {
	global $mysqli;
    if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
        echo "The width is invalid";
        exit(1);
    }
    if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
        echo "The height is invalid";
        exit(1);
    }
    switch ($extension) {
        case IMAGETYPE_JPEG:
            $source_image = imagecreatefromjpeg($image_path);
            break;
        case IMAGETYPE_GIF:
            $source_image = imagecreatefromgif($image_path);
            break;
        case IMAGETYPE_PNG:
            $source_image = imagecreatefrompng($image_path);
            break;
        default:
            exit(1);
            break;
    }
    $source_width = imageSX($source_image);
    $source_height = imageSY($source_image);
    if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $source_y = 0;
    }
    if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
        $source_y = 0;
        $temp_width = $source_height * $thumb_width / $thumb_height;
        $source_x = ($source_width - $temp_width) / 2;
        $source_width = $temp_width;
    }
    if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $temp_height = $source_width * $thumb_height / $thumb_width;
        $source_y = ($source_height - $temp_height) / 2;
        $source_height = $temp_height;
    }
    $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);
    imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);
    switch ($extension) {
        case IMAGETYPE_JPEG:
            imagejpeg($target_image, $new_filepath);
            break;
        case IMAGETYPE_GIF:
            imagegif($target_image, $new_filepath);
            break;
        case IMAGETYPE_PNG:
            imagepng($target_image, $new_filepath);
            break;
        default:
            exit(1);
            break;
    }
    imagedestroy($target_image);
    imagedestroy($source_image);
}
function sign_in($user, $pass) {
   global $mysqli;
   $sql = "select * from admins where username = '".$user."' and password='".$pass."'";
   $result = $mysqli->query($sql);
   if ($result->num_rows<1) {
      echo json_encode(array("msg"=>'<div class="alert alert-danger mt-3 mb-0">Username or password is incorrect. Please try again.</div>'));
   }
   else {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      foreach ($row as $k=>$v){
         $_SESSION[$k] = $v;
      }
      echo json_encode(array("msg"=>'<div class="alert alert-success mt-3 mb-0">Logging in...</div><script>setTimeout(function(){window.location = "/admin/dashboard";(1);},1000);</script>'));
   }
}
function user($task, $id, $fname, $lname, $user, $pass) {
   global $mysqli;
   $fname = mysqli_real_escape_string($mysqli,$fname);
   $lname = mysqli_real_escape_string($mysqli,$lname);
   $pass = mysqli_real_escape_string($mysqli,$pass);
   if ($task == "insert") {
      $sql = "INSERT INTO admins SET first_name='$fname',last_name='$lname',username='$user',password='$pass'";
      $msg = "inserted";
   }
   if ($task == "update") {
      $sql = "UPDATE admins SET first_name='$fname',last_name='$lname',username='$user',password='$pass' WHERE admin_id = '$id'";
      $msg = "updated";
   }
   if (mysqli_query($mysqli,$sql)) {
		$status = "has been";
      $bg = "success";
	}
	else {
		$status = "could not be";
      $bg = "danger";
	}
   echo json_encode(array("msg"=>'<div class="alert alert-'.$bg.' mt-3 mb-0">Admin '.$status.' '.$msg.'.</div><script>setTimeout(function(){window.location.reload(1);},1000);</script>'));
}
?>
