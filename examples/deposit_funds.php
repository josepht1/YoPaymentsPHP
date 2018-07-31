<?php
/**
 * This example shows settings to use when submitting a request to get a USSD mobile money PIN
 * prompt to transfer funds from a mobile money user to your Yo! Payments Account
 */

require '../YoAPI.php';

// Create a new YoAPI instance with Yo! Payments Username and Password
$username = "";
$password = "";
$test_mode = true;

$yoAPI = new YoAPI($username, $password, $test_mode); 

// Create a unique transaction reference that you will reference this payment with
$transaction_reference = date("YmdHis").rand(1,100);
$yoAPI->set_external_reference($transaction_reference);

$response = $yoAPI->ac_deposit_funds('256783086794', 1000, 'Reason for transfer of funds');

//See what data type response has:
echo "<pre>";
print_r($response);
echo "</pre>";


if($response['Status']=='OK'){
	echo "Payment made! Funds have been deposited onto your account. Transaction Reference = ".$response['TransactionReference'].". Thank you for using Yo! Payments";

	// Save this transaction for future reference
}else{


	//In case there are any errors, use the following fields:
	echo "Request failed, Error message: ".$response['ErrorMessage']." \n";
	echo "Reponse HTTP code: ".$response['HttpResponseCode']." \n"; 

	//You can also examine the sent and response data like so.
	//echo "Sent XML: ".$response['SentData']." \n"; 
	//echo "Response XML: ".$response['ResponseData']." \n"; 

	//You can also check the StatusMessage field.
	echo "Yo Payments Error: ".$response['StatusMessage'];
}
