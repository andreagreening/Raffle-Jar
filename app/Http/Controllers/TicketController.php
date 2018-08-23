<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jar;
use Ticket;
use Auth;


class TicketController extends Controller
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

    	return view('jars.overview')
    		->with('jar', $jar);
    	// }
    }

    public function store(Request $request, Jar $jar){
    	if(!Auth::check()){
            return redirect('home')
                ->with('warning', 'You must be logged in to do that.');
        };

         $jarId = $jar->id;
        if(!Auth::user()->isOwner($jarId)){
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'phoneNumber' => 'required',
            'email' => 'email',

            ]);

        
            for ($i=0; $i < $request->quantity; $i++) { 
                $ticket = new Ticket;
                $ticket->user_id = Auth::user()->id;
                $ticket->jar_id = $jar->id;
                $ticket->name = $request->name;
                $ticket->phone = $request->phoneNumber;
                $ticket->email = $request->email;
                $ticket->save();
            }

            return redirect(route('jar.view', $jar))
            ->with('success', 'Your ticket(s) have been entered into the raffle!');

    }

    public function update(Request $request, Ticket $ticket){

                if(!Auth::check()){
            return redirect('home')
                ->with('warning', 'You must be logged in to do that.');
        };

         $jarId = $ticket->jar_id;

        if(!Auth::user()->isOwner($jarId)){
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
        }

        if(!$ticket->user_id == Auth::user()->id){
            return redirect('home')
            ->with('warning', 'That ticket is unavailable.');
        }

        //  $request->validate([
        //     'name' => 'required|max:255',
        //     'phoneNumber' => 'required',
        //     'email' => 'email',
        //     'statusID' => 'integer'
        //     ]);

        //         $ticket->user_id = Auth::user()->id;
        //         $ticket->jar_id = $jar->id;
        //         $ticket->name = $request->name;
        //         $ticket->phone = $request->phoneNumber;
        //         $ticket->email = $request->email;
        //         $ticket->save();         

    }

    public function updateStatus(Request $request, Ticket $ticket){

                  if(!Auth::check()){
            return redirect('home')
                ->with('warning', 'You must be logged in to do that.');
        };

         $jarId = $ticket->jar_id;

        if(!Auth::user()->isOwner($jarId)){
            return redirect('home')
            ->with('warning', 'You do not own that jar.');
        }

        if(!$ticket->user_id == Auth::user()->id){
            return redirect('home')
            ->with('warning', 'That ticket is unavailable.');
        }

         $request->validate([
            'statusID' => 'integer|required'
            ]);

         $ticket->status_id = $request->statusID;
         $ticket->save();

         $winnersOtherTickets = Ticket::where('name', '=', $ticket->name)
            ->where('winner', '=', 1)
            ->get();

         foreach($winnersOtherTickets as $otherTicket)
         {
            $otherTicket->status_id = $request->statusID;
            $otherTicket->save();
         }   

         $jar = $ticket->jar;

         

         return redirect(route('jar.view', $jar))
         ->with('success', 'The status of that ticket has been updated.');


    }










}
