<?php
session_start();
if(isset($_SESSION['email'])){
    if(session_destroy()){
        unset($_SESSION['email']);
        header("Location:login.php");
    }
}else {
    header("Location:login.php");
}
