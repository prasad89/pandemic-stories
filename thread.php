<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Pandemic Stories</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Highlight CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/monokai-sublime.min.css">
    <!-- Highlight JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
    <script type='text/javascript'>
    hljs.initHighlightingOnLoad();
    </script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <script type='text/javascript' src="js/_handleThread-y.js"></script>
    <script type='text/javascript' src="js/_handleComment.js"></script>
</head>

<body id="body101" class="d-flex flex-column h-100">
    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Start Thread -->
    <?php include 'partials/_startThread.php'; ?>

    <!-- Post Comment -->
    <?php include 'partials/_postComment.php';
	if (isset($_GET['commentPosting']) && $_GET['commentPosting'] == "sucess") {
		print <<<HTML
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Sucess!</strong>Your comment has been sucessfully added!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		HTML;
	}
	if (isset($_GET['commentPosting']) && $_GET['commentPosting'] == "fail") {
		print <<<HTML
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>failed!</strong>Something went wrong!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		HTML;
	}

	?>

    <!-- Print Comment -->
    <?php include 'partials/_printComment.php'; ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <!-- Thread -->
                    <div class="card text-primary mt-3">
                        <?php include 'partials/_handleThread.php'; ?>
                        <?php include 'partials/_handleComment.php'; ?>
                        <?php
						$th_id = $_GET['th_id'];
						$sql = "SELECT * FROM `threads` WHERE th_id=$th_id";
						$result = mysqli_query($conn, $sql);
						if ($result)
							$post = mysqli_fetch_assoc($result);
						else
							echo mysqli_error($conn);
						$title = $post['th_title'];
						$desc = $post['th_description'];
						$code = $post['th_code'];
						$file = $post['fname'];
						$downloads = $post['fdownloads'];
						$filepath = 'partials/uploads/' . $file;
						$time = $post['timestamp'];
						$time = timeAgo($time);
						$th_t_id = $post['th_t_id'];
						$t_name = fetch_t_name($th_t_id);
						$comment_count = fetch_c_count($th_id);
						$th_u_id = $post['th_u_id'];
						$u_email = fetch_mail($th_u_id);
						print <<<HTML
						<br><br><br>
						<h5 id="posts102" class="card-header">
						<a href="threadlist.php?topid=$th_t_id&sort=newest">
						<span class="badge badge-primary badge-pill">$t_name</a>/$title
						</h5>
						<div id="posts101" class="card-body">
						<p class="card-text text-muted">
						$desc
						</p>
						<br>
						HTML;
						if ($code != null) {
							print <<<HTML
							<pre rows="5">
							<code>$code</code>
							</pre>
							HTML;
						}
						if ($file != null) {
							$extension = pathinfo($file, PATHINFO_EXTENSION);
							if (in_array($extension, ['jpg'])) {
								print <<<HTML
								<div class="text-center">
								<img src=partials/uploads/' . $file . ' width="240" height="320" class="img-fluid align-center" alt="Responsive image">
								</div>
								HTML;
							} else {
								print <<<HTML
								<a href="partials/_download.php?file_id=' . $th_id . '">
								$file
								</a>
								<i class="text-primary bi bi-download">
								<sub>
								$downloads
								</sub>
								</i>
								</p>
								HTML;
							}
						}
						?>
                        <!-- Votes Likes Dislikes Comments and Save Thread -->
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <i <?php if (userLiked($post['th_id'])) : ?> class="bi bi-hand-thumbs-up-fill like-btn"
                                    <?php else : ?> class="bi bi-hand-thumbs-up like-btn" <?php endif ?>
                                    data-id="<?php echo $post['th_id'] ?>" data-uid="<?php echo $userid ?>">
                                </i>

                                <span class="likes"><?php echo getLikes($post['th_id']); ?></span>&nbsp;&nbsp;

                                <i <?php if (userDisliked($post['th_id'])) : ?>
                                    class="bi bi-hand-thumbs-down-fill dislike-btn" <?php else : ?>
                                    class="bi bi-hand-thumbs-down dislike-btn" <?php endif ?>
                                    data-id="<?php echo $post['th_id'] ?>" data-uid="<?php echo $userid ?>">
                                </i>

                                <span class="dislikes"><?php echo getDislikes($post['th_id']); ?></span><br>

                                <i class="bi bi-star-fill"></i>

                                <span class="votes"><?php echo getVotes($post['th_id']); ?></span>&nbsp;&nbsp;

                                <?php
								print <<<HTML
								<i class="bi bi-chat-left-text-fill"></i>
								<span class="comment_count">
								$comment_count
								</span><br>
								HTML;
								?>

                                <i <?php if (userMarked($post['th_id'])) : ?> class="bi bi-bookmark-fill marked-btn"
                                    <?php else : ?> class="bi bi-bookmark marked-btn" <?php endif ?>
                                    data-id="<?php echo $post['th_id'] ?>" data-uid="<?php echo $userid ?>">

                                </i>
                            </div>
                            <!-- User Name And Post Time -->
                            <div class="col-4">
                                <?php
								print <<<HTML
								<p>
								$u_email
								<br>
								$time
								</p>
								HTML;
								?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post Comment -->
                <?php post_comment(); ?>
                <!-- Sort -->

                <hr>
                <!-- Comments -->
                <?php
				$id = $_GET['th_id'];
				$sql = "SELECT * FROM `comments` WHERE `th_id`=$id ORDER BY `timestamp` desc";
				$noResult = true;
				$result = mysqli_query($conn, $sql);
				$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
				$parents = array();
				$child = array(); ?>
                <div class="comment-section">
                    <div class="comment-sec">

                        <?php
						foreach ($posts as $post) :

							if ($post['c_parent'] == 0) {
								print_comment($post, $posts);
							}
						endforeach;
						?>
                    </div>
                    <!--post-comment end-->
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Start Thread -->
                <?php start_thread(); ?>
                <!-- All Topics -->
                <?php include 'partials/_topics.php'; ?>
                <!-- Newsletter -->
                <?php include 'partials/_relatedPost.php'; ?>
            </div>
        </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="./assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!-- Chart JS -->
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="./assets/js/plugins/moment.min.js"></script>
    <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="./assets/demo/demo.js"></script>
    <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
    <script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    </script>
    <!--plyr video player-->
    <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
    <script>
    const player = new Plyr('#player');
    </script>

</html>

<?php
function fetch_t_name($th_t_id)
{
	global $conn;
	$sql = "SELECT `t_name` FROM `topics` WHERE `t_id`= $th_t_id";
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	$t_name = $post['t_name'];
	return $t_name;
}
function fetch_c_count($th_id)
{
	global $conn;
	$sql = "SELECT COUNT(*) FROM `comments` WHERE `th_id` = $th_id";
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	$comment_count = $post['COUNT(*)'];
	return $comment_count;
}
function fetch_mail($th_u_id)
{
	global $conn;
	$sql = "SELECT `u_email` FROM `users` WHERE `u_id` = $th_u_id";
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	$u_email = $post['u_email'];
	return $u_email;
}
function timeAgo($time_ago)
{
	$time_ago = strtotime($time_ago);
	$cur_time   = time();
	$time_elapsed   = $cur_time - $time_ago;
	$seconds    = $time_elapsed;
	$minutes    = round($time_elapsed / 60);
	$hours      = round($time_elapsed / 3600);
	$days       = round($time_elapsed / 86400);
	$weeks      = round($time_elapsed / 604800);
	$months     = round($time_elapsed / 2600640);
	$years      = round($time_elapsed / 31207680);
	// Seconds
	if ($seconds <= 60) {
		return "just now";
	}
	//Minutes
	else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "one minute ago";
		} else {
			return "$minutes minutes ago";
		}
	}
	//Hours
	else if ($hours <= 24) {
		if ($hours == 1) {
			return "an hour ago";
		} else {
			return "$hours hrs ago";
		}
	}
	//Days
	else if ($days <= 7) {
		if ($days == 1) {
			return "yesterday";
		} else {
			return "$days days ago";
		}
	}
	//Weeks
	else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	}
	//Months
	else if ($months <= 12) {
		if ($months == 1) {
			return "a month ago";
		} else {
			return "$months months ago";
		}
	}
	//Years
	else {
		if ($years == 1) {
			return "one year ago";
		} else {
			return "$years years ago";
		}
	}
}
?>