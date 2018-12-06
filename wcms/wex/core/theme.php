<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */


  //! WCMS Theme
  $theme_choices = ['white', 'red'];
  // Default
  if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'red';
  // GET
  } else if (isset($_GET['theme']) && $_SESSION['theme'] != $_GET['theme'] && !empty($_GET['theme'])) {
      //* Red
      if ($_GET['theme'] == 'red') {
        $_SESSION['theme'] = 'red';
      //* White
      } else if ($_GET['theme'] == 'white') {
        $_SESSION['theme'] = 'white';
      }
  }

  //! Code Editor Theme
  $editor_theme_choices = ['default', 'monkai', 'dracula', 'twilight'];
  // Default
  if (!isset($_SESSION['editor_theme'])) {
    $_SESSION['editor_theme'] = 'default';
  // GET
  } else if (isset($_GET['editor_theme']) && $_SESSION['editor_theme'] != $_GET['editor_theme'] && !empty($_GET['editor_theme'])) {
      // default
      if ($_GET['editor_theme'] == 'default') {
        $_SESSION['editor_theme'] = 'default';
      // monkai
      } else if ($_GET['editor_theme'] == 'monkai') {
        $_SESSION['editor_theme'] = 'monkai';
      // dracula
      } else if ($_GET['editor_theme'] == 'dracula') {
        $_SESSION['editor_theme'] = 'dracula';
      // twilight
      } else if ($_GET['editor_theme'] == 'twilight') {
      $_SESSION['editor_theme'] = 'twilight';
      }
  }
