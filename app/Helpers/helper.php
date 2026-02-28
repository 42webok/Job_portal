<?php
use Illuminate\Support\Facades\Crypt;

if (!function_exists('encryptId')) {
    function encryptId($id){
        $id = Crypt::encryptString($id);
        return $id;
    }
}

if (!function_exists('dcrypttId')) {
    function dcrypttId($id){
      try {
            return Crypt::decryptString($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404); // invalid or tampered payload
        }
    }
}

