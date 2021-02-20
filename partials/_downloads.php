<?php
include '_dbconnect.php';
// Downloads files
if (isset($_GET['file_id'])) {
  $id = $_GET['file_id'];
  // Fetch file to download from database
  $sql = "SELECT * FROM threads WHERE th_id=$id";
  $result = mysqli_query($conn, $sql);
  $file = mysqli_fetch_assoc($result);
  $filepath = '../partials/uploads/' . $file['fname'];
  if (file_exists($filepath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($filepath));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('../partials/uploads/' . $file['fname']));
    readfile('../partials/uploads/' . $file['fname']);
    // Now update downloads count
    $newCount = $file['fdownloads'] + 1;
    $updateQuery = "UPDATE threads SET fdownloads=$newCount WHERE th_id=$id";
    mysqli_query($conn, $updateQuery);
    exit;
  }
}