<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

// $files = new Files();

class Counter {

  // Get Files
  protected $files;
  // Get Images
  protected $images;
  // Constructor
  public function __construct() {
    $this->files = new Files();
    $this->images = new Image();
  }

  // HTML
  public function total_html () {
    $html_count = count($GLOBALS['html_list']);
    return $html_count;
  }

  // CSS
  public function total_css () {
    $css_count = count($this->files->all_css());
    return $css_count;
  }

  // JS
  public function total_js () {
    $js_count = count($this->files->all_js());
    return $js_count;
  }

  // Images
  public function total_img () {
    $img_count = count($this->images->image_filter());
    return $img_count;
  }

}
