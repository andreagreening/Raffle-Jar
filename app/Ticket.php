<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
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

    public function jar()
    {
    	return $this->belongsTo('Jar');
    }

    public function prize()
    {
    	return $this->hasOne('Prize');
    }

    public function getStatusIcon()
    {
        $ticketStatusId = $this->status_id;

        $statusIcon = ""; 
        switch(true){
             case ($ticketStatusId == 1):
            $statusIcon = '<i class="fa fa-2x fa-phone" style="color:#75db30"></i>'; 
            break;
            case ($ticketStatusId == 2):
            $statusIcon = '<i class="fa fa-2x fa-phone" style="color:#a4e4e4"></i>'; 
            break;
            case ($ticketStatusId == 3):
            $statusIcon = '<i class="fa fa-2x fa-envelope-open" style="color:#3ee2a9"></i>'; 
            break;
            case ($ticketStatusId == 4):
            $statusIcon = '<i class="fa fa-2x fa-envelope" style="color:#99c4e8"></i>'; 
            break;
            case ($ticketStatusId == 5):
            $statusIcon = '<i class="fa fa-3x fa-gift" style="color:#29427b"></i>';
            break;
            case ($ticketStatusId === NULL):
            $statusIcon = '<i class="fa fa-2x fa-ticket" style="color:#a19477"></i>';
            break;
            default: $statusIcon = '<i class="fa fa-2x fa-ticket" style="color:#a19477"></i>';
        };

        return $statusIcon;
    }





}
