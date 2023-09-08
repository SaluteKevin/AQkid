<?php

namespace App\Managers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class FileManager {

    public function __construct() {}

    public function uploadFile(string $path, $file) {
        
        if($file) {
            $file_name = Carbon::now() . $file->getClientOriginalName();
            $file_path = $path . $file_name;
            
            if (Storage::disk('public')->put($file_path, file_get_contents($file))) {
                return array(
                    'name' => $file_name,
                    'file_path' => $file_path,
                );
            }

            return false;
            
        }

        return false;
    }

}