<?php
    function isInternalURL($url){
        $allowedPages = array("testPage1.php", "testPage2.php", "testPage3.php");
        return (in_array($url, $allowedPages));
    }
?>