<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

  //! WCMS Theme
  $theme_choices = ['white', 'black'];
  // Default
  if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = $GLOBALS['default_theme'];
  // GET
  } else if (isset($_GET['theme']) && $_SESSION['theme'] != $_GET['theme'] && !empty($_GET['theme'])) {
      //* Black
      if ($_GET['theme'] == 'black') {
        $_SESSION['theme'] = 'black';
      //* White
      } else if ($_GET['theme'] == 'white') {
        $_SESSION['theme'] = 'white';
      }
  }

  //! Code Editor Theme
  $editor_theme_choices = ['elegant', 'twilight'];
  // Default
  if (!isset($_SESSION['editor_theme'])) {
    $_SESSION['editor_theme'] = $GLOBALS['default_code_theme'];
  // GET
  } else if (isset($_GET['editor_theme']) && $_SESSION['editor_theme'] != $_GET['editor_theme'] && !empty($_GET['editor_theme'])) {
      // Dark
      if ($_GET['editor_theme'] == 'twilight') {
        $_SESSION['editor_theme'] = 'twilight';
      // Light
      } else if ($_GET['editor_theme'] == 'elegant') {
      $_SESSION['editor_theme'] = 'elegant';
      }
  }
