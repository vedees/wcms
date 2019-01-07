<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
ob_start();       // output buffering is turned on
session_start();  // turn on sessions
mb_internal_encoding('UTF-8');

// Show Error messages
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 1);

// Autoloader
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

// Admin Config
require_once dirname(dirname(dirname(__FILE__))) . '/config.php';  //x3 folder

//! Security rules
//  Place config.php one level up and uncomment the line below
// require_once dirname((dirname(dirname(dirname(__FILE__)))) . '/config.php';  //x4 folder

//todo Parser upd class
require_once 'libs/HtmlDomParser.php';

//TODO to classes
require_once 'settings/language.php';
require_once 'settings/tags.php';
require_once 'settings/theme.php';

//TODO example message get golobal var to component