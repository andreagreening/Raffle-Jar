@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-xs-12 text-center">
		<h1 class="margin-bottom-20 title">{{ $jar->description }}</h1>
	</div>
</div>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		@include('tickets.create')
	{{-- 	<div>
		<a href="{{ route('prize.create', $jar) }}" class="btn btn-primary form-control margin-bottom-20">Add a Prize</a>
		</div>
    
		@if(!$jar->drawingComplete())
		<div>
			<a href="{{ route('jar.drawRaffle', $jar) }}" class="btn btn-primary form-control margin-bottom-20">DRAW WINNING TICKETS</a>
		</div>
		@endif --}}
		<div class="panel panel-default raffle-panel">
			<div class="panel-body text-center">
				<h3>{{ $jar->tickets->count() }} Total Tickets</h3>
				<br>
				<h3>{{ $jar->tickets->where('winner', 1)->count() }} Winners Selected</h3>
				
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9"></div>
					<div class="col-xs-2">
						<a href="{{ route('prize.create', $jar) }}" class="btn btn-primary btn-xs text-center">Add a Prize</a>
					</div>
				</div>
				<div class="row">
					<h3 class="raffle-heading text-center">Prizes</h3> 
				</div>
			
			</div>
				@if($jar->prizes->isEmpty())
				<div class="panel-body">
					No Prizes have been added, <a href="{{route('prize.create', $jar) }}">add prizes now.</a>
				</div>
				@else

					@if($sortedPrizes->isEmpty())
						<div class="panel-body">
							All the prizes entered in this raffle have been assigned winners.  <a href="{{route('prize.create', $jar) }}">Add another prize.</a>
						</div>
					@else
				
					<ul class="list-group">
						@foreach($sortedPrizes as $prize)
							<li class="list-group-item">
							<div class="row">
								<div class="col-md-5">
									{{ $prize->description }} <a href="{{ route('prize.edit', $prize) }}"><i class="fa fa-pencil"></i></a>
									<br>
									{{ $prize->donor }}
								</div>
								
								<div class="col-md-7">
									
									@if(!$prize->ticket)
									<div class="text-center">
										<a href="{{ route('jar.drawPrize', $prize) }}"><i class="fa fa-ticket fa-3x"></i>
										<br>Draw Winning Ticket</a>
									</div>
									
									@endif
								</div>
							</div>
							</li>

						@endforeach
					</ul>
				@endif
			@endif	
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="text-center raffle-heading">WINNERS</h3>
			</div>
			
			<ul class="list-group">
				@if(! empty($winnersByName))
					@foreach($winnersByName as $name => $winningTicketsCollection)
						<li class="list-group-item list-group-item-info">
							<div class="row">
								<div class="col-xs-10">
									<h4>{{ $name }}</h4>
								</div>
								<div class="col-xs-2">
									<span class="label label-info pull-right margin-top-15">
										@if(count($winningTicketsCollection) > 1)
										{{ count($winningTicketsCollection) }}
										Prizes
										@else
										{{ count($winningTicketsCollection) }}
										Prize
										@endif
									</span>
								</div>
							</div>
							
						</li>
						@foreach($winningTicketsCollection as $winningTicket)
							@if($loop->first)
							<li class="list-group-item">
								<div class="row">
									<div class="col-xs-5">
										{{ $winningTicket->phone }}
										<br>
										{{ $winningTicket->email }}
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-xs-8">
										<div class="margin-top-5">
											@include('jars.statusSelect')
										</div>
									</div>
									<div class="col-xs-4 text-center">
										{!! $winningTicket->getStatusIcon() !!}
									</div>
								</div>
							</li>	
									
								
								</li>
							@endif
							<li class="list-group-item">
								<b>{{ $winningTicket->prize->description }} </b>
								@if($winningTicket->prize->donor != NULL)
								donated by {{ $winningTicket->prize->donor }}
								@endif
							</li>
						@endforeach
					@endforeach
				@else
					<div class="panel-body">
						<p>There are no winners yet</p>
					</div>	
				@endif
			</ul>
		</div>
		
	</div>
	
	<div class="col-sm-7">
	</div>
</div>
</div>
@endsection