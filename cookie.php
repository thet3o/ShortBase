<?php
    // Controlla se l'utente ha effettuato l'accesso
    function checkBakeLogin(){
        if (isset($_SESSION['email'])) {
            // Ottieni l'ultima email utilizzata per l'accesso
            $lastEmail = $_SESSION['email'];
            // Imposta il cookie con l'ultima email utilizzata
            setcookie('last_email', $lastEmail, time() + 3600, '/'); // Il cookie scadrà dopo un'ora
            // Aggiorna l'ultima email utilizzata nel cookie
            $_COOKIE['last_email'] = $lastEmail;
        }
    }
?>
