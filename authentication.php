<?php 

    require_once('./database/config.php');

    $is_invalid = false;

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $database = new Database();
        $mysqli = $database->getConnection();

        $checkifExist = sprintf("SELECT * FROM `user_acc` WHERE email = '%s' ", 
                        $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($checkifExist);

        $user_acc = $result->fetch_assoc();

        if($user_acc)
        {
            if (password_verify($_POST['password'], $user_acc['password']))
            {
                session_start();
                session_regenerate_id();
                $_SESSION['user_id']= $user_acc['email'];
                header("Location: ./dashboard");
                exit;

            }
        }
        $is_invalid=true;


    }

?>