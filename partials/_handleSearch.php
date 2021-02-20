<?php include '_dbconnect.php';?>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// Check connection
if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_REQUEST["term"])){
    // Prepare a select statement
	$sql = "SELECT * FROM threads WHERE th_title LIKE "."'". '%'.$_REQUEST["term"] . '%'."'";
	$result = mysqli_query($conn,$sql);
            // Check number of rows in the result set
	if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<p>" . $row["th_title"] . "</p>";
		}
	} 
	else{
		echo "<p>No matches found</p>";
	}
}
?>