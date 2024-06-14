<?php

// Prevent the session cookie being accessed on the client with JavaScript
ini_set('session.cookie_httponly', 1);

// Ensuring session ID cannot be passed through URL
ini_set('session.use_only_cookies', 1);

// remove all session variables
session_unset();
		
// destroy the session
session_destroy(); 

// Generates a new session ID	
session_regenerate_id();
$new_session = session_id();

// is the session variable set???
if(isset($_SESSION['numberValue'])){}

// Assign a value to the session variable
$_SESSION['numberValue'] = $newNumVal ;

// Generates a new session ID	
session_regenerate_id();

// Obtain the Useragent & IP address
$IPAddress = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];


?> 

