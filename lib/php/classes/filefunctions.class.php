<?php

class FileFunctions {

  private static $logFile = "output.log";

  static function requirePHPFiles ($dir) {
    if (!file_exists($dir)) {
      return false;
    }

    $files = scandir($dir);
    foreach ($files as $file) {
      if (FileFunctions::hasExtension($file, 'php')) {
        if (substr($file,0,9)=='noinclude') {
          continue;
        } else {
          require_once($dir.$file);
        }
      }
    }
  }

  static function requirePHPFilesRecursive ($rootDir) {
    $files = scandir($rootDir);
    foreach ($files as $file) {
        if (is_file($file) && FileFunctions::hasExtension($file, 'php')) {
          echo pathinfo($file)['extension'].' is a file';
            require_once $rootDir.$file;
        }
        if (is_dir($file)) {
          FileFunctions::requirePHPFilesRecursive ($file);
        }
    }
  }

  // INPUT: parent directory inclusive trailing "/"
  static function getSubFolders ($rootDir) {
    $subFolders = array();
    $dirs = scandir($rootDir);
    foreach ($dirs as $dir) {
      if ($dir=="." || $dir=="..") {
        continue;
      }
      if (is_dir($rootDir.$dir)) {
        $subFolders[] = $dir;
      }
    }
    return $subFolders;
  }

  static function getFiles ($dir, $extension) {
    $matchingFiles = array();
    $files = scandir($dir);
    foreach ($files as $file) {
      if (FileFunctions::hasExtension($file, $extension)) {
        $matchingFiles[] = $file;
      }
    }
    return $matchingFiles;
  }

  static function getCurrentPage () {
    $queryString = $_SERVER['REDIRECT_QUERY_STRING']; // format page=admin/modifylessontutorial&id=1 or page=admin/modifylessontutorial
    $processed = explode('&', $queryString);
    $processed = explode('=', $processed[0]);
    return (isset($processed[1]) && !empty($processed[1])) ? $processed[1] : 'home';
  }

  static function log ($text) {
    FileFunctions::logToFile(FileFunctions::$logFile, $text);
  }

  static function getFileName ($file) {
    $pathInfo = FileFunctions::getPathInfo ($file);
    if (isset($pathInfo['filename'])) {
      return $pathInfo['filename'];
    } else {
      return null;
    }
    //return substr($fileName, strrpos($fileName , '.')+1);
  }

  static function getExtension ($file) {
    $pathInfo = FileFunctions::getPathInfo ($file);
    if (isset($pathInfo['extension'])) {
      return $pathInfo['extension'];
    } else {
      return null;
    }
    //return substr($fileName, strrpos($fileName , '.')+1);
  }

  protected static function logToFile ($file, $text) {
    $text = date("Y-m-d H:i:s").' > '.$text."\r\n";
    file_put_contents($file, $text, FILE_APPEND);
  }

  protected static function getPathInfo ($file) {
    return pathInfo($file);
  }

  protected static function hasExtension ($file, $checkedExtension) {
    $extension = FileFunctions::getExtension($file);
    if (is_null($extension)) {
      return false;
    }
    return $extension==$checkedExtension;
  }

}



?>
