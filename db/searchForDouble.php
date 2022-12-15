<?php
function checkforDouble($VID, $id) //API Request

{
    require "db.php"; //to call addToServer
    $sql = "SELECT discord_id, vid FROM users  WHERE discord_id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
            if ($VID != $row['vid'])
            {
                return $row["discord_id"];
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
