<?php
     session_start();
     if ((isset($_SESSION['userId']))) {
       unset($_SESSION['userId']);
       header("Location:index.php");
     }else{
        $url = $_SERVER['HTTP_REFERER'];
        header("Location:".$url);
     }
?>