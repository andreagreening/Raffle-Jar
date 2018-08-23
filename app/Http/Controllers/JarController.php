<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jar;
use User;
use Auth;
use Ticket;
use Prize;
use Log;

class JarController extends Controller
{
   public function newRaffle(Request $request)
   {
   		$request->validate([
   			'description' => 'required|max:255'
   			]);

   		$jar = new Jar;
   		$jar->user_id = Auth::user()->id;
   		$jar->jar_type = 1;
   		$jar->description = $request->description;
   		$jar->save();

   		return redirect(route('jar.view', $jar));
            // ->with('jar', $jar);
   			// ->with('success', 'Your new Raffle Jar has been created!')
   }

   public function view(Jar $jar)
   {
      if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };


      if(!Auth::user()->isOwner($jar->id)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
            return redirect('home')
            ->with('warning', 'You do not own that jar.');   
         }

         //Sorts by putting null ticket ID first to ensure the undrawn prizes display first. Not Ideal. 
         $sortedPrizes = Prize::where('jar_id', $jar->id)->where('ticket_id', NULL)->get();

         $winners = $jar->winners()->get();
         
         // If there are no winners, start with an empty collection
         $winnersByName = array();
         if(!$winners->isEmpty()){
            $winnersByName = $winners->groupBy('name');
            // dd($winnersByName);
         }

    //      $grouped = $collection->mapToGroups(function ($item, $key) {
    // return [$item['department'] => $item['name']];

         // $winnersByName = $winners->mapToGroups(function($item, $key){
         //    return [$item[
         //    'name'] => $item['id']];
         // });
         // dd($winnersByName);
         // Find tickets by ids

         return view('jars.overview')
         ->with('jar', $jar)
         ->with('sortedPrizes', $sortedPrizes)
         ->with('winnersByName', $winnersByName);
   }

   public function drawRaffle(Jar $jar)
   {
      if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };

       
      if(!Auth::user()->isOwner($jar->id)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
            // TODO:Log this event.
         }

      if($jar->tickets->isEmpty()){
         return redirect(route('jar.view', $jar))
         ->with('warning', 'Cannot draw a winner. There are no tickets in this raffle.');
      }

      $prizeCount = $jar->prizes->where('ticket_id', NULL)->count();
      $winners = $jar->tickets->where('winner', '!=', 1)->shuffle()->take($prizeCount);

      foreach($winners as $winner)
      {
         $prize = $jar->prizes->where('ticket_id', NULL)->first();
         $winnerId = $winner->id;
         $prizeId = $prize->id;
         $winner->prize_id = $prizeId;
         $winner->winner = 1;
         $winner->save();
         $prize->ticket_id = $winnerId;
         $prize->save();
      }

      return redirect(route('jar.view', $jar))
      ->with('success', 'Congratulations! The winners have been drawn!');
      
      // count number of prizes
      // draw tickets, must not be a winner already
      // add the prize id to the ticket
      // add the ticket id to the prize
      // mark all winning tickets as winner
   }

   public function drawPrize(Prize $prize){
      if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };

        $jarId = $prize->jar_id;

      if(!Auth::user()->isOwner($jarId)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
         }

       $jar = Jar::find($jarId);  

      if($jar->tickets->isEmpty()){
         return redirect(route('jar.view', $jar))
         ->with('warning', 'Cannot draw a winner. There are no tickets in this raffle.');
      }

      if($prize->ticket_id != NULL){
         return redirect(route('jar.view', $jarId))
         ->with('warning', 'A winner has already been selected for that prize.');
         }

      $winnerWinner = $prize->jar->tickets->where('winner', '!=', 1)->shuffle()->take(1);
      foreach($winnerWinner as $winner){
         $winnerId = $winner->id;
         $prizeId = $prize->id;
         $winner->prize_id = $prizeId;
         $winner->winner = 1;
         $winner->save();
         $prize->ticket_id = $winnerId;
         $prize->save();
      }

      return redirect(route('jar.view', $jarId))
         ->with('success', 'A winner has been selected for that prize!');
   }

   public function confirm(Jar $jar){
      if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };

      if(!Auth::user()->isOwner($jar->id)){
         Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
         return redirect('home')
            ->with('warning', 'You do not own that jar.');
         }

      return view('jars.confirmArchive')
      ->with('jar', $jar);
   }

   public function delete(Jar $jar){
      if(!Auth::check()){
         return redirect('home')
            ->with('warning', 'You must be logged in to do that.');
      };

      if(!Auth::user()->isOwner($jar->id)){
            Log::notice('User ' .Auth::user()->id .'is attempting to access a jar that does not belong to them.');
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
         }

      if(!$jar->tickets->isEmpty()){
         foreach($jar->tickets as $ticket)
         {
            $ticket->delete();
         }
      }

      if(!$jar->prizes->isEmpty()){
         foreach($jar->prizes as $prize)
                  {
                     $prize->delete();
                  }     
       }
      
      $jar->delete();
      
      return redirect(route('home'))
      ->with('success', 'That contest has been archived.');
   }






























}
