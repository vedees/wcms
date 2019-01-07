<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
require 'core/FileFinder.php';
$user = new wcms\classes\auth\Login;
$user->require_login();?>

<?php $page_title = 'Finder - WCMS';
      $page = 'finder'; ?>

<?php include('includes/header.php');
      include('includes/finder/actions.php');
      include('includes/finder/modals.php'); ?>

<?php
//--- FILEMANAGER MAIN
fm_show_header(); // HEADER
fm_show_nav_path(FM_PATH); // current path

// messages
fm_show_message();

$num_files = count($files);
$num_folders = count($folders);
$all_files_size = 0;
?>

<form action="" method="post">
  <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
  <input type="hidden" name="group" value="1">
  <!-- table start -->
  <table class="ui-table ui-table--finder ui-table--hover">
  <!-- table head -->
  <thead>
    <tr>
    <th>
      <!-- Input All -->
      <div class="ui-checkbox-wrapper">
      <input class="ui-checkbox" type="checkbox" onclick="checkbox_toggle()">
      </div>
    </th>
    <th><?php echo $lang['name'] ?></th>
    <th><?php echo $lang['size'] ?></th>
    <th><?php echo $lang['modified'] ?></th>
    <?php if (!FM_IS_WIN): ?><th><?php echo $lang['perms'] ?></th><th><?php echo $lang['owner'] ?></th><?php endif; ?>
    <!-- for icons -->
    <th style="width:13%"></th>
    </tr>
  </thead>
<?php

// link to parent folder
if ($parent !== false) { ?>
  <tr>
  <td></td>
  <td colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>"><a href="?p=<?php echo urlencode($parent) ?>"><i class="finder-icon__wrapper icon-arrow_up"></i> ..</a></td>
  </tr>

<?php }

foreach ($folders as $f) {
  $is_link = is_link($path . '/' . $f);
  $img = $is_link ? 'icon-link_folder' : 'icon-folder';
  $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
  $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
  if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
    $owner = posix_getpwuid(fileowner($path . '/' . $f));
    $group = posix_getgrgid(filegroup($path . '/' . $f));
  } else {
    $owner = array('name' => '?');
    $group = array('name' => '?');
  }
  ?>

  <tr>
  <td><label><input class="ui-checkbox" type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label></td>
  <td>
    <div class="filename icon__wrapper"><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="<?php echo $img ?>"></i> <?php echo fm_enc(fm_convert_win($f)) ?></a><?php echo ($is_link ? ' &rarr; <i>' . fm_enc(readlink($path . '/' . $f)) . '</i>' : '') ?></div>
  </td>
  <td><span class="ui-text-regular"><?php echo $lang['folder'] ?></span></td>
  <td><span class="ui-text-small"><?php echo $modif ?></span></td>
  <?php if (!FM_IS_WIN): ?>
  <td><a class="ui-text-small" title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a></td>
  <td><span class="ui-text-small"><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></span></td>
  <?php endif; ?>
  <td>
    <a title="Delete" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('Delete folder?');"><i class="finder-icon__wrapper icon-cross"></i></a>
    <a title="Rename" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;"><i class="finder-icon__wrapper icon-rename"></i></a>
    <a title="Copy to..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="finder-icon__wrapper icon-copy"></i></a>
    <a title="Direct link" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/') ?>" target="_blank"><i class="finder-icon__wrapper icon-chain"></i></a>
  </td>
  </tr>
  <?php
  flush();
}


foreach ($files as $f) {
  $is_link = is_link($path . '/' . $f);
  $img = $is_link ? 'icon-link_file' : fm_get_file_icon_class($path . '/' . $f);
  $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
  $filesize_raw = filesize($path . '/' . $f);
  $filesize = fm_get_filesize($filesize_raw);
  $filelink = '?p=' . urlencode(FM_PATH) . '&view=' . urlencode($f);
  $all_files_size += $filesize_raw;
  $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
  if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
    $owner = posix_getpwuid(fileowner($path . '/' . $f));
    $group = posix_getgrgid(filegroup($path . '/' . $f));
  } else {
    $owner = array('name' => '?');
    $group = array('name' => '?');
  }
  ?>
  <tr>
    <td><label><input class="ui-checkbox" type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label></td>
    <td><div class="filename"><a href="<?php echo fm_enc($filelink) ?>" title="File info"><i class="<?php echo $img ?>"></i> <?php echo fm_enc(fm_convert_win($f)) ?></a><?php echo ($is_link ? ' &rarr; <i>' . fm_enc(readlink($path . '/' . $f)) . '</i>' : '') ?></div></td>
    <td><span class="gray" title="<?php printf('%s bytes', $filesize_raw) ?>"><?php echo $filesize ?></span></td>
    <td><span class="ui-text-small"><?php echo $modif ?></span></td>
    <?php if (!FM_IS_WIN): ?>
    <td><a class="ui-text-small" title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a></td>
    <td><span class="ui-text-smaller"><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></span></td>
    <?php endif; ?>
    <td>
    <a title="Delete" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('Delete file?');"> <i class="icon-cross"></i></a>
    <a title="Rename" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;"> <i class="icon-rename"></i></a>
    <a title="Copy to..." href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"> <i class="icon-copy"></i></a>
    <a title="Direct link" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f) ?>" target="_blank"> <i class="icon-chain"></i></a>
    <a title="Download" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"> <i class="icon-download"></i></a>
  </td>
</tr>
  <?php
  flush();
}

if (empty($folders) && empty($files)) {
  ?>
<tr><td></td><td colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>"><em>Folder is empty</em></td></tr>
<?php
} else {
  ?>
  <tr><td class="gray"></td><td class="gray" colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>">

  <?php echo $lang['fullsize'] ?>: <span title="<?php printf('%s bytes', $all_files_size) ?>"><?php echo fm_get_filesize($all_files_size) ?></span>,
  <?php echo $lang['files'] ?>: <?php echo $num_files ?>,
  <?php echo $lang['folders'] ?>: <?php echo $num_folders ?>
</td></tr>
<?php
}
?>
  <!-- table end -->
  </table>
  <!-- inputs info -->
  <div class="finder-info__link">
    <a href="#" onclick="select_all();return false;"><i class="finder-icon__wrapper icon-checkbox"></i> <?php echo $lang['selectAll'] ?></a> &nbsp;
    <a href="#" onclick="unselect_all();return false;"><i class="finder-icon__wrapper icon-checkbox_uncheck"></i> <?php echo $lang['unselectAll'] ?></a> &nbsp;
    <a href="#" onclick="invert_all();return false;"><i class="finder-icon__wrapper icon-checkbox_invert"></i> <?php echo $lang['invertSelection'] ?></a></p>
  </div>
  <!-- info wrapper -->
  <div class="finder-info__wrapper">
    <!-- info btn main -->
    <div class="finder-info__button">
    <a class="button button--round button-default" title="Upload files" href="?p=&amp;upload">
      <div class="button-icon__wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
      <span><?php echo $lang['uploadFiles'] ?></span>
      </div>
    </a>
    <a class="button button--round button-default" title="New folder" href="#" onclick="newfolder('');return false;">
      <div class="button-icon__wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
      <span><?php echo $lang['newFolder'] ?></span>
      </div>
    </a>
    </div>
    <!-- info btn -->
    <div class="finder-info__button">
    <button class="button--round button-default" type="submit" name="delete" value="Delete" onclick="return confirm('Delete selected files and folders?')">
      <div class="button-icon__wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
      <span><?php echo $lang['delete'] ?></span>
      </div>
    </button>
    <button class="button--round button-default" type="submit" name="zip" value="Pack" onclick="return confirm('Create archive?')">
      <div class="button-icon__wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
      <span><?php echo $lang['archive'] ?></span>
      </div>
    </button>
    <button class="button--round button-default" type="submit" name="copy" value="Copy">
      <div class="button-icon__wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
      <span><?php echo $lang['copy'] ?></span>
      </div>
    </button>
    </div>
  </div>
  </form>

<?php
fm_show_footer();


// ---------------------
// Functions
// ---------------------

/**
 * Delete  file or folder (recursively)
 * @param string $path
 * @return bool
 */
function fm_rdelete($path)
{
  if (is_link($path)) {
    return unlink($path);
  } elseif (is_dir($path)) {
    $objects = scandir($path);
    $ok = true;
    if (is_array($objects)) {
      foreach ($objects as $file) {
        if ($file != '.' && $file != '..') {
          if (!fm_rdelete($path . '/' . $file)) {
            $ok = false;
          }
        }
      }
    }
    return ($ok) ? rmdir($path) : false;
  } elseif (is_file($path)) {
    return unlink($path);
  }
  return false;
}

/**
 * Recursive chmod
 * @param string $path
 * @param int $filemode
 * @param int $dirmode
 * @return bool
 * @todo Will use in mass chmod
 */
function fm_rchmod($path, $filemode, $dirmode)
{
  if (is_dir($path)) {
    if (!chmod($path, $dirmode)) {
      return false;
    }
    $objects = scandir($path);
    if (is_array($objects)) {
      foreach ($objects as $file) {
        if ($file != '.' && $file != '..') {
          if (!fm_rchmod($path . '/' . $file, $filemode, $dirmode)) {
            return false;
          }
        }
      }
    }
    return true;
  } elseif (is_link($path)) {
    return true;
  } elseif (is_file($path)) {
    return chmod($path, $filemode);
  }
  return false;
}

/**
 * Safely rename
 * @param string $old
 * @param string $new
 * @return bool|null
 */
function fm_rename($old, $new)
{
  return (!file_exists($new) && file_exists($old)) ? rename($old, $new) : null;
}

/**
 * Copy file or folder (recursively).
 * @param string $path
 * @param string $dest
 * @param bool $upd Update files
 * @param bool $force Create folder with same names instead file
 * @return bool
 */
function fm_rcopy($path, $dest, $upd = true, $force = true)
{
  if (is_dir($path)) {
    if (!fm_mkdir($dest, $force)) {
      return false;
    }
    $objects = scandir($path);
    $ok = true;
    if (is_array($objects)) {
      foreach ($objects as $file) {
        if ($file != '.' && $file != '..') {
          if (!fm_rcopy($path . '/' . $file, $dest . '/' . $file)) {
            $ok = false;
          }
        }
      }
    }
    return $ok;
  } elseif (is_file($path)) {
    return fm_copy($path, $dest, $upd);
  }
  return false;
}

/**
 * Safely create folder
 * @param string $dir
 * @param bool $force
 * @return bool
 */
function fm_mkdir($dir, $force)
{
  if (file_exists($dir)) {
    if (is_dir($dir)) {
      return $dir;
    } elseif (!$force) {
      return false;
    }
    unlink($dir);
  }
  return mkdir($dir, 0777, true);
}

/**
 * Safely copy file
 * @param string $f1
 * @param string $f2
 * @param bool $upd
 * @return bool
 */
function fm_copy($f1, $f2, $upd)
{
  $time1 = filemtime($f1);
  if (file_exists($f2)) {
    $time2 = filemtime($f2);
    if ($time2 >= $time1 && $upd) {
      return false;
    }
  }
  $ok = copy($f1, $f2);
  if ($ok) {
    touch($f2, $time1);
  }
  return $ok;
}

/**
 * Get mime type
 * @param string $file_path
 * @return mixed|string
 */
function fm_get_mime_type($file_path)
{
  if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_path);
    finfo_close($finfo);
    return $mime;
  } elseif (function_exists('mime_content_type')) {
    return mime_content_type($file_path);
  } elseif (!stristr(ini_get('disable_functions'), 'shell_exec')) {
    $file = escapeshellarg($file_path);
    $mime = shell_exec('file -bi ' . $file);
    return $mime;
  } else {
    return '--';
  }
}

/**
 * HTTP Redirect
 * @param string $url
 * @param int $code
 */
function fm_redirect($url, $code = 302)
{
  header('Location: ' . $url, true, $code);
  exit;
}

/**
 * Clean path
 * @param string $path
 * @return string
 */
function fm_clean_path($path)
{
  $path = trim($path);
  $path = trim($path, '\\/');
  $path = str_replace(array('../', '..\\'), '', $path);
  if ($path == '..') {
    $path = '';
  }
  return str_replace('\\', '/', $path);
}

/**
 * Get parent path
 * @param string $path
 * @return bool|string
 */
function fm_get_parent_path($path)
{
  $path = fm_clean_path($path);
  if ($path != '') {
    $array = explode('/', $path);
    if (count($array) > 1) {
      $array = array_slice($array, 0, -1);
      return implode('/', $array);
    }
    return '';
  }
  return false;
}

/**
 * Get nice filesize
 * @param int $size
 * @return string
 */
function fm_get_filesize($size)
{
  if ($size < 1000) {
    return sprintf('%s B', $size);
  } elseif (($size / 1024) < 1000) {
    return sprintf('%s Kb', round(($size / 1024), 2));
  } elseif (($size / 1024 / 1024) < 1000) {
    return sprintf('%s Mb', round(($size / 1024 / 1024), 2));
  } elseif (($size / 1024 / 1024 / 1024) < 1000) {
    return sprintf('%s Gb', round(($size / 1024 / 1024 / 1024), 2));
  } else {
    return sprintf('%s Tb', round(($size / 1024 / 1024 / 1024 / 1024), 2));
  }
}

/**
 * Get info about zip archive
 * @param string $path
 * @return array|bool
 */
function fm_get_zif_info($path)
{
  if (function_exists('zip_open')) {
    $arch = zip_open($path);
    if ($arch) {
      $filenames = array();
      while ($zip_entry = zip_read($arch)) {
        $zip_name = zip_entry_name($zip_entry);
        $zip_folder = substr($zip_name, -1) == '/';
        $filenames[] = array(
          'name' => $zip_name,
          'filesize' => zip_entry_filesize($zip_entry),
          'compressed_size' => zip_entry_compressedsize($zip_entry),
          'folder' => $zip_folder
          //'compression_method' => zip_entry_compressionmethod($zip_entry),
        );
      }
      zip_close($arch);
      return $filenames;
    }
  }
  return false;
}

/**
 * Encode html entities
 * @param string $text
 * @return string
 */
function fm_enc($text)
{
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Save message in session
 * @param string $msg
 * @param string $status
 */
function fm_set_msg($msg, $status = 'ok')
{
  $_SESSION['message'] = $msg;
  $_SESSION['status'] = $status;
}

/**
 * Check if string is in UTF-8
 * @param string $string
 * @return int
 */
function fm_is_utf8($string)
{
  return preg_match('//u', $string);
}

/**
 * Convert file name to UTF-8 in Windows
 * @param string $filename
 * @return string
 */
function fm_convert_win($filename)
{
  if (FM_IS_WIN && function_exists('iconv')) {
    $filename = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $filename);
  }
  return $filename;
}

/**
 * Get CSS classname for file
 * @param string $path
 * @return string
 */
function fm_get_file_icon_class($path)
{
  // get extension
  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

  switch ($ext) {
    case 'ico': case 'gif': case 'jpg': case 'jpeg': case 'jpc': case 'jp2':
    case 'jpx': case 'xbm': case 'wbmp': case 'png': case 'bmp': case 'tif':
    case 'tiff':
      $img = 'icon-file_image';
      break;
    case 'txt': case 'css': case 'ini': case 'conf': case 'log': case 'htaccess':
    case 'passwd': case 'ftpquota': case 'sql': case 'js': case 'json': case 'sh':
    case 'config': case 'twig': case 'tpl': case 'md': case 'gitignore':
    case 'less': case 'sass': case 'scss': case 'c': case 'cpp': case 'cs': case 'py':
    case 'map': case 'lock': case 'dtd':
      $img = 'icon-file_text';
      break;
    case 'zip': case 'rar': case 'gz': case 'tar': case '7z':
      $img = 'icon-file_zip';
      break;
    case 'php': case 'php4': case 'php5': case 'phps': case 'phtml':
      $img = 'icon-file_php';
      break;
    case 'htm': case 'html': case 'shtml': case 'xhtml':
      $img = 'icon-file_html';
      break;
    case 'xml': case 'xsl': case 'svg':
      $img = 'icon-file_code';
      break;
    case 'wav': case 'mp3': case 'mp2': case 'm4a': case 'aac': case 'ogg':
    case 'oga': case 'wma': case 'mka': case 'flac': case 'ac3': case 'tds':
      $img = 'icon-file_music';
      break;
    case 'm3u': case 'm3u8': case 'pls': case 'cue':
      $img = 'icon-file_playlist';
      break;
    case 'avi': case 'mpg': case 'mpeg': case 'mp4': case 'm4v': case 'flv':
    case 'f4v': case 'ogm': case 'ogv': case 'mov': case 'mkv': case '3gp':
    case 'asf': case 'wmv':
      $img = 'icon-file_film';
      break;
    case 'eml': case 'msg':
      $img = 'icon-file_outlook';
      break;
    case 'xls': case 'xlsx':
      $img = 'icon-file_excel';
      break;
    case 'csv':
      $img = 'icon-file_csv';
      break;
    case 'doc': case 'docx':
      $img = 'icon-file_word';
      break;
    case 'ppt': case 'pptx':
      $img = 'icon-file_powerpoint';
      break;
    case 'ttf': case 'ttc': case 'otf': case 'woff':case 'woff2': case 'eot': case 'fon':
      $img = 'icon-file_font';
      break;
    case 'pdf':
      $img = 'icon-file_pdf';
      break;
    case 'psd':
      $img = 'icon-file_photoshop';
      break;
    case 'ai': case 'eps':
      $img = 'icon-file_illustrator';
      break;
    case 'fla':
      $img = 'icon-file_flash';
      break;
    case 'swf':
      $img = 'icon-file_swf';
      break;
    case 'exe': case 'msi':
      $img = 'icon-file_application';
      break;
    case 'bat':
      $img = 'icon-file_terminal';
      break;
    default:
      $img = 'icon-document';
  }

  return $img;
}

/**
 * Get image files extensions
 * @return array
 */
function fm_get_image_exts()
{
  return array('ico', 'gif', 'jpg', 'jpeg', 'jpc', 'jp2', 'jpx', 'xbm', 'wbmp', 'png', 'bmp', 'tif', 'tiff', 'psd');
}

/**
 * Get video files extensions
 * @return array
 */
function fm_get_video_exts()
{
  return array('webm', 'mp4', 'm4v', 'ogm', 'ogv', 'mov');
}

/**
 * Get audio files extensions
 * @return array
 */
function fm_get_audio_exts()
{
  return array('wav', 'mp3', 'ogg', 'm4a');
}

/**
 * Get text file extensions
 * @return array
 */
function fm_get_text_exts()
{
  return array(
    'txt', 'css', 'ini', 'conf', 'log', 'htaccess', 'passwd', 'ftpquota', 'sql', 'js', 'json', 'sh', 'config',
    'php', 'php4', 'php5', 'phps', 'phtml', 'htm', 'html', 'shtml', 'xhtml', 'xml', 'xsl', 'm3u', 'm3u8', 'pls', 'cue',
    'eml', 'msg', 'csv', 'bat', 'twig', 'tpl', 'md', 'gitignore', 'less', 'sass', 'scss', 'c', 'cpp', 'cs', 'py',
    'map', 'lock', 'dtd', 'svg',
  );
}

/**
 * Get mime types of text files
 * @return array
 */
function fm_get_text_mimes()
{
  return array(
    'application/xml',
    'application/javascript',
    'application/x-javascript',
    'image/svg+xml',
    'message/rfc822',
  );
}

/**
 * Get file names of text files w/o extensions
 * @return array
 */
function fm_get_text_names()
{
  return array(
    'license',
    'readme',
    'authors',
    'contributors',
    'changelog',
  );
}

// ---------------------
//! templates functions
// ---------------------

/**
 * Show nav block
 * @param string $path
 */
function fm_show_nav_path($path)
{
  ?>
<div class="path">
<div class="float-right">
<a title="Upload files" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;upload"><i class="icon-upload"></i></a>
<a title="New folder" href="#" onclick="newfolder('<?php echo fm_enc(FM_PATH) ?>');return false;"><i class="icon-folder_add"></i></a>
<?php if (FM_USE_AUTH): ?><a title="Logout" href="?logout=1"><i class="icon-logout"></i></a><?php endif; ?>
</div>
    <?php
    $path = fm_clean_path($path);
    $root_url = "<a href='?p='><i class='icon-home' title='" . FM_ROOT_PATH . "'></i></a>";
    $sep = '<i class="icon-separator"></i>';
    if ($path != '') {
      $exploded = explode('/', $path);
      $count = count($exploded);
      $array = array();
      $parent = '';
      for ($i = 0; $i < $count; $i++) {
        $parent = trim($parent . '/' . $exploded[$i], '/');
        $parent_enc = urlencode($parent);
        $array[] = "<a href='?p={$parent_enc}'>" . fm_enc(fm_convert_win($exploded[$i])) . "</a>";
      }
      $root_url .= $sep . implode($sep, $array);
    }
    echo '<div class="break-word">' . $root_url . '</div>';
    ?>
</div>
<?php
}

/**
 * Show message from session
 */
function fm_show_message()
{
  if (isset($_SESSION['message'])) {
    $class = isset($_SESSION['status']) ? $_SESSION['status'] : 'ok';
    echo '<div class="ui-alert ui-alert--' . $class . '"><span class="alert-title">' . $_SESSION['message'] . '</span></div>';
    unset($_SESSION['message']);
    unset($_SESSION['status']);
  }
}

/**
 * Show page header
 */
function fm_show_header()
{
  ?>
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/<?php echo FM_HIGHLIGHTJS_STYLE ?>.min.css">
<?php endif; ?>
<section>
  <div class="container">
  <div id="finder__wrapper">
<?php
}


/**
 * Show page footer
 */
function fm_show_footer()
{
  ?>
  </div>
  </div>
</section>
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
<?php endif; ?>
<?php } 

/**
 * Show image
 * @param string $img
 */
function fm_show_image($img)
{
  $modified_time = gmdate('D, d M Y 00:00:00') . ' GMT';
  $expires_time = gmdate('D, d M Y 00:00:00', strtotime('+1 day')) . ' GMT';

  $img = trim($img);
  $images = fm_get_images();
  $image = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVR42mL4//8/A0CAAQAI/AL+26JNFgAAAABJRU5ErkJggg==';
  if (isset($images[$img])) {
    $image = $images[$img];
  }
  $image = base64_decode($image);
  if (function_exists('mb_strlen')) {
    $size = mb_strlen($image, '8bit');
  } else {
    $size = strlen($image);
  }

  if (function_exists('header_remove')) {
    header_remove('Cache-Control');
    header_remove('Pragma');
  } else {
    header('Cache-Control:');
    header('Pragma:');
  }

  header('Last-Modified: ' . $modified_time, true, 200);
  header('Expires: ' . $expires_time);
  header('Content-Length: ' . $size);
  header('Content-Type: image/png');
  echo $image;

  exit;
}

/**
 * Get base64-encoded images
 * @return array
 */
function fm_get_images()
{
  return array(
    'favicon' => 'iVBORw0KGgoAAAANSU',
    'sprites' => 'iVBORw0KGgoAAAA',
  );
}

?>

<?php include('includes/footer.php'); ?>
