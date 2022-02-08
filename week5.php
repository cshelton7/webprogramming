

        <?php
            define( 'DB_HOST', 'localhost' );
            define ('DB_CREDS', 'cshelton7');

        //functions I need
            function connServer() {
                //connecting to the MySQL server
        
                $conn = mysqli_connect(DB_HOST, DB_CREDS, DB_CREDS, DB_CREDS);
        
                //ensure connection is working
                if (!$conn) {
                    die("I'm sorry, your connection failed: " . mysqli_connect_error());
                }
        
                //close the connection
                mysqli_close($conn);
            }

            function insertPeople($firstname, $lastname, $number) {
                //connecting to the MySQL server & checking connection
                $conn = mysqli_connect(DB_HOST, DB_CREDS, DB_CREDS, DB_CREDS);
                if (!$conn) {
                    die("I'm sorry, your connection failed: " . mysqli_connect_error());
                }
                
                $insert = "INSERT INTO people SET firstname = '$firstname', lastname = '$lastname', telephonenumber = '$number'";
        
                //pass insert data into db
                $result = $conn->query($insert);
            
        
                //close the connection
                mysqli_close($conn);
            }


             //show information from the database
            function peopleInfo() {
                //connecting to the MySQL server & checking connection
                $conn = mysqli_connect(DB_HOST, DB_CREDS, DB_CREDS, DB_CREDS);
                if (!$conn) {
                    die("I'm sorry, your connection failed: " . mysqli_connect_error());
                }

                //access people table
                $sql = "SELECT * FROM people";
                $result = mysqli_query($conn, $sql);

                //show the information about the people
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $delurl = "[<a href='https://codd.cs.gsu.edu/~cshelton7/week5.php?cmd=delete&id={$row['id']}'>delete</a>]";
                        echo "ID: " . $row["id"] . " Name: " . $row["firstname"] . " " . $row["lastname"] . " Number: " . $row["telephonenumber"] . " $delurl<br>";
                    }
                }
                else {
                    echo "No results.";
                }

                //close the connection
                mysqli_close($conn);
            }

            function deletePeople($id) {
                //connecting to the MySQL server & checking connection
                $conn = mysqli_connect(DB_HOST, DB_CREDS, DB_CREDS, DB_CREDS);
                if (!$conn) {
                    die("I'm sorry, your connection failed: " . mysqli_connect_error());
                }
                
                $del = "DELETE FROM people WHERE id = '$id' ";
                
                $result = $conn->query($del);
                
                mysqli_close($conn);
            }
            
        ?>
        
        
        <form method="get">
            First Name: <input type="text" name="firstn"><br>
            Last Name: <input type="text" name="lastn"><br>
            Phone Number: <input type="text" name="telnum"><br>
            <input type="submit" value="Submit">
        </form>

        <?php
            //check & get information to the db
            if ($_GET['lastn'] && $_GET['firstn'] != ''){
                insertPeople($_GET['firstn'], $_GET['lastn'], $_GET['telnum']);   
            }

            if($_GET['cmd'] == 'delete') {
                $id = $_GET['id'];
                deletePeople($id);
            }

        peopleInfo();
              
        ?>
