<?php
  // Default
  if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
  // GET
  } else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
      //* EN
      if ($_GET['lang'] == 'en') {
        $_SESSION['lang'] = 'en';
      //* RU
      } else if ($_GET['lang'] == 'ru') {
        $_SESSION['lang'] = 'ru';
      }
  }

  require_once 'languages/' . $_SESSION['lang'] . '.php';