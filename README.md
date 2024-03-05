<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$userInfo = [
    'email' => $_SESSION['email'],
    'username' => 'Utente Simulato',
    'role' => 'Utente Standard'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Benvenuto nella tua dashboard, <?php echo $userInfo['username']; ?></h1>
    <p>Email: <?php echo $userInfo['email']; ?></p>
    <p>Ruolo: <?php echo $userInfo['role']; ?></p>
    
    <a href="logout.php">Logout</a>
</body>
</html>
