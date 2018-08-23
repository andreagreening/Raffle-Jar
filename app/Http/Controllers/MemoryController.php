<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoryController extends Controller
{
    public function jar()
    {
    	return $this->belongsTo('Jar');
    }

    public function user()
    {
    	return $this->belongsTo('User');
    }
}
