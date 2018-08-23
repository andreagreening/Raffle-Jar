<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function jar()
    {
    	return $this->belongsTo('Jar');
    }
}
