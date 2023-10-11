<?php

namespace App\Managers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class FileManager {

    public function __construct() {}

    public function uploadFile(string $path, $file) {
        
        if($file) {
            
            $file_path = $path;
            
            if (Storage::disk('public')->put($file_path, file_get_contents($file))) {
                return $file_path;
            }

            return false;
            
        }

        return false;
    }

}