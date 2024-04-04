<?php
session_start();
include "database.php";

// Elimina cookie se pre esistente
setcookie("signup", "", time() - (3600));

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location: login.php");
}

$user = getUser($_SESSION['email']);
$userPlan = getUserPlan($user['plan']);

if(isset($_POST['long_url']))
{

    createShortUrl($_POST['long_url'], getUser($_SESSION['email'])['id'], $userPlan['code_length']);
}

if(isset($_POST['delete_url'])){
    if(deleteUrl($_POST['delete_url'])){
        header("Location: dashboard.php");
    }
}

if(isset($_POST['plans'])){
    if($_POST['plans'] != $userPlan['id']){
        if(changePlan($user['id'], $_POST['plans'])){
            header("Location: dashboard.php");
        }
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
    <title>Dashboard</title>
</head>

<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <div class="h-screen flex flex-col justify-center items-center bg-amber-100 gap-3">
        <div>
            <p class="text-5xl"><?php echo "Benvenuto ".$_SESSION['username']?></p>
        </div>
        <div class="w-4/5 h-20 bg-amber-400 flex flex-col justify-center items-center rounded">
            <div class="flex flex-row gap-1">
                <?php
                    echo "<p>Sottoscrizione: ".$userPlan['name']."</p>";
                ?>
                <button data-modal-target="modal-account" data-modal-toggle="modal-account" class="rounded bg-orange-300">Gestione Account</button>
                <div id="modal-account" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">    
                        <div class="relative bg-white rounded-lg shadow dark:bg-amber-100">
                            <div class="flex items-center justify-center">
                                <p class="text-3xl font-bold text-center">Gestione Account</p>
                            </div>
                            <div>
                                <form method="post" class="grid grid-cols-4 m-auto items-center justify-center gap-1">
                                    <div class="col-span-1"></div>
                                    <label for="username">Username</label>
                                    <?php
                                        echo "<input type='text' name='username' class='rounded' value='".$user['username']."' disabled />";
                                    ?>
                                    <div class="col-span-1"></div>
                                    <div class="col-span-1"></div>
                                    <label for="email">Email</label>
                                    <?php
                                        echo "<input type='text' name='email' class='rounded' value='".$user['email']."' disabled />";
                                    ?>
                                    <div class="col-span-1"></div>
                                    <div class="col-span-1"></div>
                                    <label for="plans">Piani</label>
                                    <select name="plans">
                                        <?php
                                            $plans = getPlans();
                                            foreach($plans as $plan){
                                                if($userPlan['name'] == $plan['name']){
                                                    echo "<option selected value='".$plan['id']."'>".$plan['name']." : ".$plan['price']." EUR</option>";
                                                }else{
                                                    echo "<option value='".$plan['id']."'>".$plan['name']." : ".$plan['price']." EUR</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="col-span-1"></div>
                                    <div class="col-span-1"></div>
                                    <button data-modal-hide="modal-account" type="submit" class="text-blue">Salva</button>
                                    <button data-modal-hide="modal-account" type="button" class="text-red">Chiudi</button>
                                    <div class="col-span-1"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="login.php" class="rounded bg-orange-400">Logout</a>
            </div>
            <form method="post" class="w-11/12 h-3/5 grid grid-cols-3 gap-3">
                <input type="text" name="long_url" placeholder="Inserisci l'URL da ridurre" class="col-span-2 rounded" />
                <input type="submit" value="Riduci" class="col-span-1 bg-orange-400 rounded text-xl">
            </form>
        </div>
        <div class="flex flex-col">
            <p class="text-3xl">I tuoi urls</p>
            <form method="post" class="grid grid-cols-4 auto-rows-auto gap-1">
                <?php
                    if($data = getUrlsOfUser($_SESSION['email']))
                    {
                        echo "<div><p>Codice Url</p></div><div><p>Url Target</p></div><div><p>Visitatori</p></div><div></div>";
                        foreach($data as $url)
                        {
                            echo "<div>".$url['code']."</div><div>".$url['long_url']."</div><div>".$url['visit_counter']."</div><div><button type='submit' class='rounded bg-red-400' name='delete_url' value='".$url['code']."'>Cancella</button></div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>