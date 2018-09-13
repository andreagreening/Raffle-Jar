<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

class Hit extends Model
{
    public static function log()
    {
    	$ip = Request::ip();
    	if($ip == env('MY_IP_ADDRESS')) return;
    	$hit = New Hit;
    	$hit->ip = $ip;
    	$hit->user_agent = implode(Request::header()['user-agent']);
    	$hit->page = Request::url();
    	$hit->save();
    }
}
