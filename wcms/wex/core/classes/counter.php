<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes;

use wcms\classes\css_js\Files;
use wcms\classes\images\Images;

class Counter {

  // Constructor
  public function __construct() {
    $this->files = new Files();
    $this->images = new Images();
  }

  // HTML
  public function total_html () {
    return $html_count = count($GLOBALS['html_list']);
  }

  // CSS
  public function total_css () {
    return $css_count = count($this->files->all_css());
  }

  // JS
  public function total_js () {
    return $js_count = count($this->files->all_js());
  }

  // Images
  public function total_img () {
    return $img_count = count($this->images->image_filter());
  }

  public function total_backup () {
    $count = count(scandir(BACKUP_DIR));
    //? 3? - 1
    $count = $count - 4;
    if ($count === 0) return '<span class="ui-label ui-label--danger"> WARRING! - <b>0</b></span>';
    return $count;
  }

}
