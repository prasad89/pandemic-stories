<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '_dbconnect.php';
  $u_email = $_POST['signupEmail'];
  $pass = $_POST['signupPassword'];
  $cpass = $_POST['signupcPassword'];
  $existSql = "SELECT * FROM `users` WHERE `u_email`='$u_email'";
  $result = mysqli_query($conn, $existSql);
  $numRows = mysqli_num_rows($result);
  if ($numRows > 0) {
    $showError = "Email is already in use!";
  } else {
    if ($pass == $cpass) {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`u_email`, `u_pass`, `timestamp`)VALUES('$u_email', '$hash', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
        header("Location: /Pandemic-stories/index.php?signupsuccess=true");
        exit();
      }
    } else {
      $showError = "Password does not match! Try again!";
    }
  }
  header("Location: /Pandemic-stories/index.php?signupsuccess=false&error=$showError");
}
