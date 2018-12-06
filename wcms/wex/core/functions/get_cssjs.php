<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class CssJs {
  //* All CSS
  public function all_css () {
    //TODO global
    $template = get_html_name();
    // Name - js or css
    $name = 'css';
    // Find all css files
    $cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/";
    // Template search
    preg_match_all($cssreg, $template, $mask);
    // Get css array
    $css = $this->file_finder($mask, $name);
    return $css;
  }
  //* All JS
  public function all_js () {
    $template = get_html_name();
    // Name - js or css
    $name = 'js';
    // Find all js files
    $jsreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(js)))[\"']/";
    preg_match_all($jsreg, $template, $mask);

    $js = $this->file_finder($mask, $name);
    return $js;
  }

  private function file_finder ($mask, $name) {
    $files = array();
    for ($i=0; $i < count($mask[1]); $i++) {
      $file_name = trim($mask[1][$i]);
      $file_path = '../' . $file_name;
      // Size (bytes)
      $file_size = filesize($file_path);
      $file_edit_time = date("d-m-Y", filectime($file_path));
      // Info
      $object = new stdClass();
      $object->id = $i;
      $object->type = $name;
      $object->title = $file_name;
      $object->path = $file_path;
      $object->size = $file_size;
      $object->editTime = $file_edit_time;
      // Push
      $files[] = $object;
    };
    return $files;
  }

}