<?php
return [
	"id" => "pay_7ac5ku5rl4du5gfe3jr6uamgwi",
	"action_id" => "act_7ac5ku5rl4du5gfe3jr6uamgwi",
	"amount" => 14900,
	"currency" => "AED",
	"approved" => true,
	"status" => "Authorized",
	"auth_code" => "223390",
	"eci" => "05",
	"scheme_id" => "638284745624527",
	"response_code" => "10000",
	"response_summary" => "Approved",
	"risk" => [
		"flagged" => false
	],
	"source" => [
		"id" => "src_76gl2s2b5ysuplmhdhggie3gne",
		"type" => "card",
		"expiry_month" => 12,
		"expiry_year" => 2034,
		"scheme" => "Discover",
		"last4" => "1117",
		"fingerprint" => "2D48237B30FD41335797DF29E9CEC0E60CE21AFDCF0FF9FA9DD3DE21AF7EE23F",
		"bin" => "601111",
		"card_type" => "Credit",
		"card_category" => "Commercial",
		"issuer" => "US Bank",
		"issuer_country" => "US",
		"product_id" => "L",
		"product_type" => "Commercial Credit",
		"avs_check" => "S",
		"cvv_check" => "Y",
	],
	"customer" => [
		"id" => "cus_7ab6rn4thgaufdx4fvgdh7vn3a"
	],
	"processed_on" => "2019-08-02T09:40:28Z",
	"processing" => [
		"acquirer_transaction_id" => "8139307502",
		"retrieval_reference_number" => "000223390420",
	],
	"_links" => [
		"self" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_7ac5ku5rl4du5gfe3jr6uamgwi"
		],
		"actions" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_7ac5ku5rl4du5gfe3jr6uamgwi/actions"
		],
		"capture" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_7ac5ku5rl4du5gfe3jr6uamgwi/captures"
		],
		"void" => [
			"href" => "https://api.sandbox.checkout.com/payments/pay_7ac5ku5rl4du5gfe3jr6uamgwi/voids"
		]
	]
];
