<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

 class ParseText {
  static function get_html_parse ($text, $what_find) {
    foreach($GLOBALS['html']->find($what_find) as $element)
      $text[] = $element->innertext;
    return $text;
  }
 }