<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}
$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];

require_once "../config/functions.php";
$conn = new Functions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Parth KaPatel</title>
    <link rel="icon" type="image/x-icon" href="assets/img/internet.png"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Bootstrap CSS Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- JavaScript Link -->
    <script src="../js/style.js"></script>

</head>

<body onload="selectTheme()">
<!-- Include Header File From Header Directory -->
<?php include "../Header/index.php" ?>

<div class="container-fluid p-5" style="background-color: rgba(253,251,251,0.7);min-height:650px;margin-top:60px;">
    <div class="row">
        <div class="col-lg-9 col-sm-12 p-0 m-0">
            <div class="container-fluid ">
                <!---->
                <div class="container p-0 my-5 blog-post">
                    <div class="container blog-post-img p-0">
                        <img src="../assets/img/thumbnail-image.jpg" class="img-fluid">
                    </div>
                    <div class="container px-4 py-1 blog-post-title">
                        <h2> Parth KaPatel</h2>
                        <h6>Author : <b>Parth KaPatel</b></h6>
                        <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                        <hr>
                        <p class="text-truncate">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                            an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                            has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of
                            Letraset sheets containing </p>
                        <button type="button" class="btn btn-primary float-right" name="submit" id="post">Read More...
                        </button>
                    </div>
                </div>
                <!---->
                <!---->
                <div class="container p-0 my-5 blog-post">
                    <div class="container blog-post-img p-0">
                        <img src="../assets/img/thumbnail-image.jpg" class="img-fluid">
                    </div>
                    <div class="container px-4 py-1 blog-post-title">
                        <h2> Parth KaPatel</h2>
                        <h6>Author : <b>Parth KaPatel</b></h6>
                        <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                        <hr>
                        <p class="text-truncate">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                            an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                            has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of
                            Letraset sheets containing </p>
                        <button type="button" class="btn btn-primary float-right" name="submit" id="post">Read More...
                        </button>
                    </div>
                </div>
                <!---->
            </div>
        </div>

        <div class="col-lg-3 col-sm-12" style="background-color: rgba(253,251,251,0.7);margin-top:60px;">
            <div class="container">
                <div class="container blog-popular">
                    <div class="container p-2">
                        <h2 class="text-center"> Popular Blogs </h2>
                        <hr>
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="container mt-2 blog-recent">
                    <div class="container p-2">
                        <h2 class="text-center"> Recent Blogs </h2>
                        <hr>
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="m-0">
                        <a href="#">
                            <div class="container my-2  clearfix">
                                <div class="float-left">
                                    <img src="../assets/img/thumbnail-image.jpg" width="80px" height="80px"
                                         class="img-fluid">
                                </div>
                                <div class="float-left w-75 p-2 ">
                                    <h5 class="text-truncate" title="hello">Hellobnckvjbjknbkjnhgdhbcnb</h5>
                                    <h6 class="date text-secondary">Published Date :10-02-2020</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Include Footer from Footer Directory -->
        <?php include "../Footer/index.php"; ?>
        <!-- Bootstrap Script Links-->
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
</body>
</html>