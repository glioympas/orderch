<form method="POST" action="{{ route('coupons.apply') }}">
	@csrf
	<div class="form-group">
		<label>counpon code</label>
		<input type="text" class="form-control" name="code">
	</div>

	<button class="my-4 btn btn-primary">apply coupon</button>
</form>