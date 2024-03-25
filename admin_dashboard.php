<?php
include "database.php";



// Verifica se l'utente è autenticato e se è un amministratore
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) { 
    header("Location: login.php");
    exit;
}

$user = getUser($_SESSION['email']);
$userPlan = getUserPlan($user['plan']);

if ($userPlan['name'] != 'Administrator'){

// Ottieni gli ultimi account che hanno effettuato l'autenticazione
$latestLogins = getLatestLogins(25);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard - Ultimi accessi</h1>

    <table border="1">
        <tr>
            <th>Email</th>
            <th>Data/Ora Accesso</th>
        </tr>
        <?php foreach ($latestLogins as $login): ?>
        <tr>
            <td><?php echo $login['email']; ?></td>
            <td><?php echo $login['login_time']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>

     <a href="logout.php">Logout</a>
</body>
</html>
