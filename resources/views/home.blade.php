
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" href="#newRaffle">
                    Create a New Raffle Jar <i class="fa fa-plus-circle pull-right"></i>
                </div>
                <div class="panel-body collapse" id="newRaffle">
                    <form action="{{ route('jar.newRaffle') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="jarName">
                                Name Your Raffle Jar
                            </label>
                            <input type="text" class="form-control" name="description" placeholder="ex. Team Raffle">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        
        
         
            @if(!$jars->isEmpty())
             <h2 class="text-center">Your Current Raffles</h2>

            @foreach($jars as $jar)  
            <div class="panel panel-default panel-sideline">
                <div class="panel-heading text-center raffle-heading">
                    <a href="{{ route('jar.view', $jar) }}"><h3>{{ $jar->description }}</h3></a>      
                </div>
                <div class="panel-body text-center">
                    <b>{{ $jar->tickets->count() }}</b> Tickets Entered
                    <br>
                    <b>{{ $jar->prizes->count() }}</b> Prizes Entered
                    <br>
                    <b>{{ $jar->tickets->where('winner', TRUE)->count()}}</b> Winners Drawn
                    <br>     
                    <br>
                    <a href="{{ route('jar.confirmArchive', $jar) }}" class="pull-right">Archive Raffle</a>
                </div>

            </div>
            @endforeach
            @endif
            </div>
        </div>
        {{-- end of column--}}
        
     </div>
</div>
@endsection
