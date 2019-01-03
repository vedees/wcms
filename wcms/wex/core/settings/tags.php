<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

  //! Show Tags
  $tags_show_choices = ['yes', 'no'];
  // Default
  if (!isset($_SESSION['tags_show'])) {
    $_SESSION['tags_show'] = $GLOBALS['default_tags_show'];
  // GET
  } else if (isset($_GET['tags_show']) && $_SESSION['tags_show'] != $_GET['tags_show'] && !empty($_GET['tags_show'])) {
      //* Yes
      if ($_GET['tags_show'] == 'yes') {
        $_SESSION['tags_show'] = 'yes';
      //* No
      } else if ($_GET['tags_show'] == 'no') {
        $_SESSION['tags_show'] = 'no';
      }
  }
