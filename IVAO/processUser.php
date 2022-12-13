<?php
require_once ('../index.php');//to use Dotnev
session_start(); //start the session
$user = $_SESSION["userData"]; //get user data from session
$UserData = json_decode($user); //encode user data
if ($UserData->isStaff == 0)
{ //check if user is staff
    $nickName = $UserData->publicNickname; // if not username is name and VID
    
}
else
{ // if staff, username is name and staffposition
    $userStaff = array();
    for ($x = 0;$x <= 3;$x++)
    {
        if ($UserData->userStaffPositions[$x] != null)
        {
            $staffposition = $UserData->userStaffPositions[$x]->id;

            $userStaff[] = $staffposition . "/";
        }
    }
    $stffToString = implode($userStaff);
    $staffTrimmed = trim($stffToString, "/");
    $userStaffPositions = "(" . $staffTrimmed . ")";
    $nickName = $UserData->firstName . " " . $userStaffPositions;
}
//check if user is a division member, if not assign guest roles
if ($UserData->divisionId == $_ENV['division_Id'])
{
    $isDivisionMember = $_ENV['division_member_roleId'];
}
else
{
    $isDivisionMember = $_ENV['foreign_member_roleId'];
}

//save final user data that will be used in sessions
$_SESSION["nickName"] = $nickName;
$_SESSION["divisionMember"] = $isDivisionMember;
$_SESSION["email"] = $UserData->email;

header("location: /Discord/init-oauth.php");

?>
