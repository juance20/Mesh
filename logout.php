<!DOCTYPE html>
<html lang="es">
<head> <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        if(isset($_COOKIE["session"])){
            setcookie("session", "", $time = date("Y-m-d h:i:s", time()) - 3600, "/");
            header("Location: index.php");
            exit;
        }
    ?>
</body>
</html>