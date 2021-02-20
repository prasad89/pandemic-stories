<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <link rel="icon" type="image/png" href="./assets/img/corona.svg">
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
</head>

<body id="body101" class="d-flex flex-column h-100 boody">
    <!-- Header -->
    <?php include 'partials/_header.php'; ?>
    <br><br>
    <div class="hero-v1" style="background:#b5d1ff">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mr-auto text-center text-lg-left">
                    <span class="d-block subheading">Covid-19 Awareness</span>
                    <h1 class="heading mb-3">Stay Safe. Stay Home.</h1>
                    <p class="mb-4"><a href="#" class="btn btn-primary">How to prevent</a></p>
                </div>
                <div class="  col-lg-6">
                    <figure class="illustration">
                        <img src="images/illustration.png" alt="Image" class="img-fluid">
                    </figure>
                </div>
                <div class="col-lg-6"></div>
            </div>
        </div>
    </div>
    <!-- Start Thread -->
    <?php include 'partials/_startThread.php'; ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">

        <div class="container">
            <section class="forum-sec">
                <?php if (isset($_GET['sort'])) {
          $sort = $_GET['sort'];
        }
        ?>

                <?php if (isset($_GET['following'])) {
          $following = $_GET['following'];
        }
        ?>
                <div class="container">
                    <div class="forum-links" id="myDIV">
                        <ul>
                            <li class="text-muted">sort by</li>
                            <li class="<?php if ($sort == "") {
                            echo "active";
                          } ?>">
                                <a href="index.php" title="">Latest</a>
                            </li>
                            <li class="<?php if ($sort == "oldest") {
                            echo "active";
                          } ?>">
                                <a href="index.php?sort=oldest" title="">Oldest</a>
                            </li>
                            <li class="<?php if ($sort == "top") {
                            echo "active";
                          } ?>">
                                <a href="index.php?sort=top" title="">Top Voted</a>
                            </li>


                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                            <li class="text-muted">Topics</li>
                            <li class="<?php if ($following == "") {
                              echo "active";
                            } ?>">
                                <a <?php if (isset($sort)) : ?> href="index.php?sort=<?php echo $sort ?>"
                                    <?php else : ?> href="index.php" <?php endif ?> title="">All</a>
                            </li>
                            <li class="<?php if ($following == "true") {
                              echo "active";
                            } ?>">
                                <a <?php if (isset($sort)) : ?> href="index.php?following=true&sort=<?php echo $sort ?>"
                                    <?php else : ?> href="index.php?following=true" <?php endif ?>
                                    title="">Following</a>
                            </li>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-sm-8">
                    <div id="London" class="tabcontent">
                        <!-- Thread -->
                        <div class="card text-primary mt-3" style="border: solid white 1px;">
                            <?php include 'partials/_handleThread.php'; ?>
                            <?php

              if (isset($sort)) {
                switch ($sort) {
                  case "oldest":
                    if (isset($following)) {
                      $sql = "SELECT * FROM `threads` WHERE th_t_id in(SELECT t_id FROM follow_topic WHERE u_id=$userid)  ORDER BY `timestamp` asc";
                    } else {
                      $sql = "SELECT * FROM `threads`  ORDER BY `timestamp` asc";
                    }
                    $noResult = true;
                    $result = mysqli_query($conn, $sql);
                    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;
                  case "top":
                    if (isset($following)) {
                      $sql = "SELECT * FROM `threads` WHERE th_t_id in(SELECT t_id FROM follow_topic WHERE u_id=$userid)  ORDER BY `timestamp` desc";
                    } else {
                      $sql = "SELECT * FROM `threads`  ORDER BY `timestamp` desc";
                    }
                    $noResult = true;
                    $result = mysqli_query($conn, $sql);
                    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $vote = array();
                    $thread = array();
                    foreach ($posts as $post) {
                      array_push($vote, getVotes($post['th_id']));
                      array_push($thread, $post['th_id']);
                    }
                    $sortedVote = array();
                    foreach ($posts as $post) {
                      array_push($sortedVote, getVotes($post['th_id']));
                    }
                    $size = count($posts) - 1;
                    for ($i = 0; $i < $size; $i++) {
                      for ($j = 0; $j < $size - $i; $j++) {
                        $k = $j + 1;
                        if ($vote[$j] < $vote[$k]) {
                          //sorting votes by values.
                          $temp = $vote[$j];
                          $vote[$j] = $vote[$k];
                          $vote[$k] = $temp;
                          //sorting same positon as votes.
                          $temp2 = $posts[$j];
                          $posts[$j] = $posts[$k];
                          $posts[$k] = $temp2;
                        }
                      }
                    }
                    break;
                }
              } else {
                if (isset($following)) {
                  $sql = "SELECT * FROM `threads` WHERE th_t_id in(SELECT t_id FROM follow_topic WHERE u_id=$userid)  ORDER BY `timestamp` desc";
                } else {
                  $sql = "SELECT * FROM `threads`  ORDER BY `timestamp` desc ";
                }
                $result = mysqli_query($conn, $sql);
                $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
              }
              foreach ($posts as $post) :
                $th_id = $post['th_id'];
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
                $verified = fetch_verified($th_u_id);

                print <<<HTML
                <h5 id="posts102" class="card-header posts2" style="border-bottom: 1px solid white;">
                <a href="threadlist.php?topid=$th_t_id&sort=newest">
                <span class="badge badge-primary badge-pill">$t_name</a>/ <a class="text-primary" href="thread.php?th_id=$th_id">
                $title
              </a>
              </h5>
              <div style="border-bottom: 1px solid white;" class="card-body posts1" >
<br>
              <h6 class="card-text text-muted">
              $desc
              </h6>
              <br>
HTML;
                if ($code != null) {
                  print <<<HTML
                  <pre rows="5">
                    <code> $code </code>
                  </pre>
                  HTML;
                }
                if ($file != null) {
                  $extension = pathinfo($file, PATHINFO_EXTENSION);
                  if (in_array($extension, ['jpg'])) {
                    print <<<HTML
                      <div class="text-center">
                        <img src="partials/uploads/$file" width="240" height="320" class="img-fluid align-center" alt="Responsive image">
                      </div>
HTML;
                  } else if (in_array($extension, ['mp4'])) {
                    print <<<HTML
                    <video id="player" playsinline controls>
                    <source src="partials/uploads/$file" type="video/mp4" />
                      </video>
                    HTML;
                  } else {
                    print <<<HTML
                    <a href="partials/_downloads.php?file_id=$th_id">$file </a>
                    <i class="text-primary bi bi-download">
                    <sub>$downloads</sub></i>
                    </p>
HTML;
                  }
                }
              ?>
                            <!-- Votes Likes Dislikes Comments and Save Thread -->
                            <div class="row justify-content-between">
                                <div class="col-4">

                                    <i <?php if (userLiked($post['th_id'])) : ?>
                                        class="bi bi-hand-thumbs-up-fill like-btn" <?php else : ?>
                                        class="bi bi-hand-thumbs-up like-btn" <?php endif ?>
                                        data-id="<?php echo $post['th_id'] ?>" data-uid="<?php echo $userid ?>"></i>
                                    <span class="likes"><?php echo getLikes($post['th_id']); ?></span>
                                    &nbsp;&nbsp;

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
                    if($verified!= null){
                      print<<<HTML
                      <i class="bi bi-check-all">Doctor</i>
                      HTML;
                    }
                    print <<<HTML
                    <p>$u_email <br>
                    $time<br>
                    HTML;
                    if ($userid == $th_u_id) {

                      print <<<HTML
                      <button style="padding:4px 19px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#deleteThread">delete</button>&nbsp&nbsp

                      <div class="modal fade" id="deleteThread" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Deleting Post</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="partials/_deleteThread.php" method="post">
                              Are You Sure?
                            </div>
                            <div class="modal-footer">
                            <input type="hidden" name="u_id" value="$_SESSION[u_id]">
                            <input type="hidden" name="th_id" value="$th_id">
                            <input type="hidden" name="th_u_id" value="$th_u_id">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary" style="width: 5rem;">Delete</button>
                          </form>
                            </div>
                          </div>
                        </div>  
                      </div>
                      HTML;
                    }
                    echo  '</p>';
                    ?>
                                </div>
                            </div>
                        </div>

                        <?php endforeach ?>
                    </div>



                </div>

                <!-- Pagination -->
                <!-- <?php include 'partials/_pagination.php'; ?> -->
            </div>
            <div class="col-sm-4">

                <!-- Start Thread -->
                <?php start_thread(); ?>
                <!-- All Topics -->
                <?php include 'partials/_topics.php'; ?>
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

function fetch_verified($th_u_id)
{
  global $conn;
  $sql = "SELECT * FROM `users` WHERE `u_id` = $th_u_id";
  $result = mysqli_query($conn, $sql);
  $post = mysqli_fetch_assoc($result);
  $u_verified = $post['verified'];
  return $u_verified;
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