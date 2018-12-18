<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

session_start();
// Admin Config
require_once dirname(dirname(dirname(__FILE__))) . '/config.php';  //x3 folder
// All Functions
require_once 'functions.php';
// Get Page
require_once 'get_page.php';
// All Classes
require_once 'class.php';
// Theme choice
require_once 'theme.php';
// Language choice
require_once 'language.php';
