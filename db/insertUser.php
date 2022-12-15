<?php
function insertUser($memberfirstname, $memberlastname, $vid, $pilotrating, $atcrating, $staffpositions, $division, $memberid, $memberemail, $access_token) //API Request

{
    $date = date('Y-m-d H:i:s');
    require "db.php"; //to call addToServer
    $sql = "INSERT INTO users (first_name, last_name, vid, account_status, pilot_rating, atc_rating,  staff_positions, division, discord_id, email, date_of_join, token)
VALUES ('" . $memberfirstname . "','" . $memberlastname . "','" . $vid . "', null, '" . $pilotrating . "','" . $atcrating . "', '" . $staffpositions . "','" . $division . "','" . $memberid . "','" . $memberemail . "','" . $date . "','" . $access_token . "')";

    if ($conn->query($sql) === true)
    {
        return "New record created successfully";
    }
    else
    {
        return "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("location: ./dashboard.php");
    exit();

}
?>
