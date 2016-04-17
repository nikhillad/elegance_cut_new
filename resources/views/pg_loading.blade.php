<html>
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<div style="width:100%;text-align:center;margin-top:20%">
		<img class="anim" src="{{asset('images/loader.gif')}}" alt="loading..." />
		<br>
		<h2 style="font-family: 'Lato', sans-serif;font-weight: 100">Redirecting to payment gateway</h2>
	</div>

	<form id="pay" method="post" action="{{Config('global.payu.initiate_txn_url')}}">
		<input type="hidden" name="txnid" value="{{$objTxnMaster->txn_id}}">
		<input type="hidden" name="amount" value="{{$objTxnMaster->amount}}">
		<input type="hidden" name="productinfo" value="{{$product_info}}">
		<input type="hidden" name="firstname" value="{{$objUser->fname}}">
		<input type="hidden" name="lastname" value="{{$objUser->lname}}">
		<input type="hidden" name="email" value="{{$objUser->email}}">
		<input type="hidden" name="phone" value="{{$objUser->mobile}}">
		<input type="hidden" name="surl" value="{{route('surl')}}">
		<input type="hidden" name="furl" value="{{route('furl')}}">
		<input type="hidden" name="curl" value="{{route('curl')}}">
		<input type="hidden" name="hash" value="{{$hash}}">
		<input type="hidden" name="key" value="{{Config('global.payu.key')}}">
		<input type="hidden" name="salt" value="{{Config('global.payu.salt')}}">
	</form>
	
	<script type="text/javascript">
		$(window).load(function() {
			$('#pay').submit();
		});
	</script>
</html>