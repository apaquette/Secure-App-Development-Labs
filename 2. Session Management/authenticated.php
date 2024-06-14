<html>
<head>
    <title>Authenticated</title>
</head>
    

    <?php
        $IPAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        session_start();

        if( !isset($_SESSION['id']) ||                  //if session id isn't set
            !isset($_COOKIE[$_SESSION['id']]) ||        //if cookie isn't set
            $_COOKIE[$_SESSION['id']] != session_id())  //if cookie id doesn't match the session id
        {
            session_destroy();
            echo "<script type='text/javascript'>location.href = 'login.php';</script>";
        }
        else if(isset($_POST['Logout']))    //if logout was clicked
        {
            echo "<script type='text/javascript'>location.href = 'logout.php';</script>";
        }
        else //render authenticated page
        {
            echo '<h1>Authenticated</h1>
            <form method="post"> 
                <input type="submit" name="Logout" class="button" value="Logout" />
            </form>
            ';
        }

        ?>
    
</html>
