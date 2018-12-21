
<?php
    session_start();

    if((!isset($_POST['login'])) || (!isset($_POST['password']))){
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connectToDatabase = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connectToDatabase->connect_errno!=0){
        echo "Error: ".$connectToDatabase->connect_errno;
    }else {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");





        if($result = @$connectToDatabase->query(
            sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass ='%s'",
            mysqli_real_escape_string($connectToDatabase,$login),
            mysqli_real_escape_string($connectToDatabase, $password)))){
                $users_number = $result->num_rows;
                if($users_number>0){
                    $_SESSION['loggedin'] = true;
                    $row = $result->fetch_assoc();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $row['user'];
                    $_SESSION['drewno'] = $row['drewno'];
                    $_SESSION['kamien'] = $row['kamien'];
                    $_SESSION['zboze'] = $row['zboze'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['dnipremium'] = $row['dnipremium'];

                    unset($_SESSION['error']);
                    $result->close();
                    header('Location: game.php');
                }else {
                    $_SESSION['error'] = '<span style ="color:red">Login or password is not correct!</span>';
                    header('Location: index.php');
                }
        }


        $connectToDatabase->close();
    }


?>
