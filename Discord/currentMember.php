<?php
function checkIfCurrentMember($username, $botToken, $guildId) //API Request

{
    $service_url = "https://discord.com/api/guilds/{$guildId}/members/search?query={$username}";
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization:' . $botToken,
    ));
    $curl_response = curl_exec($curl);
    curl_close($curl);
    return $curl_response;
}

?>
