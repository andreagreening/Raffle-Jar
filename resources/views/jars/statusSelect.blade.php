<form action="{{ route('ticket.updateStatus', $winningTicket )}}" method="POST">
											{{ csrf_field() }}
											<select name="statusID" onchange="this.form.submit()">
												<option value=""></option>
												<option value="1" {{ $winningTicket->status_id == 1 ? 'selected' : ''}}>Contacted by Phone</option>
												<option value="2" {{ $winningTicket->status_id == 2 ? 'selected' : ''}}>Contacted by Phone, Left Message</option>
												<option value="3" {{ $winningTicket->status_id == 3 ? 'selected' : ''}}>Contacted by Email</option>
												<option value="4" {{ $winningTicket->status_id == 4 ? 'selected' : ''}}>Contacted by Email, No Response</option>
												<option value="5" {{ $winningTicket->status_id == 5 ? 'selected' : ''}}>Claimed Prize</option>
											</select>
										</form>
