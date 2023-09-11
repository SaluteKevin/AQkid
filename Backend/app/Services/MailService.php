<?php

namespace App\Services;

use App\Managers\MailManager;


class MailService {


    private static $instance = null;


    private function __construct() {}


    /* Singleton Service */
    public static function getMailManager() {

      if (self::$instance == null)
      {
        self::$instance = new MailManager();
      }

      return self::$instance;
    }


}