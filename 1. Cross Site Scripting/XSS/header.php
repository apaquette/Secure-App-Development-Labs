<?php

$value = 'This_is_a_Top-Secret_cookie_and_should_never_be_exposed...';

setcookie("TestCookie", $value,  null, '/', null, null, true);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header('X-XSS-Protection: 0;');

?>