<?php
    
    if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != "/" && $_SERVER['REQUEST_URI'] != "/login.php" && $_SERVER['REQUEST_URI'] != "/signup.php" && $_SERVER['REQUEST_URI'] != "/dashboard.php")
    {
        include 'database.php';
        $res = getLongUrlByCode(substr($_SERVER['REQUEST_URI'], 1));
        if($res)
        {
            header("Location: $res");
        }else{
            header("Location: /");
        }
    }else{
        session_start();
        if(isset($_SESSION['email']) && $_SESSION['email'] != "")
        {
            header("Location: dashboard.php");
        }else{
            header("Location: login.php");
        }
    }

?>