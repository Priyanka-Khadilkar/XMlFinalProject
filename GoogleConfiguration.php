<?php

require_once './vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('1046336106555-rmukl812ateccplae818inq1toc47btt.apps.googleusercontent.com');

$google_client->setClientSecret('O1rTh4REZNk4kk3is_dSOa8k');
//Change to your machine's index file
$google_client->setRedirectUri('http://localhost/XMlFinalProjectAPIs/index.php');

$google_client->addScope('email');
$google_client->addScope('profile');

//start session on web page
session_start();
?>
