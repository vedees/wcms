<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

//  //! Page Name ($template)
//  $template = get_html_name();
//  $pagename = $_SESSION['pagename']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page_title; ?></title>

  <!-- webpack css run with ?dev prefix ( http://localhost:8888/index.php?dev ) -->
  <?php if (isset($_GET['dev'])) echo '<link rel="stylesheet" href="http://localhost:8080/wcms/wex/assets/css/main.css">';
        else echo '<link rel="stylesheet" href="assets/css/main.css">';?>
  <!-- black theme -->
  <?php if ($_SESSION['theme'] == 'black') {
          if (isset($_GET['dev'])) echo '<link rel="stylesheet" href="http://localhost:8080/wcms/wex/assets/css/black.css">';
          else echo '<link rel="stylesheet" href="assets/css/black.css">'; }?>

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
