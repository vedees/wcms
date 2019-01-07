
<?php

/*************************** ACTIONS ***************************/

// Delete file / folder
if (isset($_GET['del'])) {
  $del = $_GET['del'];
  $del = fm_clean_path($del);
  $del = str_replace('/', '', $del);
  if ($del != '' && $del != '..' && $del != '.') {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
      $path .= '/' . FM_PATH;
    }
    $is_dir = is_dir($path . '/' . $del);
    if (fm_rdelete($path . '/' . $del)) {
      $msg = $is_dir ? 'Folder <b>%s</b> deleted' : 'File <b>%s</b> deleted';
      fm_set_msg(sprintf($msg, fm_enc($del)));
    } else {
      $msg = $is_dir ? 'Folder <b>%s</b> not deleted' : 'File <b>%s</b> not deleted';
      fm_set_msg(sprintf($msg, fm_enc($del)), 'error');
    }
  } else {
    fm_set_msg('Wrong file or folder name', 'error');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Create folder
if (isset($_GET['new'])) {
  $new = strip_tags($_GET['new']); // remove unwanted characters from folder name
  $new = fm_clean_path($new);
  $new = str_replace('/', '', $new);
  if ($new != '' && $new != '..' && $new != '.') {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
      $path .= '/' . FM_PATH;
    }
    if (fm_mkdir($path . '/' . $new, false) === true) {
      fm_set_msg(sprintf('Folder <b>%s</b> created', fm_enc($new)));
    } elseif (fm_mkdir($path . '/' . $new, false) === $path . '/' . $new) {
      fm_set_msg(sprintf('Folder <b>%s</b> already exists', fm_enc($new)), 'alert');
    } else {
      fm_set_msg(sprintf('Folder <b>%s</b> not created', fm_enc($new)), 'error');
    }
  } else {
    fm_set_msg('Wrong folder name', 'error');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Copy folder / file
if (isset($_GET['copy'], $_GET['finish'])) {
  // from
  $copy = $_GET['copy'];
  $copy = fm_clean_path($copy);
  // empty path
  if ($copy == '') {
    fm_set_msg('Source path not defined', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }
  // abs path from
  $from = FM_ROOT_PATH . '/' . $copy;
  // abs path to
  $dest = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $dest .= '/' . FM_PATH;
  }
  $dest .= '/' . basename($from);
  // move?
  $move = isset($_GET['move']);
  // copy/move
  if ($from != $dest) {
    $msg_from = trim(FM_PATH . '/' . basename($from), '/');
    if ($move) {
      $rename = fm_rename($from, $dest);
      if ($rename) {
        fm_set_msg(sprintf('Moved from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
      } elseif ($rename === null) {
        fm_set_msg('File or folder with this path already exists', 'alert');
      } else {
        fm_set_msg(sprintf('Error while moving from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
      }
    } else {
      if (fm_rcopy($from, $dest)) {
        fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
      } else {
        fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
      }
    }
  } else {
    fm_set_msg('Paths must be not equal', 'alert');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Mass copy files/ folders
if (isset($_POST['file'], $_POST['copy_to'], $_POST['finish'])) {
  // from
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }
  // to
  $copy_to_path = FM_ROOT_PATH;
  $copy_to = fm_clean_path($_POST['copy_to']);
  if ($copy_to != '') {
    $copy_to_path .= '/' . $copy_to;
  }
  if ($path == $copy_to_path) {
    fm_set_msg('Paths must be not equal', 'alert');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }
  if (!is_dir($copy_to_path)) {
    if (!fm_mkdir($copy_to_path, true)) {
      fm_set_msg('Unable to create destination folder', 'error');
      fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
  }
  // move?
  $move = isset($_POST['move']);
  // copy/move
  $errors = 0;
  $files = $_POST['file'];
  if (is_array($files) && count($files)) {
    foreach ($files as $f) {
      if ($f != '') {
        // abs path from
        $from = $path . '/' . $f;
        // abs path to
        $dest = $copy_to_path . '/' . $f;
        // do
        if ($move) {
          $rename = fm_rename($from, $dest);
          if ($rename === false) {
            $errors++;
          }
        } else {
          if (!fm_rcopy($from, $dest)) {
            $errors++;
          }
        }
      }
    }
    if ($errors == 0) {
      $msg = $move ? 'Selected files and folders moved' : 'Selected files and folders copied';
      fm_set_msg($msg);
    } else {
      $msg = $move ? 'Error while moving items' : 'Error while copying items';
      fm_set_msg($msg, 'error');
    }
  } else {
    fm_set_msg('Nothing selected', 'alert');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Rename
if (isset($_GET['ren'], $_GET['to'])) {
  // old name
  $old = $_GET['ren'];
  $old = fm_clean_path($old);
  $old = str_replace('/', '', $old);
  // new name
  $new = $_GET['to'];
  $new = fm_clean_path($new);
  $new = str_replace('/', '', $new);
  // path
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }
  // rename
  if ($old != '' && $new != '') {
    if (fm_rename($path . '/' . $old, $path . '/' . $new)) {
      fm_set_msg(sprintf('Renamed from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)));
    } else {
      fm_set_msg(sprintf('Error while renaming from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)), 'error');
    }
  } else {
    fm_set_msg('Names not set', 'error');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Download
if (isset($_GET['dl'])) {
  $dl = $_GET['dl'];
  $dl = fm_clean_path($dl);
  $dl = str_replace('/', '', $dl);
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }
  if ($dl != '' && is_file($path . '/' . $dl)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($path . '/' . $dl) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path . '/' . $dl));
    readfile($path . '/' . $dl);
    exit;
  } else {
    fm_set_msg('File not found', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }
}

// Upload
if (isset($_POST['upl'])) {
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }

  $errors = 0;
  $uploads = 0;
  $total = count($_FILES['upload']['name']);

  for ($i = 0; $i < $total; $i++) {
    $tmp_name = $_FILES['upload']['tmp_name'][$i];
    if (empty($_FILES['upload']['error'][$i]) && !empty($tmp_name) && $tmp_name != 'none') {
      if (move_uploaded_file($tmp_name, $path . '/' . $_FILES['upload']['name'][$i])) {
        $uploads++;
      } else {
        $errors++;
      }
    }
  }

  if ($errors == 0 && $uploads > 0) {
    fm_set_msg(sprintf('All files uploaded to <b>%s</b>', fm_enc($path)));
  } elseif ($errors == 0 && $uploads == 0) {
    fm_set_msg('Nothing uploaded', 'alert');
  } else {
    fm_set_msg(sprintf('Error while uploading files. Uploaded files: %s', $uploads), 'error');
  }

  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Mass deleting
if (isset($_POST['group'], $_POST['delete'])) {
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }

  $errors = 0;
  $files = $_POST['file'];
  if (is_array($files) && count($files)) {
    foreach ($files as $f) {
      if ($f != '') {
        $new_path = $path . '/' . $f;
        if (!fm_rdelete($new_path)) {
          $errors++;
        }
      }
    }
    if ($errors == 0) {
      fm_set_msg('Selected files and folder deleted');
    } else {
      fm_set_msg('Error while deleting items', 'error');
    }
  } else {
    fm_set_msg('Nothing selected', 'alert');
  }

  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Pack files
if (isset($_POST['group'], $_POST['zip'])) {
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }

  if (!class_exists('ZipArchive')) {
    fm_set_msg('Operations with archives are not available', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  $files = $_POST['file'];
  if (!empty($files)) {
    chdir($path);

    if (count($files) == 1) {
      $one_file = reset($files);
      $one_file = basename($one_file);
      $zipname = $one_file . '_' . date('ymd_His') . '.zip';
    } else {
      $zipname = 'archive_' . date('ymd_His') . '.zip';
    }

    $zipper = new wcms\classes\Zipper();
    $res = $zipper->create($zipname, $files);

    if ($res) {
      fm_set_msg(sprintf('Archive <b>%s</b> created', fm_enc($zipname)));
    } else {
      fm_set_msg('Archive not created', 'error');
    }
  } else {
    fm_set_msg('Nothing selected', 'alert');
  }

  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Unpack
if (isset($_GET['unzip'])) {
  $unzip = $_GET['unzip'];
  $unzip = fm_clean_path($unzip);
  $unzip = str_replace('/', '', $unzip);

  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }

  if (!class_exists('ZipArchive')) {
    fm_set_msg('Operations with archives are not available', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  if ($unzip != '' && is_file($path . '/' . $unzip)) {
    $zip_path = $path . '/' . $unzip;

    //to folder
    $tofolder = '';
    if (isset($_GET['tofolder'])) {
      $tofolder = pathinfo($zip_path, PATHINFO_FILENAME);
      if (fm_mkdir($path . '/' . $tofolder, true)) {
        $path .= '/' . $tofolder;
      }
    }

    $zipper = new wcms\classes\Zipper();
    $res = $zipper->unzip($zip_path, $path);

    if ($res) {
      fm_set_msg('Archive unpacked');
    } else {
      fm_set_msg('Archive not unpacked', 'error');
    }

  } else {
    fm_set_msg('File not found', 'error');
  }
  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Change Perms (not for Windows)
if (isset($_POST['chmod']) && !FM_IS_WIN) {
  $path = FM_ROOT_PATH;
  if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
  }

  $file = $_POST['chmod'];
  $file = fm_clean_path($file);
  $file = str_replace('/', '', $file);
  if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
    fm_set_msg('File not found', 'error');
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
  }

  $mode = 0;
  if (!empty($_POST['ur'])) {
    $mode |= 0400;
  }
  if (!empty($_POST['uw'])) {
    $mode |= 0200;
  }
  if (!empty($_POST['ux'])) {
    $mode |= 0100;
  }
  if (!empty($_POST['gr'])) {
    $mode |= 0040;
  }
  if (!empty($_POST['gw'])) {
    $mode |= 0020;
  }
  if (!empty($_POST['gx'])) {
    $mode |= 0010;
  }
  if (!empty($_POST['or'])) {
    $mode |= 0004;
  }
  if (!empty($_POST['ow'])) {
    $mode |= 0002;
  }
  if (!empty($_POST['ox'])) {
    $mode |= 0001;
  }

  if (@chmod($path . '/' . $file, $mode)) {
    fm_set_msg('Permissions changed');
  } else {
    fm_set_msg('Permissions not changed', 'error');
  }

  fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

/*************************** /ACTIONS ***************************/