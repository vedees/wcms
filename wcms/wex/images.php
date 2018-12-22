<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
$user = new Login;
$user->require_login();?>

<?php $page_title = 'Image editing - WEX CMS';
      $page = 'images';?>

<?php include('includes/header.php') ?>

<?php //! TODO ADD CSS IMAGES (css)
      $get_image = new Image();
      $images = $get_image->image_filter();

// Check get request
if (isset($_GET['img'])) {
  $imgname=$_GET['img'];
  // Change image
  move_uploaded_file($_FILES['inputForImages']['tmp_name'], $imgname);
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=images.php\">";
}
?>


<images-component
  :images='<?php echo json_encode($images) ?>'>
</images-component>

<?php include('includes/footer.php') ?>
