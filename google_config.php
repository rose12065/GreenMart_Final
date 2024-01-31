<?php

//start session on web page
include('connection.php');

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('480946356163-ktpet8385gklq3t5lvlma7r8h1phda8c.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/GreenMart/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 