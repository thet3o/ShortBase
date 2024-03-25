<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("location: login.php");
    }
    echo '<button onclick="location.href=\'login.php\'">logout '.
    $_SESSION['email'] . '</button><br>';

    if($lastEmail) {
    echo 'Ultima email utilizzata per l\'accesso: ' . $lastEmail;
}
?>

<h1>PAGINA RISERVATA</h1>
