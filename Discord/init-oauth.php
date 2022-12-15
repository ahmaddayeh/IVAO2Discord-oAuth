<?php
require_once ('../index.php');
header("location: {$_ENV['OAuth2_URL']}"); //Redirect to Discord oAuth URL
exit();
?>
