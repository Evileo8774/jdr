<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
        $root="..";
    }

    //include_once "$root/model/db.home.inc.php";

    
    $title = "Accueil";
    include "$root/view/head.html.php";
    include "$root/view/viewHome.php";
    include "$root/view/foot.html.php";
?>