<!DOCTYPE html>
<html lang="es">
<head> <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>

    <?php
    $user = $_POST["user"]; 
    $pass_md5 = md5($_POST["pass"]);
    
    $dbhost = "localhost";
    $dbuser = "juan";
    $dbpass = "root";
    $dbname = "mesh";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
    
    $query = "SELECT * FROM users where username=\"$user\" and password_hash=\"$pass_md5\"";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        
        $cookie_name = "session";
        $time = date("Y-m-d h:i:s", time());
        $cookie_value = md5($user.$time);
        setcookie($cookie_name, $cookie_value, time() + 86400 , "/");

        $query = "UPDATE users SET session_md5=\"$cookie_value\", last_login=\"$time\" where username=\"$user\"";
        $conn->query($query);

        header('Location: profile.php');
        exit;
    }

    else {
        echo "Usuario o contraseña incorrecta <br><br>";
        echo "<a href=\"index.php\">Volver</a>";
    }

    $conn->close();
    ?>

</body>
</html>