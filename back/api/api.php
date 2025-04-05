<?php
$host = 'localhost';
$db = 'noteapp';
$user = 'root';
$pass = ''; // Change this depending on your setup

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

