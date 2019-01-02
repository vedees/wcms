<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

// Redirect
function redirect_to ($url) {
	header('Location: ' . $url);
	exit;
}

// Empty Check
function is_blank($value) {
	return !isset($value) || trim($value) === '';
}

// Sidebar active class
function nav_is_active ($page, $name) {
  if ($page == $name) return true;
}

// Size Formater
function formatBytes ($size, $precision = 2) {
	$base = log($size, 1024);
	$suffixes = array('', 'Kb', 'Mb', 'G', 'T');
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

