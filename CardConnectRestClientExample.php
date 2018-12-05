<?php

/**
* CardConnect PHP REST Client Example
* Version: 1.0

Copyright 2014, CardConnect (http://www.cardconnect.com)

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND
FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
*/

require 'CardConnectRestClient.php';

// Username
$user = "username";
// Password
$password = "password123";
// Site's REST URL
$url = 'https://sitename.prinpay.com:6443/cardconnect/rest';

// Run some auths
$retref = authTransaction();
authTransactionWithUserFields();
authTransactionWithCapture();
authTransactionWithProfile();

// Run a capture
captureTransaction($retref);

// Run an inquire
inquireTransaction($retref);

// Void a transaction
$retref = authTransaction();
voidTransaction($retref);

// Refund a transaction
$retref = authTransactionWithCapture();
refundTransaction($retref);

// Get settlement status
settlementStatusTransaction();

// Get deposit status
depositStatusTransaction();

// Profile usage
$profileid = authTransactionWithProfile();
getProfile($profileid);
deleteProfile($profileid);
createProfile();

// Authorize Transaction example
function authTransaction() {
	global $url, $user, $password;
	echo "\nAuthorization Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid'   => "496400000840",
		'accttyppe' => "VISA",
		'account'   => "4444333322221111",
		'expiry'    => "0914",
		'cvv2'      => "123",
		'amount'    => "100",
		'currency'  => "USD",
		'orderid'   => "12345",
		'name'      => "Test User",
		'street'    => "123 Test St",
		'city'      => "Testville",
		'region'    => "Test State",
		'country'   => "US",
		'postal'    => "11111",
		'tokenize'  => "Y",
	);

	$response = $client->authorizeTransaction($request);
	print var_dump($response);
	return $response["retref"];
}


// Authorize transaction with user fields example
function authTransactionWithUserFields() {
	global $url, $user, $password;
	echo "\nAuthorization With User Fields Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid'   => "496400000840",
		'accttyppe' => "VISA",
		'account'   => "4444333322221111",
		'expiry'    => "0914",
		'cvv2'      => "123",
		'amount'    => "100",
		'currency'  => "USD",
		'orderid'   => "12345",
		'name'      => "Test User",
		'street'    => "123 Test St",
		'city'      => "Testville",
		'region'    => "Test State",
		'country'   => "US",
		'postal'    => "11111",
		'tokenize'  => "Y",
	);

	// Create user fields
	$field = array("Field1" => "Value1");
	$fields = array($field);
	$authdata["userfields"] = $fields;

	$response = $client->authorizeTransaction($request);
	print var_dump($response);
}


// Authorize transaction with capture example
function authTransactionWithCapture() {
	global $url, $user, $password;
	echo "\nAuthorization With Capture Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid'   => "496400000840",
		'accttyppe' => "VISA",
		'account'   => "4444333322221111",
		'expiry'    => "0914",
		'cvv2'      => "123",
		'amount'    => "100",
		'currency'  => "USD",
		'orderid'   => "12345",
		'name'      => "Test User",
		'street'    => "123 Test St",
		'city'      => "Testville",
		'region'    => "Test State",
		'country'   => "US",
		'postal'    => "11111",
		'tokenize'  => "Y",
		'capture'   => "Y",
	);

	$response = $client->authorizeTransaction($request);
	print var_dump($response);
	return $response["retref"];
}


// Authorize transaction with user profile example
function authTransactionWithProfile() {
	global $url, $user, $password;
	echo "\nAuthorization With Profile Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid'   => "496400000840",
		'accttyppe' => "VISA",
		'account'   => "4444333322221111",
		'expiry'    => "0914",
		'cvv2'      => "123",
		'amount'    => "100",
		'currency'  => "USD",
		'orderid'   => "12345",
		'name'      => "Test User",
		'street'    => "123 Test St",
		'city'      => "Testville",
		'region'    => "Test State",
		'country'   => "US",
		'postal'    => "11111",
		'tokenize'  => "Y",
		'profile'   => "Y",
	);

	$response = $client->authorizeTransaction($request);
	print var_dump($response);
	return $response["profileid"];
}


// Capture transaction example
function captureTransaction($retref) {
	global $url, $user, $password;
	echo "\nCapture Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid' => "496400000840",
		'amount' => "100",
		'currency' => "USD",
		'retref' => $retref,
		'ponumber' => "12345",
		'taxamnt' => "007",
		'shipfromzip' => "11111",
		'shiptozip' => "11111",
		'shiptocountry' => "US",
		'postal' => "11111",
		'authcode' => "0001234",
		'invoiceid' => "0123456789",
		'orderdate' => "20140131",
		'frtamnt' => "1",
		'dutyamnt' => "1",
	);

	// Line item details
	// Singe line item
	$item = array (
		'lineno' => "1",
		'material' => "12345",
		'description' => "Item Description",
		'upc' => "0001122334455",
		'quantity' => "5",
		'uom' => "each",
		'unitcost' => "020"
	);
	$items = array($item);

	$request["items"] = $items;

	$response = $client->captureTransaction($request);
	print var_dump($response);
}


// Void transaction example
function voidTransaction($retref) {
	global $url, $user, $password;
	echo "\nVoid Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid' => "496400000840",
		'amount' => "0",
		'currency' => "USD",
		'retref' => $retref,
	);

	$response = $client->voidTransaction($request);
	print var_dump($response);
}


// Refund Service example
function refundTransaction($retref) {
	global $url, $user, $password;
	echo "\nRefund Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$request = array(
		'merchid' => "496400000840",
		'amount' => "0",
		'currency' => "USD",
		'retref' => $retref,
	);

	$response = $client->refundTransaction($request);
	print var_dump($response);
}


// Inquire Service example
function inquireTransaction($retref) {
	global $url, $user, $password;
	echo "\nInquire Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$merchid = "496400000840";

	$response = $client->inquireTransaction($merchid, $retref);
	print var_dump($response);
}


// Settlement Status example
function settlementStatusTransaction() {
	global $url, $user, $password;
	echo "\nSettlement Status Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$merchid = "496400000840";
	$date = "0401";

	$response = $client->settlementStatus($merchid, $date);
	print var_dump($response);
}


// Deposit Status example
function depositStatusTransaction() {
	global $url, $user, $password;
	echo "\nDeposit Transaction Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$merchid = "496400000840";
	$date = "0401";

	$response = $client->depositStatus($merchid, $date);
	print var_dump($response);
}


// Profile Service get Profile example
function getProfile($profileid, $accountid = "") {
	global $url, $user, $password;
	echo "\nGet Profile Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$merchid = "496400000840";

	$response = $client->profileGet($profileid, $accountid, $merchid);
	print var_dump($response);
}


// Profile Service delete Profile example
function deleteProfile($profileid, $accountid = "") {
	global $url, $user, $password;
	echo "\nDelete Profile Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	$merchid = "496400000840";

	$response = $client->profileDelete($profileid, $accountid, $merchid);
	print var_dump($response);
}


// Profile Service create Profile example
function createProfile() {
	global $url, $user, $password;
	echo "\nCreate Profile Request\n";
	$client = new CardConnectRestClient($url, $user, $password);

	// Merchant ID
	$request = array(
		'merchid' => "496400000840",
		'defaultacct' => "Y",
		'account' => "4444333322221111",
		'expiry' => "0914",
		'name' => "Test User",
		'address' => "123 Test St",
		'city' => "TestCity",
		'region' => "TestState",
		'country' => "US",
		'postal' => "11111",
	);

	$response = $client->profileCreate($request);
	print var_dump($response);
}
?>
