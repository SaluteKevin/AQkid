<?php

namespace App\Services;

use App\Managers\FileManager;


class FileService {


    private static $instance = null;


    private function __construct() {}
   

    /* Singleton Service */
    public static function getFileManager() {
      
      if (self::$instance == null)
      {
        self::$instance = new FileManager();
      }
   
      return self::$instance;
    }


}