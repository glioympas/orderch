<div class="form-group">
	<label>street address</label>
	<input type="text" name="street_address" value="{{ $address ? $address->street_address : '' }}" class="form-control">
</div>

<div class="form-group">
	<label>country</label>
	<input type="text" name="country" value="{{ $address ? $address->country : '' }}" class="form-control">
</div>

<div class="form-group">
	<label>city</label>
	<input type="text" name="city" value="{{ $address ? $address->city : '' }}" class="form-control">
</div>

<div class="form-group">
	<label>contact phone</label>
	<input type="text" name="contact_phone" value="{{ $address ? $address->contact_phone : '' }}" class="form-control">
</div>

<div class="form-group">
	<label>contact email</label>
	<input type="text" name="contact_email" value="{{ $address ? $address->contact_email : '' }}" class="form-control">
</div>

@guest

<h1 class="h4 my-4">Become a customer to complete the order</h1>

<div class="form-group">
	<label>account email</label>
	<input type="text" name="account_email" value="" class="form-control">
</div>

<div class="form-group">
	<label>account password</label>
	<input type="text" name="account_password" value="" class="form-control">
</div>

@endif