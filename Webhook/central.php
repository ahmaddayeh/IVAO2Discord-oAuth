<?php
require "webhook.php"; //to call addToServer
require_once ('../index.php'); //to use Dotnev
function prepareWebhook($vid, $firstName, $lastName, $division, $discordId, $flag) //API Request

{
    $admin_role = $_ENV['admin_id'];
    $bot_role = $_ENV['bot_id'];
    if ($flag == 0)
    {
        $mention = $admin_role;
        $title = "Action required! Double account";
        $color = 'E93434';
    }
    if ($flag == 1)
    {
        $mention = $bot_role;
        $title = "Caution! A member join with different Discord has joined the server";
        $color = 'F9CC2C';

    }
    if ($flag == 2)
    {
        $mention = $bot_role;
        $title = "A new member has joined the server";
        $color = '3C55AC';

    }

    if ($flag == 3)
    {
        $mention = $bot_role;
        $title = "An exisiting member has updating their Discord";
        $color = '7EA2D6';

    }
    pushWebhook($vid, $firstName, $lastName, $division, $discordId, $mention, $title, $color);
}
?>
