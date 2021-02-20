<?php
echo '<epsilon>';
// if user clicks like or dislike button
if (isset($_POST['Caction'])) {
  $c_id = $_POST['c_id'];
  $Caction = $_POST['Caction'];
  switch ($Caction) {
    case 'like':
    $sql="INSERT INTO comment_rating (u_id, c_id, info) VALUES ($userid, $c_id, 'like')
    ON DUPLICATE KEY UPDATE info='like'";
    break;
    case 'dislike':
    $sql="INSERT INTO comment_rating (u_id, c_id, info) VALUES ($userid, $c_id, 'dislike')
    ON DUPLICATE KEY UPDATE info='dislike'";
    break;
    case 'unlike':
    $sql="DELETE FROM comment_rating WHERE u_id=$userid AND c_id=$c_id";
    break;
    case 'undislike':
    $sql="DELETE FROM comment_rating WHERE u_id=$userid AND c_id=$c_id";
    break;
    default:
    break;
  }
  mysqli_query($conn, $sql);
  echo getCRating($c_id);
  // execute query to effect changes in the database ...
  exit(0);
}
// Get total number of likes for a particular comment
function getCLikes($c_id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM comment_rating WHERE c_id = $c_id AND info='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}
function getCVotes($c_id)
{
  $votes = getLikes($c_id) - getDislikes($c_id);
  return $votes;
}
// Get total number of dislikes for a particular comment
function getCDislikes($c_id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM comment_rating WHERE c_id = $c_id AND info='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}
// Get total number of likes and dislikes for a particular comment
function getCRating($c_id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM comment_rating WHERE c_id = $c_id AND info='like'";
  $dislikes_query = "SELECT COUNT(*) FROM comment_rating WHERE c_id = $c_id AND info='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $votes = $likes[0] - $dislikes[0];
  $rating = [
    'Clikes' => $likes[0],
    'Cdislikes' => $dislikes[0],
    'Cvotes' => $votes
  ];
  return json_encode($rating);
}
// Check if user already likes comment or not
function userCLiked($c_id)
{
  global $conn;
  global $userid;
  $sql = "SELECT * FROM comment_rating WHERE u_id=$userid AND c_id=$c_id AND info='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}
// Check if user already dislikes comment or not
function userCDisliked($c_id)
{
  global $conn;
  global $userid;
  $sql = "SELECT * FROM comment_rating WHERE u_id=$userid AND c_id=$c_id AND info='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}
?>