<?php

return [

	'token_types' => [
		'verify_email'=>'VERIFY_EMAIL',
		'verify_mobile'=>'VERIFY_MOBILE'
	],

	'support_email' => 'support@elegancecut.com',
	
	'order_status' => [
		'placed' => 'Order Placed',
		'approved' => 'Order Approved',
		'preparing' => 'Yet To Dispatch',
		'dispatched' => 'Dispatched',
		'onway' => 'On The Way',
		'delivered' => 'Delivered',
		'cancelled' => 'Cancelled'
	],

	'payu' => [
		'key' => env('PAYU_KEY','gtKFFx'),
		'salt' => env('PAYU_SALT','eCwWELxi'),
		'initiate_txn_url' => env('PAYU_TXN_INITIATE_URL','https://test.payu.in/_payment')
	]
];