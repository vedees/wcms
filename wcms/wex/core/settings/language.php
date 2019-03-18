<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

  $lang_choices = ['en', 'ru', 'uk'];
   // Default
  if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = $GLOBALS['default_language'];
  // GET
  } else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
      //* EN
      if ($_GET['lang'] == 'en') {
        $_SESSION['lang'] = 'en';
      //* RU
      } else if ($_GET['lang'] == 'ru') {
        $_SESSION['lang'] = 'ru';
      //* UK
      } else if ($_GET['lang'] == 'uk') {
        $_SESSION['lang'] = 'uk';
      }
  }

  require_once 'languages/' . $_SESSION['lang'] . '.php';