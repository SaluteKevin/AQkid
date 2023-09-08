<?php

namespace App\Services;

use App\Managers\UserManager;


class UserService {


    private static $instance = null;


    private function __construct() {}


    /* Singleton Service */
    public static function getUserManager() {

      if (self::$instance == null)
      {
        self::$instance = new UserManager();
      }

      return self::$instance;
    }


}