<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\css_js;

class Find {

  // CSS/JS
  static function find ($mask, $name, $id=0) {
    $files = array();
    for ($i=0; $i < count($mask[1]); $i++) {
      $file_name = trim($mask[1][$i]);
      $file_path = '../' . $file_name;
      // Size (bytes)
      $file_size = filesize($file_path);
      $file_edit_time = date("d-m-Y", filectime($file_path));
      // Info
      $object = new \stdClass();
      $object->id = $id;
      $object->type = $name;
      $object->title = $file_name;
      $object->path = $file_path;
      $object->size = formatBytes($file_size);
      $object->editTime = $file_edit_time;
      $id++;
      // Push
      $files[] = $object;
    };
    return $files;
  }
}