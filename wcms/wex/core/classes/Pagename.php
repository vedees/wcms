<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes;

class Pagename {

  function set_page () {
    // POST Check pagename (in sidebar)
    if (isset($_POST['pagename'])) {
      $_SESSION['pagename'] = $_POST['pagename'];
    };

    if (isset($_SESSION['pagename'])) {
      $GLOBALS['pagename'] = $_SESSION['pagename'];
    } else {
      // POST Error
      // TODO create page var in config
      $GLOBALS['pagename'] = '../index.html';
    };

    // Get template (from pagename)
    // TODO FIX - to get
    // TODO to anoter f get/set +private template
    $GLOBALS['template'] = file_get_contents($GLOBALS['pagename']);

    //TODO same
    // Get HTML list
    $GLOBALS['html_list'] = glob("../*.html");

    //TODO same
    // Parser
    // create HTML DOM
    $GLOBALS['html'] = file_get_html($GLOBALS['pagename']);
  }
}