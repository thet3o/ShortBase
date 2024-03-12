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
        foreach ($saved_link as $link){
            echo "<li><a href='$link'>$link</a></li>";
    }
    echo "</ul>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link saver</title>
</head>
<body>
    <h1>save your link:</h1>
    <form method="post">
    <label for="link">Inserisci il tuo link:</label><br>
    <input type="text" id="link" name="link" required><br>
    <input type="submit" value="save">
</form>
</body>
</html>
