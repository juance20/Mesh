<?php
                if(isset($_POST["title"])){
                    $title = $_POST["title"];
                    $text = $_POST["text"];
                    $query = "UPDATE posts set title=\"$title\", text=\"$text\", edited=1 where id=$id";
                    $result = $conn->query($query);
                    header('Location: profile.php');
                    exit;
                }
                
?>

<!DOCTYPE html>
<html lang="es"><head> <link rel="stylesheet" href="style.css">

  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar post</title></head><body style="height: 716px;">
    
    
    <table style="text-align: left; width: 100%; height: 100%;" border="0" cellpadding="2" cellspacing="2">
      <tbody>
        <tr>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; height: 113px; text-align: center; width: 917px;">
            <form action="search.php" method="post">
              <input name="search" placeholder="Buscar" type="text">
              <input value="🔎" type="submit">
            </form>
      
            <br>
          </td>
          <td style="vertical-align: middle; height: 113px; text-align: right; width: 336px;">
            <a href="profile.php">
            <?php $session_md5 = $_COOKIE["session"];

              $dbhost = "db";
              $dbuser = "juan";
              $dbpass = "root";
              $dbname = "mesh";
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
          <td colspan="1" rowspan="2" style="vertical-align: top; height: 359px; text-align: left; width: 917px;">
              <h1 align="center">Editar post</h1>

              <?php
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $query = "SELECT * FROM posts where id=$id";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                        $title = $row["title"];
                        $text = $row["text"];
                    }
                }

              
              ?>

              <form method="post">
                <br>
                <?php 
                    echo "<input type=\"text\" name=\"title\" placeholder=\"Título\" value=\"$title\" size=50><br><br>";
                    echo "<textarea name=\"text\" rows=10 cols=100 placeholder=\"Texto\">$text</textarea><br><br>";
                ?>
                
                <input type="submit" value="Publicar">
              </form>
              

          </td>
          <td style="vertical-align: top; height: 359px; text-align: right; width: 336px;">
            <a href="posting.php">Nuevo post ✎</a>
            <br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center; width: 339px;"><br>
          </td>
          <td style="vertical-align: top; text-align: center; width: 336px;">
            <br>
          </td>
        </tr>
      </tbody>
    </table>
  </body></html>