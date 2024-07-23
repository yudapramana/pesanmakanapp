<?php

$servername = "localhost";
$username   = "username";
$password   = "password";

// Create connection
$db = new mysqli($servername, $username, $password);

// Check connection
if ($db->connect_error)
{
    exit("Connection failed: " . $db->connect_error);
} 

echo "Connected successfully"; 


?>