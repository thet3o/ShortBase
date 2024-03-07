<?php
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="h-screen flex flex-col justify-center items-center bg-amber-100 gap-3">
        <div>
            <p class="text-5xl"><?php echo "Benvenuto ".$_SESSION['username']?></p>
        </div>
        <div class="w-4/5 h-20 bg-amber-400 flex justify-center items-center rounded">
            <form method="post" class="w-11/12 h-4/5 grid grid-cols-3 gap-3">
                <input type="text" name="longurl" placeholder="Inserisci l'URL da ridurre" class="col-span-2 rounded" />
                <input type="submit" value="Riduci" class="col-span-1 bg-orange-400 rounded text-xl">
            </form>
        </div>
        <div class="flex flex-col">
            <p class="text-3xl">I tuoi urls</p>
            <div class="grid grid-cols-3 auto-rows-auto">
                <?php
                    include "database.php";
                    if($data = getUrlsOfUser($_SESSION['email']))
                    {
                        foreach($data as $url)
                        {
                            echo "<div>".$url['code']."</div><div>".$url['long_url']."</div><div>".$url['visit_counter']."</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>