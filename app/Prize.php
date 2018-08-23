<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Prize extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function ticket()
    {
    	return $this->belongsTo('Ticket');
    }

    public function jar()
    {
    	return $this->belongsTo('Jar');
    }

    public function getIconColor()
    {
    	$ticketStatusId = $this->ticket->status_id;

    	$color = ""; 
    	switch($ticketStatusId){
    		 case ($ticketStatusId == 1):
            $color = '#FF9702'; 
            break;
            case ($ticketStatusId == 2):
            $color = '#FDD32B'; 
            break;
            case ($ticketStatusId == 3):
            $color = '#46BFB0'; 
            break;
            case ($ticketStatusId == 4):
            $color = '#99CCCC'; 
            break;
            case ($ticketStatusId == 5):
            $color = '#044AEA';
            break;
            default: $color = '#7f7f7f';
    	};

    	return $color;

    }

}
