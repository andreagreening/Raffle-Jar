<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jar;
use Auth;
use Prize;
use Log;

class PrizeController extends Controller
{
    public function create(Jar $jar)
    {
    	if(!Auth::check()){
    		return redirect('home')
    			->with('warning', 'You must be logged in to do that.');
    	};

        $jarId = $jar->id;
    	if(!Auth::user()->isOwner($jarId)){
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
            // TODO:Log this event.
        	}
    	return view('prizes.create')
    	->with('jar', $jar);
    }

    public function store(Request $request, Jar $jar)
    {
    	if(!Auth::check()){
    		return redirect('home')
    			->with('warning', 'You must be logged in to do that.');
    	};

        $jarId = $jar->id;
    	if(!Auth::user()->isOwner($jarId)){
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
            // TODO:Log this event.
        }

        $request->validate([
        	'description' => 'required|max:500',
        	'donor' => 'max:255',
        	]);

        $prize = new Prize;
        $prize->jar_id = $jar->id;
        $prize->description = $request->description;
        $prize->donor = $request->donor;
        $prize->save();

        return redirect(route('prize.create', $jar))
        ->with('success', 'The prize has been added to the raffle.');
    }

    public function edit(Prize $prize)
    {
        if(!Auth::check()){
            return redirect('home')
                ->with('warning', 'You must be logged in to do that.');
        };
        
        $jar = $prize->jar;

        $jarId = $jar->id;
        if(!Auth::user()->isOwner($jarId)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');

            return redirect('home')
            ->with('warning', 'You do not own that jar.');
        }
        return view('prizes.edit')
        ->with('prize', $prize);
    }

    public function update(Request $request, Prize $prize)
    {
            if(!Auth::check()){
            return redirect('home')
                ->with('warning', 'You must be logged in to do that.');
        };
        

        $jar = $prize->jar;

        $jarId = $jar->id;
        if(!Auth::user()->isOwner($jarId)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');

            return redirect('home')
            ->with('warning', 'You do not own that jar.');
        }

        $request->validate([
            'description' => 'required|max:500',
            'donor' => 'max:255',
            ]);

        $prize->jar_id = $jar->id;
        $prize->description = $request->description;
        $prize->donor = $request->donor;
        $prize->save();

        return redirect(route('jar.view', $jar))
        ->with('success', 'The prize has been updated.');
    }

    public function confirm(Prize $prize) {
        if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };
      $jar = $prize->jar;

      if(!Auth::user()->isOwner($jar->id)){
         Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
         return redirect('home')
            ->with('warning', 'You do not own that jar.');
         }

      return view('prizes.confirmDelete')
      ->with('prize', $prize);
    }

    public function delete(Prize $prize){
        if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };
      $jar = $prize->jar;

      if(!Auth::user()->isOwner($jar->id)){
         Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
         return redirect('home')
            ->with('warning', 'You do not own that jar.');
         }
         
         if($prize->ticket_id == NULL){
            $prize->delete();
         } 
         else{
            return redirect(route('jar.view', $prize->jar))
            ->with('warning', 'You cannot delete this prize, a winner has already been selected.');
         }

         return redirect(route('jar.view', $prize->jar))
         ->with('success', 'That prize has been deleted.');
    }












}
