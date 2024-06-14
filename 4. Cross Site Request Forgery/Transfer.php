<html>
<head>
<title>CSRF Example</title>
...
</head>

<?php require_once 'header.php'; ?>

<?php
session_start();
$FromAccount = 0;
$ToAccount = 0;
$TransferValue = 0;
$Value_available = 0;
$ToBalance = 0;

$FromAccount = $_GET["from"];
$ToAccount = $_GET["To"];
$TransferValue = $_GET["Value"];


$servername = "localhost";
$username = "TEST";
$password = "";
$dbName = "acc";

//Cookie Pass Test
//TestCookie

$CookieString = $_COOKIE["TestCookie"];

//$CookieInfo = session_get_cookie_params();
	if(!isset($_SESSION['CSRFToken']) || !isset($_GET["CSRFToken"]) || !$_GET["CSRFToken"] || $_GET["CSRFToken"] != $_SESSION['CSRFToken'] || $CookieString != "This_is_a_Top-Secret_cookie_and_should_never_be_exposed..."){
		echo "Incorrect cookie Value ";
		session_destroy();
	}
	else
	{
		echo "Has Correct cookie Value Continue with transfer....................<br><br>";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbName);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}else{
			echo "Before Transfer.......................................<br><br>";
		}

		//Get the balance in the from account
		$Value_available = GetFromBal($FromAccount, $conn); 


		If($TransferValue <= $Value_available)
		{
			//Get the balance in the too account
			$ToBalance = GetToBalance($ToAccount,$TransferValue, $conn);
			
			//Perform transfer
			UpdateAccounts($ToBalance,$ToAccount,$Value_available,$FromAccount,$TransferValue, $conn);

		} else{
			
			echo "Insufficient Funds <br><br>";
		}

		echo "After Transfer.......................................<br><br>";
		//Get the balance in the from accounts and display
		$Value_available = GetFromBal($FromAccount, $conn); 
		$ToBalance = GetToBalance($ToAccount,$TransferValue, $conn);

		$conn->close();

		session_unset();
	}





function GetToBalance($ToAccount,$TransferValue, $conn) {
	
	$ToBalance=0;
	
	$sql = "SELECT value FROM balance WHERE AccountNumber = " .$ToAccount;
	//echo $sql. "<br><br>";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		echo "Account Number:" .$ToAccount. " contains " .$row["value"]. "<br><br>";
		$ToBalance = $row["value"];
		$ToBalance = $ToBalance + $TransferValue;

		
	}else {
	  echo "0 results";
	}
	
	return $ToBalance;
}

function UpdateAccounts($ToBalance,$ToAccount,$Value_available,$FromAccount,$TransferValue, $conn) {
	
  // Add funds to the Too account
	$sql = "UPDATE balance SET value= " .$ToBalance. " WHERE AccountNumber = " .$ToAccount;
	//echo $sql. "<br><br>";
	$result = $conn->query($sql);
		
	// Remove funds in from account
	$Value_available = $Value_available - $TransferValue;
	$sql = "UPDATE balance SET value= " .$Value_available. " WHERE AccountNumber = " .$FromAccount;
	//echo $sql. "<br><br>";
	$result = $conn->query($sql);
	//Update From Account Balance

}

function GetFromBal($FromAccount, $conn) {
	
	$sql = "SELECT value FROM balance WHERE AccountNumber = " .$FromAccount;
	echo $sql. "<br><br>";
	$result = $conn->query($sql);


	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		echo "Account Number:" .$FromAccount. " contains " .$row["value"]. "<br><br>";
		$balance_available = $row["value"];

	}else {
	  echo "0 results";
	}
	return $balance_available;
}




?>

</html>