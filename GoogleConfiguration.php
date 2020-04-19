<?php

require_once './vendor/autoload.php';

$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('Your_Client_ID');

////Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('YOUR_Clinet_Secret_KEY');
//Change to your machine's index file
$google_client->setRedirectUri('http://localhost/XMlFinalProjectAPIs/index.php');

$google_client->addScope('email');
$google_client->addScope('profile');

//start session on web page
session_start();
?>
