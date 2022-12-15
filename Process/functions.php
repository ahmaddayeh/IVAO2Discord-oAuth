<?php
session_start(); //Get use information from session
require_once ('../db/searchForVID.php');
require_once ('../db/searchForDiscord.php');
require_once ('../db/searchForDouble.php');
require_once ('../db/updateUser.php');
require_once ('../db/insertUser.php');
require_once ('../Webhook/central.php');
require_once ('../Discord/addToServer.php');
require_once ('../Discord/assignRoles.php');
require_once ('../Discord/updateNick.php');
require_once ('../Discord/currentMember.php');
require_once ('../index.php');
// Allocate variables
$userDiscordToken = $_SESSION['access_token'];
$userDiscordId = $_SESSION['userDiscordId'];
$nickName = $_SESSION["nickName"];
$email = $_SESSION["email"];
$divisionRole = $_SESSION["divisionMember"];
$username = $_SESSION["username"];
$VID = $_SESSION["VID"];
$pilotRating = $_SESSION["pilotRating"];
$atcRating = $_SESSION["atcRating"];
$firstName = $_SESSION["firstName"];
$lastName = $_SESSION["lastName"];
$divisionId = $_SESSION["divisionId"];
$staffPosition = $_SESSION["staffPosition"];
$bot_token = $_ENV['bot_token'];
$guild_id = $_ENV['guild_id'];
//Run the functions
$array = (checkIfCurrentMember($username, $bot_token, $guild_id)); //check if member is already in the server
if ($array[1] == ']')
{ //if not
    if (checkforDouble($VID, $userDiscordId) == true)
    { // check if the user is joining with different VID than the one in DB
        $flag = 0; // mark as flagged
        prepareWebhook($VID, $firstName, $lastName, $divisionId, $userDiscordId, $flag); //send a Webhook warning
        insertUser($firstName, $lastName, $VID, $pilotRating, $atcRating, $staffPosition, $divisionId, $userDiscordId, $email, $userDiscordToken); // insert to DB for refrence
        
    }
    else if (checkforDiscord($userDiscordId, $VID) != false)
    { // check if user is already in db with differend username
        $flag = 1; // mark as flagged
        $oldDiscordId = checkforDiscord($userDiscordId, $VID); // get old Discord ID
        prepareWebhook($VID, $firstName, $lastName, $divisionId, $userDiscordId, $flag); // send a Webhook warning
        updateUser($VID, $userDiscordId, $pilotRating, $atcRating); // update user in the DB
        
    }
    else
    { // new user
        $flag = 2; // mark as flagged
        prepareWebhook($VID, $firstName, $lastName, $divisionId, $userDiscordId, $flag); // send a Webhook warning
        insertUser($firstName, $lastName, $VID, $pilotRating, $atcRating, $staffPosition, $divisionId, $userDiscordId, $email, $userDiscordToken); // insertUser to the DB
        addToServer($userDiscordToken, $userDiscordId, $nickName, $bot_token, $guild_id); // Add user to the Discord server
        assignRoless($userDiscordToken, $userDiscordId, $divisionRole, $bot_token, $guild_id); // Assign the user roles
        
    }
}
else
{ // user is not flagged and is already in the server
    $flag = 3;
    updateNick($userDiscordToken, $nickName, $userDiscordId, $bot_token, $guild_id); // update user nicknmae
    prepareWebhook($VID, $firstName, $lastName, $divisionId, $userDiscordId, $flag); //send a Webhook warning
    updateUser($VID, $userDiscordId, $pilotRating, $atcRating); // update user in the DB
    
}

echo "Sucessfully completed authentication"; //deafult message

?>
