<?php
include '_dbconnect.php';
if (isset($_POST['title'])) {
  $t_id = $_POST['t_id'];
  $code = $_POST['code'];
  $code = nl2br($code);
  $thread_title = $_POST['title'];
  $thread_desc = $_POST['desc'];
  $thread_title = str_replace("<", "&lt;", $thread_title);
  $thread_title = str_replace(">", "&gt;", $thread_title);
  $thread_desc = nl2br($thread_desc);
  $u_id = $_POST['u_id'];
  $showAlert = false;
  if (($_FILES['myfile']['name']) != null) {
    $filename = $_FILES['myfile']['name'];
    $destination = 'uploads/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'rar', 'mp4'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> You file extension must be .jpg, .pdf, .docx, .zip, .mp4
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    } else {
      if (move_uploaded_file($file, $destination)) {
        $sql = "INSERT INTO `threads` (`th_title`, `th_description`, `th_code`, `fname`, `fdownloads`, `fsize`, `th_t_id`,
    `th_u_id`, `timestamp`) VALUES ( '$thread_title', '$thread_desc', '$code', '$filename', 0, '$size', '$t_id',
    '$u_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result)
          $showAlert = true;
        else
          echo mysqli_error($conn);
      }
    }
  } else {
    $sql = "INSERT INTO `threads` (`th_title`, `th_description`, `th_code`, `th_t_id`, `th_u_id`, `timestamp`) VALUES (
    '$thread_title', '$thread_desc','$code', '$t_id', '$u_id', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result)
      $showAlert = true;
    else
      echo mysqli_error($conn);
  }
  if ($showAlert) {
    header("Location: /Pandemic-stories/index.php?posting=sucess");
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> Your thread has been added! Please wait for community to respond.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
  } else {
    echo mysqli_error($conn);
  }
}