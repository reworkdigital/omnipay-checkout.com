<?php

return [
	"id" => "pay_dgoraqrws6jurl5ghlwi7wa7mi",
	"requested_on" => "2019-08-26T07:30:23Z",
	"source" => [
		"type" => "card",
		"expiry_month" => 4,
		"expiry_year" => 4242,
		"scheme" => "Visa",
		"last4" => "4242",
		"fingerprint" => "6CADE1017305692500F39788C5984DD05689575E9D4DF64685055B076C954E71",
		"bin" => "424242",
		"card_type" => "Credit",
		"card_category" => "Consumer",
		"issuer" => "JPMORGAN CHASE BANK NA",
		"issuer_country" => "US",
		"product_id" => "A",
		"product_type" => "Visa Traditional",
	],
	"amount" => 14900,
	"currency" => "AED",
	"payment_type" => "Regular",
	"description" => "Private Seller Platinum 149",
	"status" => "Declined",
	"approved" => false,
	"3ds" => [
		"downgraded" => false,
		"enrolled" => "Y",
		"authentication_response" => "Y",
		"cryptogram" => "89eeb0fc-4227-4df2-9286-ef94",
		"xid" => "139e1a98-0262-46e4-8454-bf8269940ba8",
		"version" => "2.1.0",
	],
	"risk" => [
		"flagged" => false
	],
	"customer" => [
		"id" => "cus_iapvh4ukqw5eda2usxqaapjvhe"
	],
	"scheme_id" => "638284745624527",
	"actions" => [
		[
			"id" => "act_dgoraqrws6jurl5ghlwi7wa7mi",
			"type" => "Authorization",
			"response_code" => "20087",
			"response_summary" => "Bad Track Data",
		],
	],
	"_links" => [
		"self" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_dgoraqrws6jurl5ghlwi7wa7mi"
		],
		"actions" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_dgoraqrws6jurl5ghlwi7wa7mi/actions"
		]
	]
];
