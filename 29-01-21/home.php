<?php
session_start();

    require_once "config/functions.php";
    $conn = new Functions();

    if(!isset($_SESSION['email'])){
        header("Location:/Parth/29-01-21/login.php");
    }
        $userEmail = $_SESSION['email'];
        $userId = $_SESSION['id'];

    if(isset($_REQUEST['del'])){
              $delmsg = $conn->deleteData($_REQUEST['del']);
            header("Location:/Parth/29-01-21/logout.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Website</title>
    <link rel="icon" type="image/x-icon" href="assets/img/internet.png" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
    <!-- JavaScript Link -->
      <script src="js/style.js"></script>

  </head>

  <body onload="selectTheme()">
        <!-- Include Header File From Header Directory -->

        <?php include "Header/index.php" ?>

        <!-- Include Slider File From Slider Directory -->
        <?php include "Body/index.php" ?>

        <!-- Include Footer from Footer Directory -->
        <?php include "Footer/index.php" ?>
    <!-- Bootstrap Script Links-->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>