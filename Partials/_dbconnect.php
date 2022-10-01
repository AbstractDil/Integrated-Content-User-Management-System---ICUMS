<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "combined";

/* 
$servername = "localhost";
$username = "nandysag_abstract";
$password = "VyuP!(fX[WS8";
$db = "nandysag_feedback";

*/

// Create connection
$conn = mysqli_connect($servername, $username, $password , $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
    // echo "<script>alert('Connected successfully')</script>";
  ?>