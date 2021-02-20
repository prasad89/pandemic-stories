<div class="list-group mt-3" id="scroll" style="width: 22rem;">
  <?php
  $sort = "newest";
  $sql = "SELECT * FROM `topics`";
  $result = mysqli_query($conn, $sql);
  echo'<a href="#" class="list-group-item text-center active">
  Topics 
    </a>';
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['t_id'];
    $top = $row['t_name'];
    $num = num_quest($id);
    echo'<a id="topics101" href="threadlist.php?topid=' . $id . '&sort=' . $sort . '" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center topics1">
    ' . $top . '
    <span class="badge badge-primary badge-pill">
    ' . $num . '
    </span>
    </a>';
  }
  function num_quest($t_id){
    global $conn;
    $sql = "SELECT COUNT(*) FROM `threads` WHERE `th_t_id` = $t_id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_fetch_assoc($result);
    return $num['COUNT(*)'];
  }
  ?>
</div>
