<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Finder {
  static function find ($mask, $name) {
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