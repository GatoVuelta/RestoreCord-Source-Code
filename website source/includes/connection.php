<?php

error_reporting(0);

$link = mysqli_connect(getenv('GREMLINS_DB_HOST'), getenv('GREMLINS_DB_USER'), getenv('GREMLINS_DB_PASS'), getenv('GREMLINS_DB_NAME'), getenv('GREMLINS_DB_PORT'));

if ($link === false) {
    die("Error with db...");
}

class AppEnvironment
{
    public static function checkEnv()
    {
        return getenv('GREMLINS_DB_HOST')
            && getenv('GREMLINS_DB_USER')
            && getenv('GREMLINS_DB_PASS')
            && getenv('GREMLINS_DB_NAME')
            && getenv('GREMLINS_DB_PORT')
            && getenv('GREMLINS_BOT_CLIENT_ID')
            && getenv('GREMLINS_BOT_CLIENT_SECRET')
            && getenv('GREMLINS_BOT_TOKEN')
            && getenv('GREMLINS_API_URL');
    }

    public static $db_host;
    public static $db_user;
    public static $db_pass;
    public static $db_name;
    public static $db_port;
    public static $bot_client_id;
    public static $bot_client_secret;
    public static $bot_token;
    public static $api_url;
    public static $redirect_uri;
    public static $verify_uri;

    public function __get($name)
    {
        $envVar = strtoupper($name);
        return getenv("GREMLINS_$envVar");
    }
}

if (!AppEnvironment::checkEnv()) {
    echo("Env variables not set...<br>");
    die();
}

$env = new AppEnvironment();

AppEnvironment::$db_host = $env->db_host;
AppEnvironment::$db_user = $env->db_user;
AppEnvironment::$db_pass = $env->db_pass;
AppEnvironment::$db_name = $env->db_name;
AppEnvironment::$db_port = $env->db_port;
AppEnvironment::$bot_client_id = $env->bot_client_id;
AppEnvironment::$bot_client_secret = $env->bot_client_secret;
AppEnvironment::$bot_token = $env->bot_token;
AppEnvironment::$api_url = $env->api_url;
AppEnvironment::$redirect_uri = AppEnvironment::$api_url . '/auth/';
AppEnvironment::$verify_uri = AppEnvironment::$api_url . '/verify/';

// $ShoppySecret; // replace with your webhook secret
// $shoppyApiKey;

// // Webhooks
// $AdminLogs;
// $Logs;

?>