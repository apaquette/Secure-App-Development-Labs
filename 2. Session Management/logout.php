<html>
    <head>
        <title>Session Terminated</title>
    </head>
    <h1>Session Terminated</h1>
    <?php
        session_start();
		
		// remove all session variables
		session_unset();
		
		// destroy the session
		session_destroy(); 
    ?>
</html>