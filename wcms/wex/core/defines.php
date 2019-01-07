<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

define('DS', '/');
define('WCMS', true);
define('WCMS_TESTING', false);
define('WCMS_VERSION', '0.3.0');

//! Directories and Paths
define('WCMS_ROOT', str_replace(DIRECTORY_SEPARATOR, DS, getcwd()));
define('ROOT_DIR', WCMS_ROOT . '/');
// Backup
define('BACKUP_PATH', 'backups/');
define('BACKUP_DIR', ROOT_DIR . BACKUP_PATH);