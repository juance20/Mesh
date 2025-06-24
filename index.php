<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>

    <?php
        if(isset($_COOKIE["session"])){

            $session_md5 = $_COOKIE["session"];

            $dbhost = "localhost";
            $dbuser = "juan";
            $dbpass = "root";
            $dbname = "mesh";
            $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
            
            $query = "SELECT * FROM users where session_md5=\"$session_md5\"";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $time = time();
                    if($row["last_login"] - $time < 86.400){
                        $query = "UPDATE users set last_login=$time where session_md5=\"$session_md5\"";
                        $result = $conn->query($query);
                        header('Location: profile.php');
                        exit;
                    }
                }
                
            }
        }

    ?>

</head>
<body>
    <h1 align="center">Inicio de sesión</h1>
    <form action="login_page.php" method="post" align="center">
        <input type="text" name="user" placeholder="Nombre de usuario"><br><br>
        <input type="password" name="pass" placeholder="Contraseña"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <br>
    <a href="registro.html"><p align="center">Registrarse</p></a>
</body>
</html>