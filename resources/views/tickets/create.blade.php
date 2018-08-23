
<div class="panel panel-default ticket-panel panel-sideline">
	
	<div class="panel-body">
	<h4 class="text-center">Add Ticket to {{ $jar->description }}</h4>
		<form action="{{ route('ticket.store', $jar) }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group {{ $errors->has('name')? 'has-error' : "" }}">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group {{ $errors->has('phoneNumber')? 'has-error' : "" }}">
				<label for="phoneNumber">Phone Number</label>
				<input type="text" class="form-control" name="phoneNumber">
			</div>
			<div class="form-group {{ $errors->has('email')? 'has-error' : "" }}">
				<label for="email">e-mail</label>
				<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group">
				<label for="quantity">Quantity</label>
				<select name="quantity" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
				</select>
			</div>
			<input type="submit" class="btn btn-primary" value="Enter Tickets">
		</form>
	</div>
</div>


