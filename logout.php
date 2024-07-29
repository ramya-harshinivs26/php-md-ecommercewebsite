<?php 
session_start(); 

// Destroy all sessions 
session_destroy(); 

// Redirect to homepage with a logout message
header("Location: login.html?message=logout"); 
exit; 
?>
