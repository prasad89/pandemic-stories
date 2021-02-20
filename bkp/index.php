<?php include 'partials/_dbconnect.php'; ?>
<?php include 'partials/_handleThread.php'; ?>

<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Forum</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer-navbar/">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap 4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="fontawesome-pro-5.13.0-web\css\all.min.css">
  <!-- Highlight CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/monokai-sublime.min.css">
  <!-- Highlight JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
  <script type='text/javascript'>
    hljs.initHighlightingOnLoad();
  </script>
  <!-- Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles -->
  <link href="bootstrap 4.5.2/sticky-footer-navbar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <!-- Custom js -->
  <script type='text/javascript' src="js/_handleThread.js">
  </script>
</head>

<body class="d-flex flex-column h-100">
  <?php include 'partials/_header.php'; ?>
  <!-- Begin page content -->
  <main role="main" class="flex-shrink-0">
    <div class="container">
      <div class="row">
        <!-- Recent Threads -->
        <div class="col-sm-8">
          <ul class="list-group list-group-flush mt-3">
            <?php
            $sql = "SELECT * FROM `threads` ORDER BY `timestamp` DESC LIMIT 50";
            $result = mysqli_query($conn, $sql);
            if ($result)
              $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
            else
              echo mysqli_error($conn);
            foreach ($posts as $post) :
              $th_id = $post['th_id'];
              $th_title = $post['th_title'];
              $desc = $post['th_description'];
              $code = $post['th_code'];
              $file = $post['fname'];
              $downloads = $post['fdownloads'];
              $filepath = 'uploads/' . $file;
              $time = $post['timestamp'];
              $time = date('g:i A, l - d M Y', strtotime($time));
              $th_t_id = $post['th_t_id'];
              $t_name = fetch_t_name($th_t_id);
              $comment_count = fetch_c_count($th_id);
              $th_u_id = $post['th_u_id'];
              $u_email = fetch_mail($th_u_id);
              echo '<li class="list-group-item text-primary">
              <span class="badge badge-primary badge-pill">
              ' . $t_name . '
              </span>
              ' . $th_title . '
              <p class=text-muted>
              ' . $desc . '
              <br>';
              if ($code != null) {
                echo '<pre rows="5">
                <code>' . $code . '</code>
                </pre>';
              }
              if ($file != null) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if (in_array($extension, ['jpg'])) {
                  echo '<div class="text-center">
                  <img src=uploads/' . $file . ' width="240" height="320" class="img-fluid align-center" alt="Responsive image">
                  </div>';
                } else {
                  echo '<a href="partials/_downloads.php?file_id=' . $th_id . '">
                  ' . $file . '
                  </a>
                  <i class="bi bi-download">
                  <sub>
                  ' . $downloads . '
                  </sub>
                  </i>
                  </p>';
                }
              }
            ?>
              <!-- Votes Likes Dislikes Comments and Save Thread -->

              <div class="row justify-content-between">
                <div class="col-4">
                  <!-- if user likes post, style button differently -->
                  <i <?php if (userLiked($post['th_id'])) : ?> class="bi bi-hand-thumbs-up-fill like-btn" <?php else : ?> class="bi bi-hand-thumbs-up like-btn" <?php endif ?> data-id="<?php echo $post['th_id'] ?>" data-uid="<?php echo $userid ?>">
                  </i>
                  <sub>
                    <span class="likes"><?php echo getLikes($post['th_id']); ?></span>
                  </sub>&nbsp;&nbsp;
                  <!-- if user dislikes post, style button differently -->
                  <i <?php if (userDisliked($post['th_id'])) : ?> class="bi bi-hand-thumbs-down-fill dislike-btn" <?php else : ?> class="bi bi-hand-thumbs-down dislike-btn" <?php endif ?> data-id="<?php echo $post['th_id'] ?>">
                  </i>
                  <sub>
                    <span class="dislikes"><?php echo getDislikes($post['th_id']); ?></span>
                  </sub><br>
                  <i class="bi bi-star-fill"></i>
                  <sub>
                    <span class="votes"><?php echo getVotes($post['th_id']); ?></span>
                  </sub>&nbsp;&nbsp;
                  <?php echo '<i class="bi bi-chat-left-text-fill"></i>
              <sub>
              <span class="comment_count">
              ' . $comment_count . '
              </span>
              </sub><br>';
                  ?>
                  <i <?php if (userMarked($post['th_id'])) : ?> class="bi bi-bookmark-fill marked-btn" <?php else : ?> class="bi bi-bookmark marked-btn" <?php endif ?> data-id="<?php echo $post['th_id'] ?>">
                  </i>
                </div>
                <div class="col-4">
                  <?php
                  echo '<p>
            ' . $u_email . '
            <br>
            ' . $time . '
            </p>';
                  ?>
                </div>
              </div>

            <?php endforeach ?>
          </ul>
          <!-- Pagination -->
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </div>
        <!-- All Topics -->
        <div class="col-sm-4">
          <div class="list-group mt-3" id="scroll" style="width: 22rem;">
            <?php
            $sort = "newest";
            $sql = "SELECT * FROM `topics`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['t_id'];
              $top = $row['t_name'];
              $num = num_quest($id);
              echo '<a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        ' . $top . '
        <span class="badge badge-primary badge-pill">
        ' . $num . '
        </span>
        </a>';
            }
            function num_quest($t_id)
            {
              global $conn;
              $sql = "SELECT COUNT(*) FROM `threads` WHERE `th_t_id` = $t_id";
              $result = mysqli_query($conn, $sql);
              $num = mysqli_fetch_assoc($result);
              return $num['COUNT(*)'];
            }
            ?>
          </div>
          <!-- Newsletter -->
          <div class="card mt-3 mb-3" style="width: 22rem;">
            <img src="images/news-card.jpg" class="img-fluid align-center" alt="...">
            <div class="card-body">
              <h5 class="card-title">Newsletter-title</h5>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas libero libero, dapibus at euismod in, tristique eget nulla. Donec tincidunt risus quis dui sodales pretium.
              </p>
              <a href="#" class="btn btn-primary">Read</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include 'partials/_footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="bootstrap 4.5.2/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="bootstrap 4.5.2/js/bootstrap.bundle.min.js"></script>

</html>



<?php
function fetch_t_name($th_t_id)
{
  global $conn;
  $sql = "SELECT `t_name` FROM topics WHERE `t_id`= $th_t_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $t_name = $row['t_name'];
  return $t_name;
}
function fetch_c_count($th_id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM `comments` WHERE `th_id` = $th_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $comment_count = $row['COUNT(*)'];
  return $comment_count;
}
function fetch_mail($th_u_id)
{
  global $conn;
  $sql = "SELECT `u_email` FROM `users` WHERE `u_id` = $th_u_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $u_email = $row['u_email'];
  return $u_email;
}
?>