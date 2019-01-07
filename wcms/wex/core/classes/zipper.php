<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 *
 * Class to work with zip files (using ZipArchive)
 */

namespace wcms\classes;

class Zipper
{
  private $zip;

  public function __construct()
  {
    $this->zip = new \ZipArchive;
  }

  /**
   * Create archive with name $filename and files $files (RELATIVE PATHS!)
   * @param string $filename
   * @param array|string $files
   * @return bool
   */
  public function create($filename, $files)
  {
    $res = $this->zip->open($filename, \ZipArchive::CREATE);
    if ($res !== true) {
      return false;
    }
    if (is_array($files)) {
      foreach ($files as $f) {
        if (!$this->addFileOrDir($f)) {
          $this->zip->close();
          return false;
        }
      }
      $this->zip->close();
      return true;
    } else {
      if ($this->addFileOrDir($files)) {
        $this->zip->close();
        return true;
      }
      return false;
    }
  }

  /**
   * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
   * @param string $filename
   * @param string $path
   * @return bool
   */
  public function unzip($filename, $path)
  {
    $res = $this->zip->open($filename);
    if ($res !== true) {
      return false;
    }
    if ($this->zip->extractTo($path)) {
      $this->zip->close();
      return true;
    }
    return false;
  }

  /**
   * Add file/folder to archive
   * @param string $filename
   * @return bool
   */
  private function addFileOrDir($filename)
  {
    if (is_file($filename)) {
      return $this->zip->addFile($filename);
    } elseif (is_dir($filename)) {
      return $this->addDir($filename);
    }
    return false;
  }

  /**
   * Add folder recursively
   * @param string $path
   * @return bool
   */
  private function addDir($path)
  {
    if (!$this->zip->addEmptyDir($path)) {
      return false;
    }
    $objects = scandir($path);
    if (is_array($objects)) {
      foreach ($objects as $file) {
        if ($file != '.' && $file != '..') {
          if (is_dir($path . '/' . $file)) {
            if (!$this->addDir($path . '/' . $file)) {
              return false;
            }
          } elseif (is_file($path . '/' . $file)) {
            if (!$this->zip->addFile($path . '/' . $file)) {
              return false;
            }
          }
        }
      }
      return true;
    }
    return false;
  }
}