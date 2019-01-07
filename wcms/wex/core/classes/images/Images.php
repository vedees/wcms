<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\images;

use wcms\classes\images\Find;

class Images {

  // Construct
  public function __construct() {
    // Finder
    $this->finder = new Find();
  }

  // ALL images
  public function image_filter () {
    $imgmas = array();
    //TODO rm reg
    $imgmas = $this->get_images();
    // foreach($GLOBALS['html']->find('img') as $e)
      // $imgmas[] = $e->src;
    $img_all = $this->finder->find($imgmas, true, 1);
    return $img_all;
  }

  // Only Main img
  public function get_img_main () {
    $img = array();
    foreach($GLOBALS['html']->find('img.wcms-img-main') as $element)
      $img[] = $element->src;
    // All img
    return $img_all = $this->finder->find($img, false);
  }

  // Only Content img
  public function get_img_content () {
    $img = array();
    foreach($GLOBALS['html']->find('img.wcms-img-content') as $element)
      $img[] = $element->src;
    // All img
    return $img_all = $this->finder->find($img, false);
  }

  // Only Icons img
  public function get_img_icon () {
    $img = array();
    foreach($GLOBALS['html']->find('img.wcms-img-icon') as $element)
      $img[] = $element->src;
    // All img
    return $img_all = $this->finder->find($img, false);
  }

  // Filter for search all img
  // TODO rm reg. to parse
  private function get_images () {
    $imgreg = '/<img(?:\\s[^<>]*?)?\\bsrc\\s*=\\s*(?|"([^"]*)"|\'([^\']*)\'|([^<>\'"\\s]*))[^<>]*>/i';
    preg_match_all($imgreg, $GLOBALS['template'], $imgmas);
    return $imgmas;
  }

}