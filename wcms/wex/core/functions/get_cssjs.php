<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class CssJs {
  public function all_css () {
    $template = get_html_name();
    // Css
    $css = array();
    // Find all css files
    $cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/";
    preg_match_all($cssreg, $template, $cssmas);

    for ($i=0; $i < count($cssmas[1]); $i++) {
      $css_name = trim($cssmas[1][$i]);
      $css_path = '../' . $css_name;
      // Size (bytes)
      $css_size = filesize($css_path);
      $css_edit_time = date("m:d:Y H:i", filectime($css_path));
      // Info
      $object = new stdClass();
      $object->id = $i;
      $object->type = 'css';
      $object->title = $css_name;
      $object->path = $css_path;
      $object->size = $css_size;
      $object->editTime = $css_edit_time;
      // Push
      $css[] = $object;
    };
    // All img
    return $css;
  }

}