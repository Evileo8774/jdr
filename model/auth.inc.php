<?php
    //includes the file which will execute SQL requests
    include_once "db.user.inc.php";

    //logs a user in
    function login($mail, $pwd){
        if(!isset($_SESSION)){
            session_start();
        }

        if($mail != "" && $pwd != ""){
            $user = getUserByMail($mail);
            if($user != false){
                $userPwd = $user["password"];
                $hash = hashPwd($pwd);
                if($hash["pwd"] == $userPwd){
                    $_SESSION['mail'] = $mail;
                    $_SESSION['username'] = $user["username"];
                } else {
                    echo "<script>alert('Mauvais email ou mot de passe')</script>";
                }
            } else {
                echo "<script>alert('Mauvais email ou mot de passe')</script>";
            }
        } else {
            echo "<script>alert('Veuillez remplir les champs correctement')</script>";
        }
    }

    //logs the user out
    function logout(){
        if(!isset($_SESSION)){
            session_start();
        }
        session_destroy();
    }

    //gets the mail with the user is logged on
    function getMailLoggedOn(){
        if(isLoggedOn()){
            $ret = $_SESSION["mail"];
        } else {
            $ret = "";
        }
        return $ret;
    }

    //checks if a user is connected
    function isLoggedOn(){
        if(!isset($_SESSION)){
            session_start();
        }
        $ret = false;

        if(isset($_SESSION["mail"])){
            $user = getUserByMail($_SESSION["mail"]);
            if($user != false && $user["mail"] == $_SESSION["mail"]){
                $ret = true;
            }
        }
        return $ret;
    }
?>