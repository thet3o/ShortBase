<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'connection.php';

        $sql = "SELECT * FROM users";
        $result = pg_query($conn, $sql);
        var_dump(pg_fetch_all($result));
    ?>
</body>
</html>