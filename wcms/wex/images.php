<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'Image editing - WEX CMS';
      $page = 'image';?>

<?php include('includes/header.php') ?>
<?php $get_image = new Image();
      $images = $get_image->image_filter();

      print_r(json_encode($images));

?>

<section>
  <div class="container">
    <h1 class="ui-title-1">Image</h1>
    <images-component
      :images='<?php echo json_encode($images) ?>'>
    </images-component>
  </div>
</section>



<?php include('includes/footer.php') ?>
