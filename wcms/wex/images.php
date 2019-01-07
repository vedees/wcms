<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
$user = new wcms\classes\auth\Login;
$user->require_login();?>

<?php $page_title = $lang['imagesTitle'];
      $page = 'images';?>

<?php include('includes/header.php') ?>

<?php //! TODO ADD CSS IMAGES (css)
      $get_image = new wcms\classes\images\Images();
      $images = $get_image->image_filter();
      $img_main = $get_image->get_img_main();
      $img_content = $get_image->get_img_content();
      $img_icon = $get_image->get_img_icon();

  // Check get request
  if (isset($_GET['img'])) {
    $imgname=$_GET['img'];
    // Change image
    move_uploaded_file($_FILES['inputForImages']['tmp_name'], $imgname);
    redirect_to('images.php');
  }
?>


<images-component
  :images='<?php echo json_encode($images) ?>'
  :imgmain='<?php echo json_encode($img_main) ?>'
  :imgcontent='<?php echo json_encode($img_content) ?>'
  :imgicon='<?php echo json_encode($img_icon) ?>'>
</images-component>

<?php include('includes/footer.php') ?>
