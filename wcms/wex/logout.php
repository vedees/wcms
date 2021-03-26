<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';

$user = new wcms\classes\auth\Login;
$user->require_login(); ?>

<?php $page_title = 'Logout - WEX CMS';
      $page = 'logout';
      $user = new wcms\classes\auth\Logout();
      $user->logout_user(); ?>

<?php include('includes/header.php') ?>

<section>
  <div class="container">
    <h1 class="ui-title-1"> Logout </h1>
    <p>WCMS is an advanced cms that makes it easy to build performant, beautiful sites for the landing-page, portfolio and other websites using open web interface.</p>
  </div>
</section>

<?php include('includes/footer.php') ?>
