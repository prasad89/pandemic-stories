<?php
include '_dbconnect.php';
if (isset($_POST['u_id'])) {
	$u_id = $_POST['u_id'];
	$th_id = $_POST['th_id'];
	$th_u_id = $_POST['th_u_id'];
	if ($u_id == $th_u_id) {
		$sql = "DELETE FROM threads WHERE th_id = $th_id";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: /Pandemic-stories/index.php?thread=deleted");
		}
	}
}
