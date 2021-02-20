<style type="text/css">
    h6 {
        color: white;
    }

    p {
        color: white;
    }
</style>
<?php
function print_comment($post, $child)
{
    global $conn;
    global $th_id;
    $cid = $post['c_id'];
    $content = $post["c_content"];
    $code = $post['c_code'];
    $time = $post['timestamp'];
    $time = timeAgo($time);
    $user_id = $post['comment_by'];
    $sql2 = "SELECT u_email FROM `users` WHERE u_id=$user_id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $u_email = $row2['u_email'];

    print <<<HTML
<a class="collap"  data-toggle="collapse" data-target="#collapse$cid"> 
 <i class="fas fa-plus float-right "></i> 
</a>
 <ul style="list-style-type: none;border-left:dashed black 1px;border-bottom: dashed grey 1px; ">
                    
 <div class="comment-list collapse show " id="collapse$cid" >

<div class="comment">

<p> $u_email &nbsp<span><img src="images/clock.png" alt=""> $time ago</span></p>
<h6> $content  </h6>
<a class="mt-0 mb-1" role="button" data-toggle="collapse" href="#reply$cid" aria-expanded="false"  aria-controls="collapseExample"><i class="fa fa-reply-all"></i>Reply</a>&nbsp&nbsp
HTML;
    if ($code != null) {
        print <<<HTML
    <a class="mt-0 mb-1" role="button" data-toggle="collapse" href="#code$cid" aria-expanded="false"  aria-controls="collapseExample">View Code</a>&nbsp&nbsp
    HTML;
    }
    if (userCLiked($post['c_id'])) {
        print <<<HTML
	<i class="bi bi-hand-thumbs-up-fill Clike-btn text-primary"  data-id="$cid" ?></i>&nbsp
	HTML;
    } else {
        print <<<HTML
	<i class="bi bi-hand-thumbs-up Clike-btn text-primary"  data-id="$cid" ?></i>&nbsp
	HTML;
    }
    echo '
<span class="Clikes text-primary">' . getClikes($cid) . '</span>&nbsp;
';
    if (userCDisliked($post['c_id'])) {
        print <<<HTML
	<i class="bi bi-hand-thumbs-down-fill Cdislike-btn text-primary"  data-id="$cid" ?></i>&nbsp
	HTML;
    } else {
        print <<<HTML
	<i class="bi bi-hand-thumbs-down Cdislike-btn text-primary"  data-id="$cid" ?></i>&nbsp
	HTML;
    }
    echo '
<span class="Cdislikes text-primary">' . getCdislikes($cid) . '</span>&nbsp;&nbsp;
';
    print <<<HTML
<div class="collapse" id="code$cid">
    <pre rows="5">
              <code>$code</code>
              </pre>
</div>
HTML;

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $u_id = $_SESSION['u_id'];
        print <<<HTML
<div class="collapse" id="reply$cid">
    <form action="partials/_postingComment.php" method="post">
        <div class="form-group">
            <label for="comment">Your Comment</label>
            <textarea class="form-control" name="comment" rows="2"></textarea>
        </div>
         
        <input type="hidden" name="code">
        <input type="hidden" name="u_id" value="$u_id">
        <input type="hidden" name="p_id" value="$cid">
        <input type="hidden" name="th_id" value="$th_id">
        <input type="submit" class="btn btn-primary">
    </form>
</div>
HTML;
    }
    foreach ($child as $temp) :
        if ($temp['c_parent'] == $cid)
            print_comment($temp, $child);
    endforeach;
    echo '
		</div>
			</div>
			</li>
     			</ul>
     ';
}
?>