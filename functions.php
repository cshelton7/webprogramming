<?php
    define( 'DB_HOST', 'localhost' );

    function showToday() {
        echo date("m-d-Y h:i");
    }

    function connServer() {
        //connecting to the MySQL server
        $cred = "cshelton7";

        $conn = mysqli_connect(DB_HOST, $cred, $cred, $cred);

        //ensure connection is working
        if (!$conn) {
            die("I'm sorry, your connection failed: " . mysqli_connect_error());
        }

        //access people table
        $sql = "SELECT * FROM people";
        $result = mysqli_query($conn, $sql);

        //show the information about the people
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "ID " . $row["id"] . "Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
            }
        }
        else {
            echo "No results.";
        }

        //close the connection
        mysqli_close($conn);
    }
?>