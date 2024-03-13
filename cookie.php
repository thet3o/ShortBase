<?php

if (isset($_POST['long_url'])) {
    $long_url = $_POST['long_url'];
    $cookie_content = 'saved_links'; // Set a consistent name for the cookie
    $saved_links = [];

    if (isset($_COOKIE[$cookie_content])) {
        $saved_links = json_decode($_COOKIE[$cookie_content], true);
    }

    $saved_links[] = $long_url;
    setcookie($cookie_content, json_encode($saved_links), time() + (3600), "/"); // Save the updated list of links in the cookie
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
    <h1>Save your link:</h1>
    <form method="post">
        <label for="long_url">Inserisci il tuo link:</label><br>
        <input type="text" id="long_url" name="long_url" required><br>
        <input type="submit" value="Save">
    </form>

<?php
if(isset($_COOKIE['saved_links'])){
    $saved_links = json_decode($_COOKIE[$cookie_content], true);
    echo "<h2>Link salvati:</h2>";
    echo "<ul>";
    foreach ($saved_links as $link){
        echo "<li><a href='$link'>$link</a></li>";
    }
    echo "</ul>";
}
?>

</body>
</html>
