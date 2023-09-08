<?php

namespace App\Services;

use App\Managers\NotifyManager;


class NotifyService {


    private static $instance = null;


    private function __construct() {}
   

    /* Singleton Service */
    public static function getNotifyManager() {
      
      if (self::$instance == null)
      {
        self::$instance = new NotifyManager();
      }
   
      return self::$instance;
    }


}