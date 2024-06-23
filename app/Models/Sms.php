<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    public static function sendSms($message,$mobile)
    {
                /*Code for SMS Script Starts*/
            $request ="";
            $param['authorization']="AAED2-350A8";
            $param['sender_id'] = 'HELLOINDIA';
            $param['message']= '$message';
            $param['numbers']= '$mobile';
            $param['language']="english";
            $param['route']="p";

            foreach($param as $key=>$val) {
                $request.= $key."=".urlencode($val);
                $request.= "&";
        }
            $request = substr($request, 0, strlen($request)-1);

            $url ="http://tagsolutions.in/sms-panel/api/http/index.php?".$request;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            /*Code for SMS Script Ends*/
    }
}
