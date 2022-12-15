<?php
require_once ('../index.php'); //to use Dotnev
function pushWebhook($vid, $firstName, $lastName, $division, $discordId, $mention, $title, $color)
{
    $webhookurl = $_ENV['webhook_url'];
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
    // Message
    "content" => "<@{$mention}>",

    // Username
    // "username" => "Auth Bot",
    // Avatar URL.
    // // Uncoment to replace image set in webhook
    // "avatar_url" => "https://cdn.discordapp.com/avatars/{$_SESSION['userDiscordId']}/{$_SESSION['avatar']}",
    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",
    // Embeds Array
    "embeds" => [[
    // Embed Title
    "title" => $title,

    // Embed Type
    "type" => "rich",

    //"description" => "Description will be here, someday, you can mention users here also by calling userID <@12341234123412341>",
    // URL of title link
    "url" => "https://www.ivao.aero/Member.aspx?Id={$vid}",

    // Timestamp of embed must be formatted as ISO8601
    "timestamp" => $timestamp,

    // Embed left border color in HEX
    "color" => hexdec("{$color}") ,

    // // Footer
    // "footer" => [
    //     "text" => "GitHub.com/Mo45",
    //     "icon_url" => $_SESSION['avatar']
    // ],
    // Image to send
    // "image" => [
    //     "url" => "https://cdn.discordapp.com/avatars/{$_SESSION['userDiscordId']}/{$_SESSION['avatar']}"
    // ],
    // Thumbnail
    "thumbnail" => ["url" => "https://cdn.discordapp.com/avatars/{$_SESSION['userDiscordId']}/{$_SESSION['avatar']}"],

    // Author
    "author" => ["name" => "IVAO Bot",
    // "url" => "https://krasin.space/"
    ],

    // Additional Fields array
    "fields" => [
    // Field 1
    ["name" => "Name", "value" => $firstName . " " . $lastName, "inline" => false], ["name" => "Division", "value" => $division, "inline" => false], ["name" => "Discord ID", "value" => $discordId, "inline" => false]

    ]]]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type: application/json'
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
    curl_close($ch);
}

