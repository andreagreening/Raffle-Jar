@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit {{$prize->description}}</div>
				<div class="panel-body">
					<form action="{{ route('prize.update', $prize) }}" method="POST">
	                    {{ csrf_field() }}
							<div class="form-group {{ $errors->has('description')? 'has-error' : "" }}">
								<label for="description">Describe the Prize</label>
								<input type="text" class="form-control" name="description" value="{{ old('description') ? old('description') : $prize->description }}">
							</div>

							<div class="form-group {{ $errors->has('donor')? 'has-error' : "" }}">
								<label for="donor">Donated By</label>
								<input type="text" class="form-control" name="donor" value="{{ old('donor') ? old('donor') : $prize->donor }}">
							</div>

							<input type="submit" class="btn btn-success">
	
							<a class="pull-right" href="{{ route('prize.confirmDelete', $prize) }}">Delete {{ $prize->description}}</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection