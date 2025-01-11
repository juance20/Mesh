<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
  </head>
  <body style="height: 716px;">
    
    
    <table style="text-align: left; width: 100%; height: 100%;" border="0" cellpadding="2" cellspacing="2">
      <tbody>
        <tr>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 917px;">
            <form action="search.php" method="post">
              <?php printf("<input type=\"text\" name=\"search\" placeholder=\"Buscar\" value=\"%s\">", $_POST["search"]); ?>
              <input type="submit" value="🔎">
            </form>
      
            <br>
          </td>
          <td style="vertical-align: middle; height: 113px; text-align: right; width: 336px;">
            <a href="profile.php">
            <?php
              $session_md5 = $_COOKIE["session"];

              $dbhost = "localhost";
              $dbuser = "juan";
              $dbpass = "root";
              $dbname = "blog_site";
              $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

              $query = "SELECT * FROM users where session_md5=\"$session_md5\"";
              $result = $conn->query($query);
              while($row = $result->fetch_assoc()) {
                $name = $row["username"];
                echo "$name";
              }

            ?>
            <img style="height: 50%;" alt="profile photo" src="profile.jpg"></a><br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; height: 359px; text-align: center; width: 339px;"><br>
          </td>
          <td colspan="1" rowspan="2" style="vertical-align: top; height: 359px; text-align: center; width: 917px;">
          <?php

              $username = $name;
              $search = $_POST["search"];

              $query = "SELECT * FROM users where username like \"%$search%\"";
              $result = $conn->query($query);
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                  $name = $row["username"];
                  if($name == $username){
                    echo "<a href=\"profile.php\">$name</a><br><br>";
                  }
                  else{
                    echo "<a href=\"other_profile.php?user=$name\">$name</a><br><br>";
                  }
                }
              }
              else{
                echo "Sin resultados";
              }

            ?>
            
            <br>
          </td>
          <td style="vertical-align: top; height: 359px; text-align: center; width: 336px;"><br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; text-align: center; width: 336px;"><br>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>