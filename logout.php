<?php
    session_start();
    session_destroy();
    
    unset($_SESSION['SESS_USERNAME']);
    unset($_SESSION['SESS_PASSWORD']);
    header("location: index");
?>