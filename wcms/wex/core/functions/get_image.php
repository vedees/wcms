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
    for ($i=0; $i<count($imgmas[1]); $i++) {
      // Data
      $img_name = trim($imgmas[1][$i]);
      $img_path = '../' . $img_name;
      $img_size = getimagesize($img_path);
      // Create object
      $object = new stdClass();
      $object->title = $img_name;
      // ???
      $object->path = $img_path;
      //TODO size to obj
      $object->sizeH = $img_size[0];
      $object->sizeW = $img_size[1];
      $object->id = $i;
      // Push
      $imgmas_all[] = $object;
    }
    // All img
    return $imgmas_all;
  }

  // Search all Images
  private function get_images () {
    //TODO fix template to global
    $template = get_html_name();
    $imgreg = "/[\"|\(']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|JPG|jpeg|JPEG|png|PNG|gif)))[\"|\)']/";
    preg_match_all($imgreg, $template, $imgmas);
    return $imgmas;
  }

}