<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\text;

class Parser {
  static function get_html_parse ($text, $what_find) {
    foreach($GLOBALS['html']->find($what_find) as $element)
      if ($_SESSION['tags_show'] === 'yes') $text[] = $element->outertext;
      else $text[] = $element->innertext;

    return $text;
  }
 }