@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Are you sure you want to Archive {{ $jar->description }}?</h4>
				</div>
				<div class="panel-body">
				
					<a href="{{ route('jar.delete', $jar) }}">Yes, Archive</a>
					<a href="{{ route('home') }}">No, Go Back</a>
				</div>
			</div>
		</div>		
	</div>
</div>
@endsection