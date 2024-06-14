<?php

$value = 'This_is_a_Top-Secret_cookie_and_should_never_be_exposed...';

setcookie("TestCookie", $value);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header('X-XSS-Protection: 0;');

?>