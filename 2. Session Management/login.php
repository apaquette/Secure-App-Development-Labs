<html>
<head>
<title>Login</title>
</head>
    

    <?php
        // regenerates a new session token on each page refresh
        // Prevent the session cookie being accessed on the client with JavaScript
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1); // Ensuring session ID cannot be passed through URL

        session_start();
        
        $_SESSION['id'] = 'auth';   //set session id for cookie

        session_regenerate_id();

        if(isset($_POST['Login'])){
            session_regenerate_id();
            setcookie($_SESSION['id'], session_id());
            //navigate to authenticated
            echo "<script type='text/javascript'>location.href = 'authenticated.php';</script>";
        }else{
            //render login page
            echo '
            <h1>Login</h1>
            <form method="post"> 
                <input type="submit" name="Login" class="button" value="Login" />
            </form>
            ';
        }

    ?>

    
</html>