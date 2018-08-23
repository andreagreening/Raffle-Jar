@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Delete {{ $prize->description}}?</div>
					<div class="panel-body">
						<a href="{{ route('prize.delete', $prize) }}">Yes, Delete {{ $prize->description }}</a>
						<a href="{{ route('jar.view', $prize->jar) }}">No, don't delete</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection