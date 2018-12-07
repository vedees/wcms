<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

  // POST Check pagename (in sidebar)
  if (isset($_POST['pagename'])) {
    $_SESSION['pagename'] = $_POST['pagename'];
  };
  if (isset($_SESSION['pagename'])) {
    $GLOBALS['pagename'] = $_SESSION['pagename'];
  } else {
    // POST Error
    $GLOBALS['pagename']= '../index.html';
  };
  $GLOBALS['pagename'] = $_SESSION['pagename'];

  // Get template (from pagename)
  $GLOBALS['template'] = file_get_contents($GLOBALS['pagename']);

  // Get HTML list
  $GLOBALS['html_list'] = glob("../*.html");