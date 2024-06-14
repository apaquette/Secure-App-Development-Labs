<!DOCTYPE html>
<html>
<head>
    <title>Database Creation</title>
</head>
<body>
    <form method="post" action="">
        <input type="submit" name="createDatabase" value="Create / Reset Database & Table">
                                <br><br><br>
                                
    </form>
                
                <form action="sqli.php" method="post">
    <div class="login-box">        
            <label for="loginName">Login Name</label> 
            <input type="text" name="loginName" id="loginName" autocomplete="off" required><br><br>
            <label for="password">Password</label>
            <input type="password" name="passWord" id="passWord" required><br><br>
            <input type="submit" value="Submit">
        </form>
        <form action="sqli.php" method="post">

<?php
    $host = "localhost";
    $username = "TEST";
    $password = "";
                                
	if(isset($_POST['loginName']) && isset($_POST['passWord'])) {
    $Uname = $_POST['loginName'];
    $Pword = $_POST['passWord'];

		try {
            // Connect to MySQL server
        $conn = new PDO("mysql:host=$host", $username, $password);
        $sql = "USE sqlidb";
        $conn->exec($sql);
                                                
        // Check if username and password are correct
        //$query = "SELECT * FROM users WHERE username = '$Uname' AND password = '$Pword'";
        echo "<br><br>";
		//  Check if username and password are correct
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bindParam(1, $Uname);
        $stmt->bindParam(2, $Pword);
        
        // echo $query;
        
        //$result = $conn->query($query);
        $result = $stmt->execute();
        $rowCount = $stmt->rowCount();
        
        if($result === false) {
            echo "Error: " . $query . "<br>";
        }
        elseif($rowCount > 0) {
            // Login successful, store session variable
            echo "<br><br><h1>Login successful!</h1><br><br>";
        }
        else {
			echo "<br><br><h1>Login failed!</h1><br><br>";
        }
                        
        }
		catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        catch (exception $e) { // catch all
            echo "Error: " . $e->getMessage();
        }
                }
    
                
        if (isset($_POST['createDatabase'])) {
        try {
            // Connect to MySQL server
            $conn = new PDO("mysql:host=$host", $username, $password);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$existingDatabases = $conn->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
            echo "<br>";
                                                
            if (!in_array('sqlidb', $existingDatabases)) {
                // Create a new database
                $sql = "CREATE DATABASE sqlidb";
                $conn->exec($sql);
                echo "Database created successfully<br>";
                $sql = "USE sqlidb";
                $conn->exec($sql);
                                                                
                // Create a table called 'users' with a clear text password field
                $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL
            )";
                                                $conn->exec($sql);
            echo "Table 'users' created successfully with clear text passwords<br>";   
            } else {
                echo "Database 'sqlidb' already exists<br>";
                $sql = "USE sqlidb";
                $conn->exec($sql);
                                                                
                // Reset records in the 'users' table
                $sql = "DELETE FROM users";
                $conn->exec($sql);
                echo "Records in 'users' table reset<br>";
            }
				$dummyRecords = array(
                array("user1", "password1"),
                array("user2", "password2"),
                array("user3", "password3"),
                array("user4", "password4"),
                array("user5", "password5")
            );
                                                
                foreach ($dummyRecords as $record) {
                $username = $record[0];
                $password = $record[1];
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                $conn->exec($sql);
            }

            echo "5 dummy records inserted successfully<br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null; // Close the database connection
    }
    ?>
                
</body>
</html>
