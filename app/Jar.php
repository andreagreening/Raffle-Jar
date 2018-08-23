<?php

namespace App;

use Jar;
use Memory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jar extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function tickets()
    {
    	return $this->hasMany('Ticket');
    }

    public function prizes()
    {
    	return $this->hasMany('Prize');
    }

    public function memories()
    {
    	return $this->hasMany('Memory');
    }

    public function winners()
    {
        return $this->tickets()->where('winner','=', '1');
    }

    public function drawingComplete()
    {
        if ($this->prizes->where('ticket_id', NULL)->isEmpty()) return true;
    }

    






















    
}
