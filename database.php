<?php

    function getUrl($code)
    {
        include "connection.php";
        $result = pg_query($conn, "SELECT * FROM urls WHERE code = '$code'");
        $result = pg_fetch_assoc($result);
        return $result['longurl'][0] ?? false;
    }

    function loginUser($email, $password)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT * FROM users WHERE email = '$email'"))
        {
            $user = pg_fetch_assoc($result);
            if($user['pwd_hash'] == hash("sha256", $password)){
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                echo "works";
            }else{
                header("Location: login.php");
            }
        }
    }

    function signupUser($email, $password, $retyped_password, $username)
    {
        include "connection.php";
        $pwd_hash = hash("sha256", $password);
        $repwd_hash = hash("sha256", $retyped_password);

        if($pwd_hash == $repwd_hash)
        {
            if(pg_query($conn, "INSERT INTO users(email, pwd_hash, username) VALUES ('$email', '$pwd_hash', '$username')")){
                echo 'Registrazione riuscita!';
            }else{
                echo 'Registrazione fallita';
                header("Location: login.php");
            }
        }
    }

    function getUrlsOfUser($email)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT urls.code, long_url, visit_counter FROM urls, users WHERE urls.user = users.id AND users.email = '$email'"))
        {
            if(count(pg_fetch_all($result)) > 0)
            {
                return pg_fetch_all($result);
            }else{
                return false;
            }
        }
    }

    function get_user($email)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT id, email, username FROM users WHERE email = '$email'"))
        {
            return pg_fetch_assoc($result);
        }
    }

    function generate_url_code($length)
    {
        include "connection.php";
        $code = bin2hex(random_bytes($length));
        while(pg_fetch_assoc(pg_query($conn, "SELECT code FROM urls WHERE code = '$code'")))
        {
            $code = bin2hex(random_bytes($length));
        }
        return $code;
    }

    function createShortUrl($long_url, $user_id, $code_length)
    {
        include "connection.php";

        $code = generate_url_code($code_length);

        var_dump($code);

        if(pg_query($conn, "INSERT INTO urls(code, long_url, user) VALUES ($code, $long_url, $user_id)"))
        {
            header("Location: dashboard.php");
        }else{
            echo "Errore nella crezione dell'url";
        }
    }

?>