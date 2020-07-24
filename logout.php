<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
setcookie("BateseySimUser", " ", time()-3600);
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>