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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
</body>
</html>