<?php

// get current path
$path = FM_ROOT_PATH;
if (FM_PATH != '') {
  $path .= '/' . FM_PATH;
}

// check path
if (!is_dir($path)) {
  fm_redirect(FM_SELF_URL . '?p=');
}

// get parent folder
$parent = fm_get_parent_path(FM_PATH);

$objects = is_readable($path) ? scandir($path) : array();
$folders = array();
$files = array();
if (is_array($objects)) {
  foreach ($objects as $file) {
    if ($file == '.' || $file == '..') {
      continue;
    }
    $new_path = $path . '/' . $file;
    if (is_file($new_path)) {
      $files[] = $file;
    } elseif (is_dir($new_path) && $file != '.' && $file != '..') {
      $folders[] = $file;
    }
  }
}

if (!empty($files)) {
  natcasesort($files);
}
if (!empty($folders)) {
  natcasesort($folders);
}

// upload form
if (isset($_GET['upload'])) {
  fm_show_header(); // HEADER
  fm_show_nav_path(FM_PATH); // current path
  ?>
  <div class="path">
    <p><b>Uploading files</b></p>
    <p class="break-word">Destination folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?></p>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
      <input type="hidden" name="upl" value="1">
      <input type="file" name="upload[]"><br>
      <input type="file" name="upload[]"><br>
      <input type="file" name="upload[]"><br>
      <input type="file" name="upload[]"><br>
      <input type="file" name="upload[]"><br>
      <br>
      <p>
        <button class="btn"><i class="icon-apply"></i> Upload</button> &nbsp;
        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="icon-cancel"></i> Cancel</a></b>
      </p>
    </form>
  </div>
  <?php
  fm_show_footer();
  exit;
}

// copy form POST
if (isset($_POST['copy'])) {
  $copy_files = $_POST['file'];
  if (!is_array($copy_files) || empty($copy_files)) {
    fm_set_msg('Nothing selected', 'alert');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  fm_show_header(); // HEADER
  fm_show_nav_path(FM_PATH); // current path
  ?>
  <div class="path">
    <p><b>Copying</b></p>
    <form action="" method="post">
      <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
      <input type="hidden" name="finish" value="1">
      <?php
      foreach ($copy_files as $cf) {
        echo '<input type="hidden" name="file[]" value="' . fm_enc($cf) . '">' . PHP_EOL;
      }
      $copy_files_enc = array_map('fm_enc', $copy_files);
      ?>
      <p class="break-word">Files: <b><?php echo implode('</b>, <b>', $copy_files_enc) ?></b></p>
      <p class="break-word">Source folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?><br>
        <label for="inp_copy_to">Destination folder:</label>
        <?php echo FM_ROOT_PATH ?>/<input name="copy_to" id="inp_copy_to" value="<?php echo fm_enc(FM_PATH) ?>">
      </p>
      <p><label><input type="checkbox" name="move" value="1"> Move</label></p>
      <p>
        <button class="btn"><i class="icon-apply"></i> Copy</button> &nbsp;
        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="icon-cancel"></i> Cancel</a></b>
      </p>
    </form>
  </div>
  <?php
  fm_show_footer();
  exit;
}

// copy form
if (isset($_GET['copy']) && !isset($_GET['finish'])) {
  $copy = $_GET['copy'];
  $copy = fm_clean_path($copy);
  if ($copy == '' || !file_exists(FM_ROOT_PATH . '/' . $copy)) {
    fm_set_msg('File not found', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  fm_show_header(); // HEADER
  fm_show_nav_path(FM_PATH); // current path
  ?>
  <div class="path">
    <p><b>Copying</b></p>
    <p class="break-word">
      Source path: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . $copy)) ?><br>
      Destination folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?>
    </p>
    <p>
      <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1"><i class="icon-apply"></i> Copy</a></b> &nbsp;
      <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1&amp;move=1"><i class="icon-apply"></i> Move</a></b> &nbsp;
      <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="icon-cancel"></i> Cancel</a></b>
    </p>
    <p><i>Select folder:</i></p>
    <ul class="folders break-word">
      <?php
      if ($parent !== false) {
        ?>
        <li><a href="?p=<?php echo urlencode($parent) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="icon-arrow_up"></i> ..</a></li>
      <?php
      }
      foreach ($folders as $f) {
        ?>
        <li><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="icon-folder"></i> <?php echo fm_enc(fm_convert_win($f)) ?></a></li>
      <?php
      }
      ?>
    </ul>
  </div>
  <?php
  fm_show_footer();
  exit;
}

// file viewer
if (isset($_GET['view'])) {
  $file = $_GET['view'];
  $file = fm_clean_path($file);
  $file = str_replace('/', '', $file);
  if ($file == '' || !is_file($path . '/' . $file)) {
    fm_set_msg('File not found', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  fm_show_header(); // HEADER
  fm_show_nav_path(FM_PATH); // current path

  $file_url = FM_ROOT_URL . fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
  $file_path = $path . '/' . $file;

  $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
  $mime_type = fm_get_mime_type($file_path);
  $filesize = filesize($file_path);

  $is_zip = false;
  $is_image = false;
  $is_audio = false;
  $is_video = false;
  $is_text = false;

  $view_title = 'File';
  $filenames = false; // for zip
  $content = ''; // for text

  if ($ext == 'zip') {
    $is_zip = true;
    $view_title = 'Archive';
    $filenames = fm_get_zif_info($file_path);
  } elseif (in_array($ext, fm_get_image_exts())) {
    $is_image = true;
    $view_title = 'Image';
  } elseif (in_array($ext, fm_get_audio_exts())) {
    $is_audio = true;
    $view_title = 'Audio';
  } elseif (in_array($ext, fm_get_video_exts())) {
    $is_video = true;
    $view_title = 'Video';
  } elseif (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
    $is_text = true;
    $content = file_get_contents($file_path);
  }

  ?>
  <div class="path">
    <p class="break-word"><b><?php echo $view_title ?> "<?php echo fm_enc(fm_convert_win($file)) ?>"</b></p>
    <p class="break-word">
      Full path: <?php echo fm_enc(fm_convert_win($file_path)) ?><br>
      File size: <?php echo fm_get_filesize($filesize) ?><?php if ($filesize >= 1000): ?> (<?php echo sprintf('%s bytes', $filesize) ?>)<?php endif; ?><br>
      MIME-type: <?php echo $mime_type ?><br>
      <?php
      // ZIP info
      if ($is_zip && $filenames !== false) {
        $total_files = 0;
        $total_comp = 0;
        $total_uncomp = 0;
        foreach ($filenames as $fn) {
          if (!$fn['folder']) {
            $total_files++;
          }
          $total_comp += $fn['compressed_size'];
          $total_uncomp += $fn['filesize'];
        }
        ?>
        Files in archive: <?php echo $total_files ?><br>
        Total size: <?php echo fm_get_filesize($total_uncomp) ?><br>
        Size in archive: <?php echo fm_get_filesize($total_comp) ?><br>
        Compression: <?php echo round(($total_comp / $total_uncomp) * 100) ?>%<br>
        <?php
      }
      // Image info
      if ($is_image) {
        $image_size = getimagesize($file_path);
        echo 'Image sizes: ' . (isset($image_size[0]) ? $image_size[0] : '0') . ' x ' . (isset($image_size[1]) ? $image_size[1] : '0') . '<br>';
      }
      // Text info
      if ($is_text) {
        $is_utf8 = fm_is_utf8($content);
        if (function_exists('iconv')) {
          if (!$is_utf8) {
            $content = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $content);
          }
        }
        echo 'Charset: ' . ($is_utf8 ? 'utf-8' : '8 bit') . '<br>';
      }
      ?>
    </p>
    <p>
      <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($file) ?>"><i class="icon-download"></i> Download</a></b> &nbsp;
      <b><a href="<?php echo fm_enc($file_url) ?>" target="_blank"><i class="icon-chain"></i> Open</a></b> &nbsp;
      <?php
      // ZIP actions
      if ($is_zip && $filenames !== false) {
        $zip_name = pathinfo($file_path, PATHINFO_FILENAME);
        ?>
        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>"><i class="icon-apply"></i> Unpack</a></b> &nbsp;
        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>&amp;tofolder=1" title="Unpack to <?php echo fm_enc($zip_name) ?>"><i class="icon-apply"></i>
          Unpack to folder</a></b> &nbsp;
        <?php
      }
      ?>
      <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="icon-goback"></i> Back</a></b>
    </p>
    <?php
    if ($is_zip) {
      // ZIP content
      if ($filenames !== false) {
        echo '<code class="maxheight">';
        foreach ($filenames as $fn) {
          if ($fn['folder']) {
            echo '<b>' . fm_enc($fn['name']) . '</b><br>';
          } else {
            echo $fn['name'] . ' (' . fm_get_filesize($fn['filesize']) . ')<br>';
          }
        }
        echo '</code>';
      } else {
        echo '<p>Error while fetching archive info</p>';
      }
    } elseif ($is_image) {
      // Image content
      if (in_array($ext, array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico'))) {
        echo '<p><img src="' . fm_enc($file_url) . '" alt="" class="preview-img"></p>';
      }
    } elseif ($is_audio) {
      // Audio content
      echo '<p><audio src="' . fm_enc($file_url) . '" controls preload="metadata"></audio></p>';
    } elseif ($is_video) {
      // Video content
      echo '<div class="preview-video"><video src="' . fm_enc($file_url) . '" width="640" height="360" controls preload="metadata"></video></div>';
    } elseif ($is_text) {
      if (FM_USE_HIGHLIGHTJS) {
        // highlight
        $hljs_classes = array(
          'shtml' => 'xml',
          'htaccess' => 'apache',
          'phtml' => 'php',
          'lock' => 'json',
          'svg' => 'xml',
        );
        $hljs_class = isset($hljs_classes[$ext]) ? 'lang-' . $hljs_classes[$ext] : 'lang-' . $ext;
        if (empty($ext) || in_array(strtolower($file), fm_get_text_names()) || preg_match('#\.min\.(css|js)$#i', $file)) {
          $hljs_class = 'nohighlight';
        }
        $content = '<pre class="with-hljs"><code class="' . $hljs_class . '">' . fm_enc($content) . '</code></pre>';
      } elseif (in_array($ext, array('php', 'php4', 'php5', 'phtml', 'phps'))) {
        // php highlight
        $content = highlight_string($content, true);
      } else {
        $content = '<pre>' . fm_enc($content) . '</pre>';
      }
      echo $content;
    }
    ?>
  </div>
  <?php
  fm_show_footer();
  exit;
}

// chmod (not for Windows)
if (isset($_GET['chmod']) && !FM_IS_WIN) {
  $file = $_GET['chmod'];
  $file = fm_clean_path($file);
  $file = str_replace('/', '', $file);
  if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
    fm_set_msg('File not found', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  fm_show_header(); // HEADER
  fm_show_nav_path(FM_PATH); // current path

  $file_url = FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file;
  $file_path = $path . '/' . $file;

  $mode = fileperms($path . '/' . $file);

  ?>
  <div class="path">
    <p><b>Change Permissions</b></p>
    <p>
      Full path: <?php echo fm_enc($file_path) ?><br>
    </p>
    <form action="" method="post">
      <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
      <input type="hidden" name="chmod" value="<?php echo fm_enc($file) ?>">

      <table class="compact-table">
        <tr>
          <td></td>
          <td><b>Owner</b></td>
          <td><b>Group</b></td>
          <td><b>Other</b></td>
        </tr>
        <tr>
          <td style="text-align: right"><b>Read</b></td>
          <td><label><input type="checkbox" name="ur" value="1"<?php echo ($mode & 00400) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="gr" value="1"<?php echo ($mode & 00040) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="or" value="1"<?php echo ($mode & 00004) ? ' checked' : '' ?>></label></td>
        </tr>
        <tr>
          <td style="text-align: right"><b>Write</b></td>
          <td><label><input type="checkbox" name="uw" value="1"<?php echo ($mode & 00200) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="gw" value="1"<?php echo ($mode & 00020) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="ow" value="1"<?php echo ($mode & 00002) ? ' checked' : '' ?>></label></td>
        </tr>
        <tr>
          <td style="text-align: right"><b>Execute</b></td>
          <td><label><input type="checkbox" name="ux" value="1"<?php echo ($mode & 00100) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="gx" value="1"<?php echo ($mode & 00010) ? ' checked' : '' ?>></label></td>
          <td><label><input type="checkbox" name="ox" value="1"<?php echo ($mode & 00001) ? ' checked' : '' ?>></label></td>
        </tr>
      </table>

      <p>
        <button class="btn"><i class="icon-apply"></i> Change</button> &nbsp;
        <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="icon-cancel"></i> Cancel</a></b>
      </p>

    </form>

  </div>
  <?php
  fm_show_footer();
  exit;
}