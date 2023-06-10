<?php

require_once '../includes/connection.php';
include '../includes/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code') && strlen(get('code')) == 30) {
  
  // used by in-app authorization
  if(get('state')) {
	$result = mysqli_query($link, "SELECT * FROM `servers` WHERE `guildid` = '".get('state')."'");
	while ($row = mysqli_fetch_array($result)) {
		$_SESSION['owner'] = $row['owner'];
		$_SESSION['name'] = $row['name'];
	}
  }

  $_url = "https://discord.com/api/v10/oauth2/token";
  $_data = array(
    'client_id' => AppEnvironment::$bot_client_id,
    'client_secret' => AppEnvironment::$bot_client_secret,
    'grant_type' => 'authorization_code',
    'code' => get('code'),
    'redirect_uri' => AppEnvironment::$redirect_uri,
  );
  
  // Exchange the auth code for a token
  try {
    $token_response = send_multipart_post_request($_url, $_data);
    $token = json_decode($token_response);
    if(!isset($token->access_token)) {
      echo "Something went wrong please try again. [1] <br>";
      echo $token_response . "<br>";
      echo AppEnvironment::$redirect_uri . "<br>";
      die();
    }
  } catch (Exception $e) {
    echo "Something went wrong please try again. [2]";
    die();
  }

  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;
  $_SESSION['refresh_token'] = $token->refresh_token;
  $server = $_SESSION['owner'] . '/' . $_SESSION['name'];

  header('Location: ' . AppEnvironment::$verify_uri . $server);
  die();
}

die("invalid request, please retry verification process. [3]");

?>