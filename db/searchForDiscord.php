<?php
function checkforDiscord($id, $VID) //API Request

{
    require "db.php"; //to call addToServer
    $sql = "SELECT discord_id FROM users  WHERE vid=$VID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
            if ($id != $row['discord_id'])
            {
                return true;
            }
        }
    }
    else
    {
        return false;
    }

    $conn->close();
}
?>
