<?php include '_dbconnect.php'; ?>
<?php
$showAlert = false;
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$location = $_POST['location'];
$bio = $_POST['bio'];
$sfp = $_POST['sfp'];
$u_id = $_POST['u_id'];
echo $u_id . "<br>" . $fname . "<br>" . $lname . "<br>" . $location . "<br>" . $bio . "<br>" . $sfp;
$sql = "SELECT * FROM `profile` WHERE `u_id` = $u_id";
$result = mysqli_query($conn, $sql);
if ($result) {
  if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO `profile` (`f_name`,`l_name`,`location`,`bio`,`sfp`,`u_id`) VALUES ('$fname','$lname','$location','$bio','$sfp',$u_id)";
    $result = mysqli_query($conn, $sql);
    if ($result)
      $showAlert = true;
    else {
      echo mysqli_errno($conn) . " " . mysqli_error($conn) . "<br>";
    }
    if ($showAlert) {
      echo 'Your profile has been updated!';
      header("Location: /Pandemic-stories/update_profile.php?edit=true");
    }
  } else {
    $sql = "UPDATE `profile` SET `f_name` = '$fname', `l_name` = '$lname', `location` = '$location', `bio` = '$bio', `sfp` = '$sfp', `u_id` = $u_id";
    $result = mysqli_query($conn, $sql);
    if ($result)
      $showAlert = true;
    else {
      echo mysqli_errno($conn) . " " . mysqli_error($conn) . "<br>";
    }
    if ($showAlert) {
      echo 'Your profile has been updated!';
      header("Location: /Pandemic-stories/update_profile.php?edit=true");
    }
  }
}
?>
