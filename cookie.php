<?php

    if (isset($_POST['long_url'])) {
        $link = $_POST['long_url'];
        $cookie_content = $saved_link;
        $saved_link = [];
        if (isset($_cookie[$cookie_content])){
            $saved_link = json_decode($_cookie[$cookie_content], true);
        }
        $saved_link[]=$link;
        setcookie($cookie_content, json_encode($saved_link), time() + (3600), "/");
    }
    if(isset($_cookie['saved_link'])){
        $saved_link = json_decode($_cookie[$cookie_content], true);
        echo "<h2>Link salvati:</h2>";
        echo "<ul>";
    }
?>
