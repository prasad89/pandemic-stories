<?php
if (isset($_GET['th_id'])) {
	$id = $_GET['th_id'];
} else {
	$id = $_POST['th_id'];
}
function post_comment()
{
	global $conn;
	global $id;
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$userid = $_SESSION['u_id'];
		$p_id = null;
		// If user is logged in
		echo '<div class="text-center">
		<button type="button" class="btn btn-outline-primary text-center mt-3 px-5" data-toggle="modal" data-target="#postComment">Post Comment</button>
		</div>
		<div class="modal fade" id="postComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Post Comment</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
		<form action="partials/_postingComment.php" method="post">
		<div class="form-group">
		<label for="exampleFormControlTextarea1">Type your comment</label>
		<textarea style="color:black;" class="form-control" id="exampleFormControlTextarea1" placeholder="Comment" rows="2" name="comment" required></textarea>
		</div>
		<input type="hidden" name="p_id" value="' . $p_id . '">
		<input type="hidden" name="th_id" value="' . $id . '">
		</div>
		<div class="modal-footer">
		<input type="hidden" name="u_id" value="' . $_SESSION['u_id'] . '">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" value="submit" class="btn btn-primary" style="width: 5rem;">Post</button>
		</form>
		</div>
		</div>
		</div>
		</div>';
	} else {
		// If user is not logged in
		echo '<div class="text-center">
		<button type="button" class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#startThread" style="width: 22rem;" disabled>Please login to Post Comment</button>
		</div>';
	}
}