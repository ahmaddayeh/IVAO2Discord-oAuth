<?php
require_once ('../index.php');//to use Dotnev
require "addToServer.php";//to call addToServer
require "assignRoles.php";//to call assignRoles
session_start();//Get use information from session
$userDiscordToken = $_SESSION['access_token'];
$userDiscordId = $_SESSION['userDiscordId'];
$nickName = $_SESSION["nickName"];
$email = $_SESSION["email"];
$divisionRole = $_SESSION["divisionMember"];

//Enable testing to see if there is any error
//echo $addingToServer_res = json_decode(addToServer($userDiscordToken, $userDiscordId, $nickName, $_ENV['bot_token'], $_ENV['guild_id']));
//ehco $changingUsername_res = json_decode(assignRoless($userDiscordToken, $userDiscordId, $divisionRole, $_ENV['bot_token'], $_ENV['guild_id']));


addToServer($userDiscordToken, $userDiscordId, $nickName, $_ENV['bot_token'], $_ENV['guild_id']);//function to add a user to the server
assignRoless($userDiscordToken, $userDiscordId, $divisionRole, $_ENV['bot_token'], $_ENV['guild_id']);//function to assign a role to the user

echo "Sucessfully completed authentication";//deafult message

?>
