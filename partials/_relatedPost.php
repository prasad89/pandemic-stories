<div  class="list-group mt-3" id="scroll" style="width: 22rem;">
  <?php
  $sql = "SELECT *, MATCH(th_title, th_description) AGAINST('$title') AS score FROM threads WHERE MATCH(th_title, th_description) AGAINST('$title') && th_id!=$th_id ORDER BY score DESC LIMIT 5";
  $result = mysqli_query($conn, $sql);
  $remaining_num = 5 - mysqli_num_rows($result);
  echo'<a  href="#" class="list-group-item text-center active">
  Related Posts 
    </a>';
  while($row = mysqli_fetch_assoc($result)){
    $r_th_id = $row['th_id'];
    $thread_name = $row['th_title'];
    echo'<a id="news101" href="thread.php?th_id='.$r_th_id.'" class="list-group-item text-center">
    ' . $thread_name . '
   </a>';
  }
  //$remaining_num = $remaining_num - 5;
  $sql = "SELECT * FROM `threads` WHERE th_t_id=$th_t_id && th_id!=$th_id limit $remaining_num";
  $result = mysqli_query($conn, $sql);
  if($result)
    echo mysqli_error($conn);
  while($row = mysqli_fetch_assoc($result)){
    $r_th_id = $row['th_id'];
    $thread_name = $row['th_title'];
    echo'<a id="news101" href="thread.php?th_id='.$r_th_id.'" class="list-group-item text-center">
    ' . $thread_name . '
   </a>';
  }
  
  ?>
</div>
