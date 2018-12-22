<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Text {

  // Find all Text
  public function get_text_all () {
    // Text list
    $id = 0;
    $text_all = array();
    // Text single
    $text = $this->get_text();
    for ($i=0; $i< count($text); $i++) {
      if (strlen(trim($text[$i])) > 1) {
        $object = new stdClass();
        $object->id = $id;
        $object->title = (trim($text[$i]));
        $id++;
        $text_all[] = $object;
      }
    };
    return $text_all;
  }

  private function get_text () {
    //TODO another preg
    $content = preg_replace('/<[^>]+>/', '^', $GLOBALS['template']);
    return $text = explode('^', $content);
  }

  public function str_replace_nth($search, $replace, $subject, $nth) {
    $found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
    if (false !== $found && $found > $nth) {
      return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
    }
    return $subject;
  }
}