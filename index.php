<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'database.php';

        $sql = "SELECT name, description FROM plans";
        var_dump(fetch_assoc($sql)["description"]);
    ?>
</body>
</html>