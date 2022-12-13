<?php
function assignRoless($access_token, $userDiscordId, $divisionRole, $botToken, $guildId)//API request
{

    $url = "https://discord.com/api/guilds/{$guildId}/members/{$userDiscordId}/roles/{$divisionRole}";
    $data = array(
        'access_token' => $access_token
    );
    $data_json = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:' . $botToken,
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;//return API response
}
?>
