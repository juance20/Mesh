<?php
  $session_md5 = $_COOKIE["session"];

  $dbhost = "db";
  $dbuser = "juan";
  $dbpass = "root";
  $dbname = "mesh";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

  $query = "SELECT * FROM users where session_md5=\"$session_md5\"";
  $result = $conn->query($query);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
      $name = $row["username"];
      echo "$name";
    }
  }

  $post_id = $_GET["post_id"];

  if(isset($_GET["like"])){
    $post_id = $_GET["id_post"];
    $query = "SELECT * FROM liked_posts where username=\"$name\" and post_id=$post_id";
    $result = $conn->query($query);
    if($result->num_rows == 0){
      $query = "INSERT INTO liked_posts values(\"$name\", $post_id)";
      $result = $conn->query($query);
      $query = "UPDATE posts set likes=likes+1 where id=$post_id";
      $result = $conn->query($query);
    }

    header("Location: full_post.php?post_id=$post_id");
    exit;
  }

  if(isset($_POST["text"])){
    $values = sprintf('"%s", "%s", "%s"', $post_id, $name, $_POST["text"]);
    $query = "INSERT INTO comments (post_id, owner, text) values($values)";
    $result = $conn->query($query);
    $query = "UPDATE posts set comments_cant=comments_cant+1 where id=$post_id";
    $result = $conn->query($query);
    header("Location: full_post.php?post_id=$post_id");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="es"><head> <link rel="stylesheet" href="style.css">

  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Proyecto blogs</title></head><body style="height: 716px;">
    
    
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
            <?php 
              echo "$name";
            ?>
            </a>
            <img style="height: 50%;" alt="profile photo" src="profile.jpg"><br>
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; height: 359px; text-align: center; width: 339px;"><br>
          </td>
          <td colspan="1" rowspan="2" style="vertical-align: top; height: 359px; text-align: left; width: 917px;">

            <?php
              $query = "SELECT * FROM posts where id=$post_id";
              $result = $conn->query($query);
              while($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $text = $row["text"];
                $fecha = $row["fecha"];
                $likes = $row["likes"];
                $comments = $row["comments_cant"];
                $edited = $row["edited"];
                $owner = $row["owner"];
                $like_link = $_SERVER['REQUEST_URI']."";
                if($edited != 0){
                  echo "<h1>$title (Editado)</h1><p>$owner - $fecha</p><p style=\"font-size:20px;\">$text</p><br>";
                }
                else{
                  echo "<h1>$title</h1><p>$owner - $fecha</p><p style=\"font-size:20px;\">$text</p><br>";
                }



                if($owner == $name){
                  echo "$likes 👍 $comments 💬 ";
                  echo "<a href=\"edit.php?id=$post_id\">Editar ✎</a><br><br>";
                  echo "<h2>Comentarios</h2>";
                }
                else{
                  echo "<a href=$like_link&id_post=$post_id&like=1><button>$likes 👍 </button></a> $comments 💬 ";
                  echo "<h2>Comentarios</h2>";
                  echo "<p style=\"font-size:16px;\">Posteá un comentario!</p>";
                  echo "<form method=\"post\">";
                  echo "<textarea name=\"text\" rows=4 cols=60 placeholder=\"Comentario\"></textarea><br><br>";
                  echo "<input type=\"submit\" value=\"Publicar\">";
                  
                }
                
                $query_comments = "SELECT * FROM comments where post_id=$post_id order by fecha desc";
                $result_comments = $conn->query($query_comments);
                while($row_comments = $result_comments->fetch_assoc()){
                    
                    $comment_owner = $row_comments["owner"];
                    $comment_text = $row_comments["text"];
                    $comment_fecha = $row_comments["fecha"];

                    echo "<p><b>$comment_owner</b> - $comment_fecha</p>$comment_text";

                }
              }
            ?>
          </td>
          <td style="vertical-align: top; height: 359px; text-align: right; width: 336px;">
            <a href="posting.php">Nuevo post ✎</a>
            <br><br>
            <a href="logout.php">Cerrar sesión</a>
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