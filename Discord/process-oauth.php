<?php
require_once ('../index.php');
//enable for testing purposes
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if (!isset($_GET['code']))
{
    echo 'no code';
    exit();
}
//Get user ID from Discord API
$discord_code = $_GET['code'];

$payload = ['code' => $discord_code, 'client_id' => $_ENV['discord_client_id'], 'client_secret' => $_ENV['discord_client_secret'], 'grant_type' => 'authorization_code', 'redirect_uri' => $_ENV['discord_redirect_uri'], 'scope' => 'identify%20guids', ];

print_r($payload);

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

if (!$result)
{
    echo curl_error($ch);
}

$result = json_decode($result, true);
$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array(
    "Authorization: Bearer $access_token",
    "Content-Type: application/x-www-form-urlencoded"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);

session_start();

$_SESSION['logged_in'] = true;
$_SESSION['userDiscordId'] = $result['id'];
$_SESSION['access_token'] = $access_token;
$_SESSION['avatar'] = $result['avatar'];
$_SESSION['username'] = $result['username'];

header("location: /Process/functions.php");

exit();

