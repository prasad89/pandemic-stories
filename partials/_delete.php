<?php
include '_dbconnect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  echo '<h1>Good Bye!</h1>';
  session_start();
  echo "logging you out! please wait!";
  session_destroy();
  $sql  = "DELETE FROM `bookmarks` where `u_id`= '$id'";
  $sql2 = "DELETE FROM `comments` where `comment_by`= '$id'";
  $sql3 = "DELETE FROM `comment_rating` where `u_id`= '$id'";
  $sql4 = "DELETE FROM `threads` where `th_u_id`= '$id' ";
  $sql4 = "DELETE FROM `thread_rating` where `u_id`= '$id'";
  $sql5 = "DELETE FROM `profile` where `p_id`= '$id'";
  $sql6 = "DELETE FROM `users` where `u_id` =" . $id;
  $result = mysqli_query($conn, $sql);
  $result2 = mysqli_query($conn, $sql2);
  $result3 = mysqli_query($conn, $sql3);
  $result4 = mysqli_query($conn, $sql4);
  $result5 = mysqli_query($conn, $sql5);
  $result6 = mysqli_query($conn, $sql6);
  if ($result && $result2 && $result3 && $result4 && $result5 && $result6) {
    header("Location: /Pandemic-stories/index.php");
  }
}
