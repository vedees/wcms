<?php
/**
 * PHP File Manager (2017-08-07)
 * https://github.com/alexantr/filemanager
 */

// Auth with login/password (set true/false to enable/disable it)
$use_auth = false;

// Users: array('Username' => 'Password', 'Username2' => 'Password2', ...)
$auth_users = array(
  'fm_admin' => 'fm_admin',
);

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
$highlightjs_style = 'vs';

// Default timezone for date() and time() - http://php.net/manual/en/timezones.php
$default_timezone = 'Europe/Minsk'; // UTC+3

// Root path for file manager
$root_path = SITE_DIR;

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// input encoding for iconv
$iconv_input_encoding = 'CP1251';

// date() format for file modification date
$datetime_format = 'd.m.y H:i';


//!--- EDIT BELOW CAREFULLY OR DO NOT EDIT AT ALL
// if fm included
if (defined('FM_EMBED')) {
  $use_auth = false;
} else {
  @set_time_limit(600);

  date_default_timezone_set($default_timezone);

  ini_set('default_charset', 'UTF-8');
  if (version_compare(PHP_VERSION, '5.6.0', '<') && function_exists('mb_internal_encoding')) {
    mb_internal_encoding('UTF-8');
  }
  if (function_exists('mb_regex_encoding')) {
    mb_regex_encoding('UTF-8');
  }
}

if (empty($auth_users)) {
  $use_auth = false;
}

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
  || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

// clean and check $root_path
$root_path = rtrim($root_path, '\\/');
$root_path = str_replace('\\', '/', $root_path);
if (!@is_dir($root_path)) {
  echo sprintf('<h1>Root path "%s" not found!</h1>', fm_enc($root_path));
  exit;
}

// clean $root_url
$root_url = fm_clean_path($root_url);

// abs path for site
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . (!empty($root_url) ? '/' . $root_url : ''));
defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

// logout
if (isset($_GET['logout'])) {
  unset($_SESSION['logged']);
  fm_redirect(FM_SELF_URL);
}

// Show image here
if (isset($_GET['img'])) {
  fm_show_image($_GET['img']);
}

// Auth
if ($use_auth) {
  if (isset($_SESSION['logged'], $auth_users[$_SESSION['logged']])) {
    // Logged
  } elseif (isset($_POST['fm_usr'], $_POST['fm_pwd'])) {
    // Logging In
    sleep(1);
    if (isset($auth_users[$_POST['fm_usr']]) && $_POST['fm_pwd'] === $auth_users[$_POST['fm_usr']]) {
      $_SESSION['logged'] = $_POST['fm_usr'];
      fm_set_msg('You are logged in');
      fm_redirect(FM_SELF_URL . '?p=');
    } else {
      unset($_SESSION['logged']);
      fm_set_msg('Wrong password', 'error');
      fm_redirect(FM_SELF_URL);
    }
  } else {
    // Form
    unset($_SESSION['logged']);
    fm_show_header();
    fm_show_message();
    ?>
    <div class="path">
      <form action="" method="post" style="margin:10px;text-align:center">
        <input name="fm_usr" value="" placeholder="Username" required>
        <input type="password" name="fm_pwd" value="" placeholder="Password" required>
        <input type="submit" value="Login">
      </form>
    </div>
    <?php
    fm_show_footer();
    exit;
  }
}

define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

// always use ?p=
if (!isset($_GET['p'])) {
  fm_redirect(FM_SELF_URL . '?p=');
}

// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
$p = fm_clean_path($p);

// instead globals vars
define('FM_PATH', $p);
define('FM_USE_AUTH', $use_auth);

defined('FM_ICONV_INPUT_ENC') || define('FM_ICONV_INPUT_ENC', $iconv_input_encoding);
defined('FM_USE_HIGHLIGHTJS') || define('FM_USE_HIGHLIGHTJS', $use_highlightjs);
defined('FM_HIGHLIGHTJS_STYLE') || define('FM_HIGHLIGHTJS_STYLE', $highlightjs_style);
defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $datetime_format);

unset($p, $use_auth, $iconv_input_encoding, $use_highlightjs, $highlightjs_style);
?>