<!DOCTYPE html>
<html>
<body>

<?php require_once 'header.php'; ?>

<?php 
    $goto = "";
    if(isset($_GET["loc"])){
        $goto = $_GET["loc"];
    }

    if(isInternalURL($goto)){
        echo "<script>location.href='$goto';</script>";
    }
?>

</body>
</html>
