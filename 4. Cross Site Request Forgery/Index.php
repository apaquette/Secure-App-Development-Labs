<html>
<head>
<title>CSRF Example</title>

</head>
<?php require_once 'header.php'; ?>

<body>
    <form method="post" action="">
        <input type="submit" name="createDatabase" value="Create / Reset Database & Table">
        <br><br><br>
                                
    </form>

<?php
    session_start();
    $_SESSION['CSRFToken'] = bin2hex(random_bytes(35));
?>
	
<form action="Transfer.php" method="GET">
Account From: <input type="number" name="from"><br>
Account To: <input type="number" name="To"><br>
Value <input type="number" name="Value"><br>
<input type="hidden" id="CSRFToken" name="CSRFToken" value="<?php echo $_SESSION['CSRFToken'] ?? '' ?>">
<input type="submit">
</form>

<?php
        $host = "localhost";
        $username = "TEST";
        $password = "";
	
        if (isset($_POST['createDatabase'])) {
        try {
            // Connect to MySQL server
            $conn = new PDO("mysql:host=$host", $username, $password);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$existingDatabases = $conn->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
            echo "<br>";
                                                
            if (!in_array('acc', $existingDatabases)) {
                // Create a new database
                $sql = "CREATE DATABASE acc";
                $conn->exec($sql);
                echo "Database created successfully<br>";
                $sql = "USE acc";
                $conn->exec($sql);
                                                                
                // Create a table called 'users' with a clear text password field
                $sql = "CREATE TABLE IF NOT EXISTS `balance` (
					`AccountNumber` int(11) NOT NULL,
					`value` int(11) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                
				$conn->exec($sql);
				
            echo "Table 'balance' created successfully with clear text passwords<br>";   
            } else {
                echo "Database 'acc' already exists<br>";
                $sql = "USE acc";
                $conn->exec($sql);
                                                                
                // Reset records in the 'users' table
                $sql = "DELETE FROM balance";
                $conn->exec($sql);
                echo "Records in 'balance' table reset<br>";
            }
				$dummyRecords = array(
                array("1", "100"),
                array("2", "200"),
                array("3", "300"),
                array("4", "400"),
                array("5", "500")
            );
                                                
                foreach ($dummyRecords as $record) {
                $accNo = $record[0];
                $bal = $record[1];
                $sql = "INSERT INTO balance (AccountNumber, value) VALUES ('$accNo', '$bal')";
                $conn->exec($sql);
            }

            echo "5 dummy records inserted successfully<br>";
			
			
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
	}

?>

</body>
</html>