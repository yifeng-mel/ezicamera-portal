<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use phpseclib\Crypt\RSA;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * $data byte array json
     * @return array|string
     */
    public function decryptData($camera_private_key_encrypted_data_byte_array_json, $camera_uid)
    {
        $camera_private_key_encrypted_data_byte_array = json_decode($camera_private_key_encrypted_data_byte_array_json, true);
        $camera_private_key_encrypted_data = pack("C*", ...$camera_private_key_encrypted_data_byte_array);
      
        $rsa = new RSA();
        $camera = \DB::table('cameras')->where('uid',$camera_uid)->first();
        if (!$camera) { dd('camera uid not found'); }
        
        $camera_public_key = $camera->public_key;
        $cloud_private_key = file_get_contents('/cloud_id_rsa');
        // authenticating user
        $rsa->loadKey($camera_public_key);
        try {
            $cloud_public_key_encrypted_data_byte_array_json = $rsa->decrypt($camera_private_key_encrypted_data);
            $cloud_public_key_encrypted_data_byte_array = json_decode($cloud_public_key_encrypted_data_byte_array_json, true);
        
            $cloud_public_key_encrypted_data = pack("C*", ...$cloud_public_key_encrypted_data_byte_array);
            $rsa->loadKey($cloud_private_key);
        
            try {
                $data = $rsa->decrypt($cloud_public_key_encrypted_data);
                $data = json_decode($data, true);
                return $data;
            } catch(\Exception $e) {
                dd('wrong cloud private key');
            }
        } catch(\Exception $e) {
            dd('unauthorized');
        }           
    }
}
