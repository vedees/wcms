<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'CSS/JS Editing - WEX CMS';
      $page = 'cssjs';?>

<?php include('includes/header.php') ?>
<?php $get_file = new CssJs();
      $css = $get_file->all_css();
      // print_r($css)
?>

<section id="cssjsEdit">
  <div class="container">
    <code-component
      :css='<?php echo json_encode($css) ?>'>
    </code-component>
  </div>
</section>

<?php include('includes/footer.php') ?>
