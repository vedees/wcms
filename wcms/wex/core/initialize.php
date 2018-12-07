<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/config.php';  //x3 folder
require_once 'get_page.php';
require_once 'functions.php';
require_once 'class.php';
require_once 'theme.php';
require_once 'language.php';
