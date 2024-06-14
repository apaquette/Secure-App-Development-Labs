<html>
<head>
<title>XSS Filter</title>
...
</head>

<?php require_once 'header.php'; ?>


Hello 

<?php

	echo '<BR>';
	echo RemoveXSS($_POST["name"]);

?>

</html>