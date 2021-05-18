<?php
// session_start(); do đã bỏ vào updatePasswordPage.php
require_once  "account.php";

// Create connection
$conn = new mysqli(HOST, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$pass = md5($_POST['pass1']);
$email = $_SESSION['email'];

$sql = "UPDATE accounts SET password= '$pass' WHERE email= '$email'";

if ($conn->query($sql) === TRUE) {
  $content = "Đã cập nhật password rồi nha";
} else {
  $content = "Error updating record: " . $conn->error;
}

$conn->close();
?>