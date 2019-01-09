<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
  //???
  header("Content-Type: text/html; charset=utf-8");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  // header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
  // header("Pragma: no-cache");
//  Page Name ($template)
//  $template = get_html_name();
//  $pagename = $_SESSION['pagename']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page_title; ?></title>

  <!-- webpack css run with use_dev var -->
  <?php if (WCMS_DEV) echo '<link rel="stylesheet" href="' . WCMS_DEV_PORT . '/wcms/wex/assets/css/main.css">';
        else echo '<link rel="stylesheet" href="assets/css/main.css?ver=todofixit13241">';?>
  <!-- black theme -->
  <?php if ($_SESSION['theme'] == 'black') {
          if (WCMS_DEV) echo '<link rel="stylesheet" href="' . WCMS_DEV_PORT . '/wcms/wex/assets/css/black.css">';
          else echo '<link rel="stylesheet" href="assets/css/black.css?ver=todofixit13241">'; }?>

</head>
<body>

  <!-- MAIN WRAPPER -->
  <div class="wrapper">
    <!-- HEADER NAV -->
    <?php require 'nav/header_nav.php'; ?>
  <!-- SIDEBAR -->
  <?php require 'nav/sidebar.php'; ?>
  <!-- CONTENT -->
  <div class="content-wrapper content-wrapper--sidebar content-wrapper--fix-header">
    <div id="app">
