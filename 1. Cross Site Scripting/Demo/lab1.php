<!-- <!DOCTYPE html> -->
<html>
<head>
    <title>XSS 06</title>
</head>
<body>
<?php require_once 'header.php'; ?>
<?php
    if(isset($_GET["name"])){
        echo "Hello ".($_GET["name"]);
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
Your name: <input type="text" name="name">
<input type="submit" name="submit">
</form>

</body>
</html>