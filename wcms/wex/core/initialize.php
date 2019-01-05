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

// Admin Config
require_once dirname(dirname(dirname(__FILE__))) . '/config.php';  //x3 folder

//! Security rules
//  Place config.php one level up and uncomment the line below
// require_once dirname((dirname(dirname(dirname(__FILE__)))) . '/config.php';  //x4 folder

// Defindes
require_once 'defindes.php';
// Libs
require_once 'libs/HtmlDomParser.php';
// All Functions
require_once 'functions.php';
// Get Page
require_once 'get_page.php';
// All Classes
require_once 'class.php';
// All Settings
require_once 'setting.php';

//! DEVELOPMENT
// webpack dev server
// default: http://localhost:8080
$dev_port = 'http://localhost:8081';
// true if dev
$use_dev = false;

//TODO example message get golobal var to component