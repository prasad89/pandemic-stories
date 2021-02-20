<?php
include '_dbconnect.php';
if (isset($_POST['u_id'])) {
	$comment = $_POST['comment'];
	$code = $_POST['code'];
	$comment = str_replace("<", "&lt;", $comment);
	$comment = str_replace(">", "&gt;", $comment);
	$comment = nl2br($comment);
	$code = nl2br($code);
	$p_id = $_POST['p_id'];
	$code = $_POST['code'];
	$u_id = $_POST['u_id'];
	$id = $_POST['th_id'];
	if ($p_id == null)
		$sql = "INSERT INTO `comments`(`c_content`,`c_parent`,`c_code`,`th_id`,`comment_by`,`timestamp`) VALUES ('$comment',NULL,'$code','$id','$u_id',current_timestamp());";
	else
		$sql = "INSERT INTO `comments`(`c_content`,`c_parent`,`c_code`,`th_id`,`comment_by`,`timestamp`) VALUES ('$comment','$p_id','$code','$id','$u_id',current_timestamp());";
	$result = mysqli_query($conn, $sql);
	if ($result)
		$showAlert = true;
	if ($showAlert) {
		if (isset($_POST['th_id']))
			header("Location: /Pandemic-stories/thread.php?th_id=$id&commentPosting=sucess");
	} else {
		header("Location: /Pandemic-stories/thread.php?th_id=$id&commentPosting=fail");
		echo mysqli_error($conn);
	}
}
