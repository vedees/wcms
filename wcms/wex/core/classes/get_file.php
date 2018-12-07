<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Files {
  public function all_css () {
    // Name - js or css
    $name = 'css';
    // Find all css files
    $cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/";
    // Template search
    preg_match_all($cssreg, $GLOBALS['template'], $mask);
    // Get css array
    $css = Finder::find($mask, $name);
    return $css;
  }
  public function all_js () {
    // Name - js or css
    $name = 'js';
    // Find all js files
    $jsreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(js)))[\"']/";
    preg_match_all($jsreg, $GLOBALS['template'], $mask);

    $js = Finder::find($mask, $name);
    return $js;
  }

}