<?php
    session_start();
    session_unset();

    if(isset($_POST['email']) && isset($_POST['password']))
    {
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ShortBase</title>
</head>
<body>
    <div class="h-screen flex flex-col justify-center items-center bg-amber-100 gap-2">
        <p class="text-3xl">ShortBase Login</p>
        <form>
            <div class="mb-4">
                <input type="text" name="email" placeholder="Email" required/>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" required/>
            </div>
            <div class="mb-4 flex justify-center">
                <input type="submit" value="Login" class="rounded bg-amber-200 w-4/5"/>
            </div>
        </form>
    </div>
</body>
</html>