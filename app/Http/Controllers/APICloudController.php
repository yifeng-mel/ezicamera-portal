<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetLinkMarkdown;
use phpseclib\Crypt\RSA;
use DB;
use App\Camera;

class APICloudController extends Controller
{
    public function postPasswordResetLink()
    {
        $camera_uid = request()->get('camera_uid');
        $encrypted_data_str_byte_array_json = request()->get('data');
        $encrypted_data_str_byte_array = json_decode($encrypted_data_str_byte_array_json, true);
        $encrypted_data_str = pack("C*", ...$encrypted_data_str_byte_array);
      
        $rsa = new RSA();
        $camera = \DB::table('cameras')->where('uid',$camera_uid)->first();
        if (!$camera) { dd('camera uid not found'); }
        $camera_public_key = $camera->public_key;
        $cloud_private_key = file_get_contents('/cloud_id_rsa');
        // authenticating user
        $rsa->loadKey($camera_public_key);
        try {
            $data_str = $rsa->decrypt($encrypted_data_str);
            $data = json_decode($data_str, true);
        
            // decrypt link
            $encrypted_link_byte_array_json = $data['encrypted_link'];
            $encrypted_link_byte_array = json_decode($encrypted_link_byte_array_json, true);
            $encrypted_link = pack("C*", ...$encrypted_link_byte_array);
            $rsa->loadKey($cloud_private_key);
        
            try {
                $link = $rsa->decrypt($encrypted_link);
                $user_name = $data['user_name'] ?? null;
                $email_address = $data['email_address'] ?? null;
                if (!$email_address) { dd('emaill address is null'); }
        
                // check how many reset password email sent for this camera for last 15 minutes 
                $c_timestamp = time();
                $valid_timestamp = $c_timestamp - 15 * 60;
                $reset_email_sent_count = \DB::table('sent_camera_emails')->where('camera_id', $camera->id)->where('timestamp','>',$valid_timestamp)->count();
                if ($reset_email_sent_count > 3) dd('too many requests');
                Mail::to($email_address)->send(new PasswordResetLinkMarkdown($user_name, $link));
                \DB::table('sent_camera_emails')->insert(['camera_id'=>$camera->id, 'timestamp'=>time()]);
                return json_encode(['success'=>true]);
            } catch(\Exception $e) {
                dd('wrong cloud private key');
            }
        } catch(\Exception $e) {
            dd('unauthorized');
        }           
    }

    public function postSetUserInfo()
    {
        $camera_uid = request()->get('camera_uid');
        $encrypted_data = request()->get('data');
        $data = $this->decryptData($encrypted_data, $camera_uid);
        $camera = Camera::where('uid', $camera_uid)->first();
        $camera->user_email = $data['email'];
        $camera->user_date_of_birth = $data['date_of_birth'];
        $camera->save();
        return json_encode(['success'=>true]);
    }
}
