<?php

    // Login the user
    function loginUser($email, $password)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT * FROM users WHERE email = '$email'"))
        {
            $user = pg_fetch_assoc($result);
            if($user['pwd_hash'] == hash("sha256", $password)){
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user['username'];
                setcookie('last_email', $email, time() + 3600, '/'); 
                header("Location: dashboard.php");
            }else{
                header("Location: login.php");
            }
        }
    }

    // Register the new user
    function signupUser($email, $password, $retyped_password, $username)
    {
        include "connection.php";
        $pwd_hash = hash("sha256", $password);
        $repwd_hash = hash("sha256", $retyped_password);

        if($pwd_hash == $repwd_hash)
        {
            if(pg_query($conn, "INSERT INTO users(email, pwd_hash, username, plan) VALUES ('$email', '$pwd_hash', '$username', '1')")){
                return true;
            }else{
                return false;
            }
        }
    }

    // Get the urls of the logged user
    function getUrlsOfUser($email)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT urls.code, long_url, visit_counter FROM urls, users WHERE urls.user_id = users.id AND users.email = '$email'"))
        {
            if(count(pg_fetch_all($result)) > 0)
            {
                return pg_fetch_all($result);
            }else{
                return false;
            }
        }
    }

    // Get user data
    function getUser($email)
    {
        include "connection.php";
        if($result = pg_query($conn, "SELECT id, email, username, plan FROM users WHERE email = '$email'"))
        {
            return pg_fetch_assoc($result);
        }
    }

    // Create the code for the url inserted, the length of the code can change
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

    // Create the code for the full url
    function createShortUrl($long_url, $user_id, $code_length)
    {
        include "connection.php";

        $code = generate_url_code($code_length);

        var_dump($user_id);

        $user_id = intval($user_id);

        $query = "INSERT INTO urls(code, long_url, user_id) VALUES ($1, $2, $3)";
        $values = array($code, $long_url, $user_id);

        if(pg_query_params($conn, $query, $values))
        {
            header("Location: dashboard.php");
        }else{
            echo "Errore nella crezione dell'url";
        }
    }

    // Get url from the code given by $_SERVER["URI_REQUEST"]
    function getLongUrlByCode($code)
    {
        include "connection.php";

        if($result = pg_query($conn, "SELECT long_url, visit_counter FROM urls WHERE code = '$code'"))
        {
            if($url = pg_fetch_assoc($result))
            {

                $updated_visit_counter = $url['visit_counter'] + 1;
                // Before return the url, update visit counter
                if(pg_query($conn, "UPDATE urls SET visit_counter = $updated_visit_counter WHERE code = '$code'"))
                {
                    return $url['long_url'];
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    // Get the single plan data
    function getUserPlan($plan_id){
        include "connection.php";
        if($result = pg_query($conn, "SELECT * FROM plans WHERE plans.id = '$plan_id'")){
            if($record = pg_fetch_assoc($result)){
                return $record;
            }
        }
    }

    // Get all available plans, but not the Administrator
    function getPlans()
    {
        include "connection.php";

        if($result = pg_query($conn, "SELECT * FROM plans WHERE id != 2")){
            if($records = pg_fetch_all($result)){
                return $records;
            }
        }

    }

    // Delete the shorted url
    function deleteUrl($code){
        include "connection.php";
        if(pg_delete($conn, "urls", array('code'=>$code))){
            return true;
        }else{
            return false;
        }
    }

    // Change the user plan
    function changePlan($user_id, $plan_id){
        include "connection.php";
        $sql = "UPDATE users SET plan=$plan_id WHERE id=$user_id";
        if(pg_query($conn, $sql)){
            return true;
        }else{
            return false;
        }
    }


    // Get the last time when the all user logged
    function getLatestLogins($limit) {
        include "connection.php";
        $latestLogins = array();

        // Eseguire la query per ottenere gli ultimi accessi
        $query = "SELECT email, login_time FROM logins ORDER BY login_time DESC LIMIT $limit";
        $result = pg_query($conn, $query);

        if ($result) {
            while ($row = pg_fetch_assoc($result)) {
                $latestLogins[] = $row;
            }
        }
        return $latestLogins;
    }
?>
