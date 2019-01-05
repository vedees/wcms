<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Backup {

  public function create () {
    //TODO glob + rm to finder
    $root_path = $_SERVER['DOCUMENT_ROOT'];
    //TODO FIX abs path
    $wex_path = dirname(dirname(dirname(__FILE__)));
    define('DS', '/');
    define('WEX_ROOT', str_replace(DIRECTORY_SEPARATOR, DS, getcwd()));


    // Pack files
    if (isset($_POST['backup_create'])) {
      $path = $root_path;

      // ZipArchive not found
      if (!class_exists('ZipArchive')) {
        //TODO glob vue alert
        echo 'Operations with archives are not available';
        // redirect_to('index.php')
      }
      // Search all files/folder. Fix array .. .
      $files = array_diff(scandir($path), array('..', '.'));
      if (!empty($files)) {
        chdir($root_path);

        // 1 folder (feature)
        if (count($files) == 1) {
          $one_file = reset($files);
          $one_file = basename($one_file);
          $zipname = $one_file . '_' . date('ymd_His') . '.zip';
        // > 1 folder
        } else {
          //TODO fix same name
          $zipname = WEX_ROOT . '/backups/bacup' . '_' . date('d-m-Y_His') . '.zip';
        }

        $zipper = new FM_Zipper();
        $res = $zipper->create($zipname, $files);

        if ($res) {
          echo 'Backup created! ' . $zipname;
        } else {
          echo 'Archive not created';
        }
      // 0 files/folder
      } else {
        echo 'Empty Files & Folder';
      }
      // secuess redirect
    }
  }
}
