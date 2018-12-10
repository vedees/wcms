<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Image {
  public function image_filter () {
    $imgmas = $this->get_images();
    $imgmas_all = array();

    // Find Images
    for ($i=0; $i<count($imgmas[1]); $i++) {
      $img_name = trim($imgmas[1][$i]);
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
      $imgmas_all[] = $object;
    }
    // All img
    return $imgmas_all;
  }

  // Search all Images
  private function get_images () {
    $imgreg = "/[\"|\(']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|JPG|jpeg|JPEG|png|PNG|gif)))[\"|\)']/";
    preg_match_all($imgreg, $GLOBALS['template'], $imgmas);
    return $imgmas;
  }

}