<?php
session_start();
include "database.php";

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location: login.php");
}

if(isset($_POST['long:url']))
{
    createShortUrl($_POST['long:url'], get_user($_SESSION['email'])['id'], 5);
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
                <input type="text" name="long_url" placeholder="Inserisci l'URL da ridurre" class="col-span-2 rounded" />
                <input type="submit" value="Riduci" class="col-span-1 bg-orange-400 rounded text-xl">
            </form>
        </div>
        <div class="flex flex-col">
            <p class="text-3xl">I tuoi urls</p>
            <div class="grid grid-cols-3 auto-rows-auto gap-1">
                <?php
                    if($data = getUrlsOfUser($_SESSION['email']))
                    {
                        echo "<div><p>Codice Url</p></div><div><p>Url Target</p></div><div><p>Visitatori</p></div>";
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