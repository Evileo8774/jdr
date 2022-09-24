<?php
    //connect to DB
    include_once "db.inc.php";

    //returns all users
    function getUsers(){
        $result = array();

        try{
            $cnx = connectionPDO();
            $req = $cnx->prepare("select * from accounts");
            $req->execute();

            $line = $req->fetch(PDO::FETCH_ASSOC);
            while($line){
                $result[] = $line;
                $line = $req->fetch(PDO::FETCH_ASSOC);
            }
        } catch(PDOException $e){
            print "Error : ".$e->getMessage();
            die();
        }
        return $result;
    }

    //sorts users by mail and returns the result
    function getUserByMail($mail){
        $result = array();

        try{
            $cnx = connectionPDO();
            $req = $cnx->prepare("select * from accounts where mail=?");
            $req->execute([$mail]);

            $result = $req->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            print "Error : ".$e->getMessage();
            die();
        }
        return $result;
    }

    //hashs a string 
    function hashPwd($pwd){
        $result = array();

        try{
            $cnx = connectionPDO();
            $req = $cnx->prepare("select SHA2('".$pwd."', 256) AS 'pwd'");
            $req->bindValue('pwd', $pwd, PDO::PARAM_STR);
            $req->execute();

            $result = $req->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            print "Error : ".$e->getMessage();
            die();
        }
        return $result;
    }

?>