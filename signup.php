<?php

    include "database.php";

    // Elimina cookie se pre esistente
    setcookie("signup", "", time() - (60));

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword']))
    {
        // Registrazione utente
        if(signupUser($_POST['email'], $_POST['password'],$_POST['repassword'],$_POST['username'])){
            // Cookie signup a true registrazione riuscita
            setcookie("signup", "true", time() + (60));
            header("Location: login.php");
        }else{
            // Cookie signup a false registrazione fallita
            setcookie("signup", "false");
            header("Location: signup.php");
        }
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
            if(isset($_COOKIE['signup']) && $_COOKIE['signup'] === 'false'){
                echo '<div class="p-4 mb-4 text-sm font-bold text-red-500 rounded-lg bg-red-100" role="alert">
                <span class="font-medium">Registrazione fallita!</span>
              </div>';            
            }
        ?>
        <p class="text-3xl">ShortBase SignUp</p>
        <form method="post">
            <div class="mb-4">
                <input type="text" name="email" placeholder="Email" required/>
                <input type="text" name="username" placeholder="Username" required/>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" required/>
                <input type="password" name="repassword" placeholder="Retype Password" required/>
            </div>
            <div class="mb-4 flex justify-center">
                <input type="submit" value="SignUp" class="rounded bg-amber-200 w-4/5"/>
            </div>
        </form>
    </div>
</body>
</html>