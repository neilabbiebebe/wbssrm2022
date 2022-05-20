<?php
    include_once('session/dbconnect.php');
    @session_start();
    error_reporting(); 


    if (empty($_SESSION['SESS_USERNAME']) and empty($_SESSION['SESS_PASSWORD'])) {

        header("Location: index");

    }        
?>