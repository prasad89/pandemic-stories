<?php
echo "<epsilon>";
// if user clicks like or dislike button
if (isset($_POST['action'])) {
  $th_id = $_POST['th_th_id'];
  $action = $_POST['action'];
  switch ($action) {
    case 'like':
    $sql="INSERT INTO thread_rating (u_id, th_id, info) VALUES ($userid, $th_id, 'like')
    ON DUPLICATE KEY UPDATE info='like'";
    break;
    case 'dislike':
    $sql="INSERT INTO thread_rating (u_id, th_id, info) VALUES ($userid, $th_id, 'dislike')
    ON DUPLICATE KEY UPDATE info='dislike'";
    break;
    case 'unlike':
    $sql="DELETE FROM thread_rating WHERE u_id=$userid AND th_id=$th_id";
    break;
    case 'undislike':
    $sql="DELETE FROM thread_rating WHERE u_id=$userid AND th_id=$th_id";
    break;
    case 'mark':
    $sql="INSERT INTO bookmarks (u_id, th_id) VALUES ($userid, $th_id)";
    break;
    case 'unmark':
    $sql="DELETE FROM bookmarks WHERE u_id=$userid AND th_id=$th_id";
    break;
    case 'follow':
    $sql="INSERT INTO follow_topic (u_id, t_id) VALUES ($userid, $th_id)";
    break;
    case 'unfollow':
    $sql="DELETE FROM follow_topic WHERE u_id=$userid AND t_id=$th_id";
    break;
    default:
    break;
  }
  mysqli_query($conn, $sql);
  echo getRating($th_id);
  // execute query to effect changes in the database ...
  exit(0);
}
// Get total number of likes for a particular post
function getLikes($th_id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM thread_rating WHERE th_id = $th_id AND info='like'";
  $rs = mysqli_query($conn, $sql);
  if($rs)
    $result = mysqli_fetch_array($rs);
  else
    echo mysqli_error($conn);
  return $result[0];
}
function getVotes($th_id)
{
  $votes = getLikes($th_id) - getDislikes($th_id);
  return $votes;
}
// Get total number of dislikes for a particular post
function getDislikes($th_id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM thread_rating WHERE th_id = $th_id AND info='dislike'";
  $rs = mysqli_query($conn, $sql);
  if($rs)
    $result = mysqli_fetch_array($rs);
  else
    echo mysqli_error($conn);
  return $result[0];
}
// Get total number of likes and dislikes for a particular post
function getRating($th_id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM thread_rating WHERE th_id = $th_id AND info='like'";
  $dislikes_query = "SELECT COUNT(*) FROM thread_rating WHERE th_id = $th_id AND info='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $votes = $likes[0] - $dislikes[0];
  $rating = [
    'likes' => $likes[0],
    'dislikes' => $dislikes[0],
    'votes' => $votes
  ];
  return json_encode($rating);
}
// Check if user already likes post or not
function userLiked($th_id)
{
  global $conn;
  global $userid;
  if($userid == null){
    $userid = -1;
  }
  $sql = "SELECT * FROM thread_rating WHERE u_id=$userid AND th_id=$th_id AND info='like'";
  $result = mysqli_query($conn, $sql);
  if($result){
    if (mysqli_num_rows($result) > 0) {
      return true;
    }
    else{
      return false;
    }
  }
  else{
    echo mysqli_error($conn);
  }
}
// Check if user already dislikes post or not
function userDisliked($th_id)
{
  global $conn;
  global $userid;
  if($userid == null){
    $userid = -1;
  }
  $sql = "SELECT * FROM thread_rating WHERE u_id=$userid AND th_id=$th_id AND info='dislike'";
  $result = mysqli_query($conn, $sql);
  if($result){
    if (mysqli_num_rows($result) > 0) {
      return true;
    }
    else{
      return false;
    }
  }
  else{
    echo mysqli_error($conn);
  }
}
//Check if user already bookmarked post or not
function userMarked($th_id)
{
  global $conn;
  global $userid;
  if($userid == null){
    $userid = -1;
  }
  $sql = "SELECT * FROM bookmarks WHERE u_id=$userid AND th_id=$th_id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}
//Check if user already follow topic or not
function userFollowed($t_id)
{
  global $conn;
  global $userid;
  if($userid == null){
    $userid = -1;
  }
  $sql = "SELECT * FROM follow_topic WHERE u_id=$userid AND t_id=$t_id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}
?>
