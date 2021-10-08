<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('200999692765-3j801kljk0kdc4ifpptrnf8v2tss8pve.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('xDe4NiJahzjBjfCPgXoSZACw');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://qkiere.com/usuario/frontend/pages/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>