<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'WEX CMS - Dashboard';
      $page = 'settings';?>

<?php include('includes/header.php') ?>

<section>
  <div class="container">
    <h1 class="ui-title-1">Settings</h1>
    <?php echo 'lang ' . $_SESSION['lang']; ?>
  </div>
</section>

<example-component></example-component>

<?php include('includes/footer.php') ?>
