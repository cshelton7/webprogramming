<?php
define( 'DB_NAME', 'cshelton7' );
define( 'DB_USER', 'cshelton7');
define( 'DB_PASSWORD', 'cshelton7' );
define( 'DB_HOST', 'localhost' );

function DeleteCarEntry($id) {

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	
	$del = "DELETE FROM Cars WHERE id = '$id' ";
	
	$result = $conn->query($del);
	
	mysqli_close($conn);
}

function InsertMake($make) {

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	
	$insert = "INSERT INTO Cars SET make = '$make' " ;
	
	$result = $conn->query($insert);
	
	mysqli_close($conn);
}



function ShowCars() {
// Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT id, make FROM Cars";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
	  while($row = mysqli_fetch_assoc($result)) {
	  	$delurl = "[<a href='https://codd.cs.gsu.edu/~cshelton7/week5example.php?cmd=delete&id={$row['id']}'>delete</a>]";
		echo "id: " . $row["id"]. " Make: " . $row["make"]. " $delurl<br>";
	  }
	} else {
	  echo "0 results";
	}

	mysqli_close($conn);
}

?>

<form method="get">
  Car Make: <input type="text" name="carmake"><br>
  <input type="submit" value="Submit">
</form>

<?php
if($_GET['carmake'] != '') {
	InsertMake($_GET['carmake']);
}

if($_GET['cmd'] == 'delete') {
	$id = $_GET['id'];
	DeleteCarEntry($id);
}

ShowCars();
?>