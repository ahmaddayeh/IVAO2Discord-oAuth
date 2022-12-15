<?php
function updateUser($vid, $userDiscordId, $pilotRating, $atcRating) //API Request

{
    require "db.php"; //to call addToServer
    $sql = "UPDATE users SET pilot_rating= $pilotRating,  atc_rating = $atcRating, discord_id= $userDiscordId WHERE vid= $vid";

    if (mysqli_query($conn, $sql))
    {
        echo "Record updated successfully";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
