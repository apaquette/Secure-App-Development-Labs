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
    $loc_head = "Location: " . $goto;
    header($loc_head); 
}
?>

</body>
</html>