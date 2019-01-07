<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\images;

class Find {
  static function find($where_find, $trim=true, $offet=0) {
    $result = array();
    // трим нужен только для всех файлов тк там регулярка
    if ($trim) {
      $where = $where_find[$offet];
    } else {
      $where = $where_find;
    }
    // Find Images
    for ($i=0; $i<count($where); $i++) {
      $img_name = trim($where[$i]);
      $img_path = '../' . $img_name;
      $img_size = getimagesize($img_path);
      $img_file_size = filesize($img_path);
      $img_edit_time = date("d-m-Y", filectime($img_path));

      // Create object
      $object = new \stdClass();
      $object->id = $i;
      $object->title = $img_name;
      $object->path = $img_path;
      $object->fileSize = formatBytes($img_file_size);
      $object->sizeH = $img_size[0];
      $object->sizeW = $img_size[1];
      $object->editTime = $img_edit_time;
      // Push
      $result[] = $object;
    }
    return $result;
  }
}