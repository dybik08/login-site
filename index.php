<?php
session_start();
if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true )){
    header('Location: game.php');
    exit();
}
?>
<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>

 <form action="signin.php" method="post">
     Login: <br/> <input type="text" name="login"> <br>
     Password: <br> <input type="password" name="password"><br>
     <input type="submit" value="Sign in"/>
 </form>
 <?php
 if(isset($_SESSION['error'])){
     echo $_SESSION['error'];
 }

 ?>
 </body>
</html>