<?php

/*
This sample shows you how to call a MindFire Studio REST service from within your PHP code using POST method.

For each call, you need to:
1- Find out the service name and its required parameters
2- create the service request object
3- Pass the service name and request object to callService() to receive the response object
4- Parse Result object in the response to see if any error has occurred. You can do so by evaluating ErrorCode value to be non-empty
5- Take appropriate action if there is an error or process the respond opject if it is supposed to return any data.

The first service to be call is "userservice/Authenticate" to get the authentication ticket. This ticket must be used in all request objects.
*/

//this function is used to call any API method by passing the method name (endpoint) and its request opbject.
function callService($endpoint, $request)
{
    $request_string = json_encode($request); 

    $service = curl_init('https://studio.mdl.io/REST/'.$endpoint);                                                                      
    curl_setopt($service, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($service, CURLOPT_POSTFIELDS, $request_string);                                                                  
    curl_setopt($service, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($service, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($request_string))                                                                       
    );                                                                                                                   
    $response_string = curl_exec($service);

    $response = json_decode($response_string);
    return($response);
}

//creating the request object for "Authenticate" method
$authRequest = array
(
    "SelectedAccountID" => 16916,
    "Email" => "tt994613@gmail.com", 
    "Password" => "Tu4&Mi2$", 
    "PartnerGuid" => "bca2ca9f_3adb_4d7d_94e5_416673e7459b", 
    "PartnerPassword" => "460DA44a-3f1a-4630-d6f1-89e383f4a715"
);

//This should be always the first call to get a ticket and use it in all other methods.
//NOTE: endpoint in CallService() is case-sensitive
$authResponse = callService("userservice/Authenticate", $authRequest);
$authCredentials = $authResponse->{"Credentials"};
//the following statement might be only used for testing perposes to see if a ticket has been returned.
//Or else, you only need authCredentials to call other service methods.
$authToken = $authResponse->{"Credentials"}->{"Ticket"};
var_dump($authToken);


//The following code shows how to use a ticket to call a sevice method: TrackingStatusByIdList
//1st you need to create the request opject.
$trackingUpdateRequest = array
(
    "Credentials" => $authCredentials,
    "TrackingStatusByIdList" => array(array
    (
        "OutboundContactId" => 1,
        "EventId"=>20502,
        "Date" => "/Date(1347570042959-0700)/",
        "EventOption" => "Delivered"
    ))
);

//2nd, you just pass the above request object along with the service name to callService(). 
$trackingUpdateResponse = callService("programservice/UpdateTrackingStatusById", $trackingUpdateRequest);
var_dump($trackingUpdateResponse);

?>