<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Image {

  public function image_filter () {
    $imgmas = array();
    //TODO rm reg
    $imgmas = $this->get_images();
    // foreach($GLOBALS['html']->find('img') as $e)
      // $imgmas[] = $e->src;
    $img_all = $this->finder($imgmas, true, 1);
    // All img
    return $img_all;
  }

  public function get_img_main () {
    $img = array();
    foreach($GLOBALS['html']->find('img.wcms-img-main') as $element)
      $img[] = $element->src;
    // All img
    return $img_all = $this->finder($img, false);
  }

  public function get_img_content () {
    $img = array();
    foreach($GLOBALS['html']->find('img.wcms-img-content') as $element)
      $img[] = $element->src;
    // All img
    return $img_all = $this->finder($img, false);
  }

  // Search all Images
  private function get_images () {
    $imgreg = '/<img(?:\\s[^<>]*?)?\\bsrc\\s*=\\s*(?|"([^"]*)"|\'([^\']*)\'|([^<>\'"\\s]*))[^<>]*>/i';
    preg_match_all($imgreg, $GLOBALS['template'], $imgmas);
    return $imgmas;
  }

  //TODO class
  private function finder($where_find, $trim=true, $offet=0) {
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
      $object = new stdClass();
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