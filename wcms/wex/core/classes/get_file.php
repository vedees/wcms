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
    $css_name = 'css';
    $css_min_name = 'css min';
    // Find all css files
    $cssreg = "/[\"']((.*\\/\\/|)([\\/a-zA-Z0-9_-]+\\.(css)))[\"']/";
    $cssreg_min = "/[\"']((.*\\/\\/|)([\\/a-zA-Z0-9_-]+\\.(min)+\\.(css)))[\"']/";

    // Template search
    preg_match_all($cssreg, $GLOBALS['template'], $mask);
    preg_match_all($cssreg_min, $GLOBALS['template'], $mask_min);
    // Get css array
    $css = Finder::find($mask, $css_name, 0);
    $css_min = Finder::find($mask_min, $css_min_name, count($css));
    $all = array_merge($css, $css_min);
    return $all;
  }
  public function all_js () {
    // Name - js or css
    $js_name = 'js';
    $js_min_name = 'js min';
    // Find all js files
    $jsreg = "/[\"']((.*\\/\\/|)([\\/a-zA-Z0-9_-]+\\.(js)))[\"']/";
    $jsreg_min = "/[\"']((.*\\/\\/|)([\\/a-zA-Z0-9_-]+\\.(min)+\\.(js)))[\"']/";

    // Template search
    preg_match_all($jsreg, $GLOBALS['template'], $mask);
    preg_match_all($jsreg_min, $GLOBALS['template'], $mask_min);
    // Get css array
    $js = Finder::find($mask, $js_name, 0);
    $js_min = Finder::find($mask_min, $js_min_name, count($js));
    $all = array_merge($js, $js_min);
    return $all;
  }

}