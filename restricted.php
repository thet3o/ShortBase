<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("location: login.php");
    }
    echo '<button onclick="location.href=\'login.php\'">logout '.
    $_SESSION['email'] . '</button><br>';


?>

<h1>PAGINA RISERVATA</h1>
