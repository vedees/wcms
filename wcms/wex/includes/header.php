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

  <!-- Theme -->
  <?php if ($_SESSION['theme'] == 'Black') echo '<link rel="stylesheet" href="http://localhost:8080/wcms/wex/static/css/black.css">' ?>

  <!-- Server fix -->
  <link rel="stylesheet" href="http://localhost:8080/wcms/wex/static/css/main.css">

  <!-- To deploy -->
  <!-- WARRING '/' -->
  <!-- <link rel="stylesheet" href="/wcms/wex/static/css/main.css"> -->
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
