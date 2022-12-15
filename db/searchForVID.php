<?php
function checkforVID($VID) //API Request

{
    require "db.php"; //to call addToServer
    $sql = "SELECT id, date_of_join FROM users  WHERE vid= $VID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        return true;
    }
    else
    {
        return false;
    }

    $conn->close();
}
?>
