<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes;

use wcms\classes\Zipper;

class Backup {

  public function create () {
    //TODO glob + rm to finder
    $root_path = SITE_DIR;

    // Pack files
    if (isset($_POST['backup_create'])) {
      $path = $root_path;
      // ZipArchive not found
      if (!class_exists('ZipArchive')) {
        //TODO glob vue alert
        echo 'Operations with archives are not available';
        // redirect_to('index.php')
      }

      // Search all files/folder. array_diff - Fixed array '..' + '.'
      $files = array_diff(scandir($path), array('..', '.'));
      // Check folder error
      if (!empty($files)) {
        chdir($root_path);

        //TODO fix same name
        $zipname = BACKUP_DIR . date('d-m-Y_H:i:s') . '.zip';

        $zipper = new Zipper();
        $res = $zipper->create($zipname, $files);

        if ($res) {
          // echo 'Backup created! <br> In: ' . $zipname;
          echo 'Backup created!';
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
