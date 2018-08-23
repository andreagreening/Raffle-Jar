@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<a class="btn btn-primary pull-right margin-bottom-10" href="{{ route('jar.view', $jar) }}">Back to {{ $jar->description}}</a>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">Add a Prize to {{ $jar->description }}</div>
			<div class="panel-body">
				<form action="{{ route('prize.store', $jar) }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="description">
							Prize Description
						</label>
						<input type="text" name="description" class="form-control">
					</div>
					<div class="form-group">
						<label for="donor">Donated By</label>
						<input type="text" name="donor" class="form-control" placeholder="Optional">
					</div>
					<input type="submit" class="btn btn-primary" value="Save">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection