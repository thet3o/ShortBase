<?php

    include "database.php";
    //include "cookie.php";

    session_start();
    session_unset();

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        loginUser($_POST['email'], $_POST['password']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>ShortBase</title>
</head>
<body>
    <div class="h-screen flex flex-col justify-center items-center bg-amber-100 gap-2">
        <?php
            if(isset($_COOKIE['signup']) && $_COOKIE['signup'] === 'true'){
                echo '<div class="p-4 mb-4 text-sm font-bold text-green-500 rounded-lg bg-green-100" role="alert">
                <span class="font-medium">Registrazione andata a buon fine!</span>
              </div>';            
            }
        ?>
        <p class="text-3xl">ShortBase Login</p>
        <form method="post">
            <div class="mb-4">
                <input type="text" name="email" placeholder="Email" required value=<?php echo $_COOKIE["last_email"] ?? "" ?> ></input>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" required/>
            </div>
            <div class="mb-4 flex justify-center text-center">
                <input type="submit" value="Login" class="rounded bg-amber-200 w-4/5"/>
                <a href="signup.php" value="SignUp" class="rounded bg-amber-50 w-4/5">SignUp</a>
            </div>
        </form>
    </div>
</body>
</html>
