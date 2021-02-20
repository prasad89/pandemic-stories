<?php
function start_thread()
{
  global $conn;
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $userid = $_SESSION['u_id'];
    // If user is logged in
    print <<<HTML
  <button type="button" class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#startThread" style="width: 22rem;">Start New Thread</button>
    <div class="modal fade" id="startThread" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Start New Thread</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">

    <form action="partials/postingThread.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="exampleFormControlSelect1">Select Topic</label>
    <select class="form-control" style="color:black;" id="exampleFormControlSelect1" name="t_id">
  HTML;
    $sql = "SELECT * FROM `topics`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['t_id'];
      $top = $row['t_name'];
      print <<<HTML
      <option value="$id">$top</option>
      HTML;
    }
    print <<<HTML
    </select>
    <label for="formGroupExampleInput">Title</label>
    <input style="color:black;" type="text" class="form-control" id="formGroupExampleInput" placeholder="Title" name="title" required>
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="editor1"  placeholder="Description" name="desc" required></textarea> 
    <!-- <label for="exampleFormControlTextarea1">Code</label> -->
    <!-- <textarea class="form-control" style="border:solid black 1px;color:black;" id="exampleFormControlTextarea1" placeholder="Code" rows="2" name="code"></textarea> -->
    <div class="form-group">
    <label for="exampleFormControlFile1">Attach File</label>
    <input style="color:black;opacity:1;" type="file" class="form-control-file" id="exampleFormControlFile1" name="myfile">
    </div>  
    </div>
    </div>
    <div class="modal-footer">
    <input type="hidden" name="u_id" value="$_SESSION[u_id]">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" id="submit" value="submit" class="btn btn-primary" style="width: 5rem;">Post</button>
    </form>
          </div>
        </div>
      </div>
    </div>
    HTML;
  } else {
    // If user is not logged in
    print <<<HTML
    <button type="button" class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#startThread" style="width: 22rem;" disabled>Please login to start new thread</button>
    HTML;
  }
}