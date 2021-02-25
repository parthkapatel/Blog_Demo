<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:/Parth/29-01-21/login.php");
}
$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];


require_once "../config/functions.php";
$conn = new Functions();

if(isset($_REQUEST['del'])){
    $delmsg = $conn->deleteBlogData($_REQUEST['del']);
    header("Location:/Parth/29-01-21/blog/index.php?val=mblogs");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php
             if(!isset($_REQUEST["val"])){
                 echo "Student Blogs";
            }else{
                echo "My Blogs";
             }
             ?>
    </title>
    <link rel="icon" type="image/x-icon" href="assets/img/internet.png"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Bootstrap CSS Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- JavaScript Link -->
    <script src="../js/jquery.js"></script>
    <script src="../js/style.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>-->
    <script>
        function getSetLikeDislike(str,id) {
            let bid = id;

            $.ajax({
                url: "../blogPage/likeAndDislike.php",
                type: "POST",
                data: {
                    bid: bid,
                    str: str
                },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        let lk = dataResult.lkcount;
                        let dl = dataResult.dlcount;
                        let com = dataResult.comment_count;
                        if(lk == null)
                            lk=0;
                        if(dl == null )
                            dl=0;
                        if(com == null)
                            com=0;
                        let lid = "#likes_counter".concat(id);
                        let did = "#dislikes_counter".concat(id);
                        let cid = "#comment_counter".concat(id);
                        $(lid).text(lk);
                        $(did).text(dl);
                        $(cid).text(com);
                    } else if (dataResult.statusCode == 201) {
                        console.log("error");
                    }
                }
            });
        }
    </script>
</head>

<body onload="selectTheme();">
<!-- Include Header File From Header Directory -->
<?php include "../Header/index.php" ?>

<div class="container-fluid p-5" style="background-color: rgba(253,251,251,0.7);min-height:700px;margin-top:80px;">
    <?php  if(!isset($_REQUEST["val"])){ ?>
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-sm-12 p-0 m-0">
                <div class="container-fluid" id="blogContent">

                </div>
                <div class="container" >
                    <p class="lead text-center"  id="counterDisplay"></p>
                    <button  name='loadMore' id='loadMore' class='btn btn-primary float-right'>Load More</button>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-sm-12 " style="background-color: rgba(253,251,251,0.7);margin-top:60px;">
                <div class="container">
                    <div class="container blog-popular">
                        <div class="container p-2">
                            <h2 class="text-center"> Popular Blogs </h2>
                            <hr>
                            <?php $data1 = $conn->getBlogData("","popular");
                                if(count($data1) > 0){
                                    foreach ($data1 as $value1){
                            ?>
                                    <a href="/Parth/29-01-21/blogPage/index.php?id=<?php echo $value1["id"]; ?>" style="text-decoration: none;">
                                        <div class=" container media">
                                            <?php
                                            if(isset($value1["image"])){
                                            ?>
                                                <img class="align-self-center mr-3" src="../assets/img/<?php echo $value1["image"]; ?>" width="80px" height="80px" alt="Generic placeholder image">
                                                <?php
                                            }
                                            ?>
                                            <div class="media-body">
                                                <h6 class="" title="hello"><?php echo $value1["title"]; ?></h6>
                                                <h6 class="date text-secondary">Published Date : <?php echo date('d M,Y', strtotime($value1["created_at"])); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                        <hr class="">
                            <?php
                                    }
                                }
                                else{
                                    ?>
                                    <a href="#">
                                        <div class="container my-2  clearfix">
                                           <span class="text-info">No Data Found</span>
                                        </div>
                                    </a>
                                    <hr class="m-0">
                                <?php
                                }
                            ?>

                        </div>
                    </div>

                    <div class="container mt-2 blog-recent">
                        <div class="container p-2">
                            <h2 class="text-center"> Recent Blogs </h2>
                            <hr>
                            <?php $data2 = $conn->getBlogData("","recent");
                            if(count($data2) > 0){
                                foreach ($data2 as $value2){
                                    ?>
                                    <a href="/Parth/29-01-21/blogPage/index.php?id=<?php echo $value2["id"]; ?>" style="text-decoration: none;">
                                        <div class=" container media">
                                            <?php
                                            if(isset($value2["image"])){
                                                ?>
                                                <img class="align-self-center mr-3" src="../assets/img/<?php echo $value2["image"]; ?>" width="80px" height="80px" alt="Generic placeholder image">
                                                <?php
                                            }
                                            ?>
                                            <div class="media-body">
                                                <h6 class="" title="hello"><?php echo $value2["title"]; ?></h6>
                                                <h6 class="date text-secondary">Published Date : <?php echo date('d M,Y', strtotime($value2["created_at"])); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="">
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <a href="#">
                                    <div class="container my-2  clearfix">
                                        <span class="text-info">No Data Found</span>
                                    </div>
                                </a>
                                <hr class="m-0">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else if($_REQUEST["val"] == "mblogs"){ ?>


            <div class="conatiner blog-post h-100" id="myBlogs">

            </div>


                <div class="alert alert-success alert-dismissible fade show" id="success" style="position: absolute;top:68px;right:50px;display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal fade" id="ModalCenter">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure to delete post data also with comments ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary" id="yes">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>


    <?php } ?>
</div>

        <!-- Include Footer from Footer Directory -->
        <?php include "../Footer/index.php"; ?>
        <!-- Bootstrap Script Links-->

        <script>
            var offset = 0;
            var c = 0;
            function getBlogdata(str) {

                $.ajax({
                    url: "getBlogData.php",
                    type: "POST",
                    data: {
                        str: str
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            c = c + dataResult.counter;
                            if(c == dataResult.total)
                                $("#loadMore").hide();

                            $("#counterDisplay").text(c +" of "+ dataResult.total)
                            $("#loadMore").text("Load More");
                            $("#blogContent").append(dataResult.data);
                        } else if (dataResult.statusCode == 201) {
                            console.log("error");
                        }
                    }
                });
            }

            function getMyBlogdata() {

                $.ajax({
                    url: "getMyBlogsData.php",
                    type: "POST",
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#myBlogs").html(dataResult.data);
                        } else if (dataResult.statusCode == 201) {
                            console.log("error");
                        }
                    }
                });
            }

            window.onload = getBlogdata(offset);
            window.onload = getMyBlogdata();

            $(document).ready(function(){
                $("#loadMore").off("click");
                $("#loadMore").on("click",function(){
                    $("#loadMore").text("Loading....");
                    offset = offset + 3;
                    getBlogdata(offset);
                });

                /*  delete blog data*/

                $(document).on('click','.del',function(){
                    $(".modal").modal('show');
                });

                $("#yes").on("click",function(){
                    $("#yes").text("Deleting Data...");
                    var ch = "";
                    setTimeout(function () {
                        if($(this).data('clicked',true)) {
                            var v = $("#del").val();
                        }
                        $.ajax({
                            url: "deleteBlogData.php",
                            type: "POST",
                            data: {
                                bid: v
                            },
                            cache: false,
                            success: function (dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    $(".modal").modal('hide');
                                    $("#success").html(dataResult.msg)
                                    $("#success").show();
                                    getMyBlogdata();
                                    setTimeout(function () {
                                        $("#success").hide();
                                    }, 3000);
                                } else if (dataResult.statusCode == 201) {
                                    console.log("error");
                                }
                            }
                        });
                    }, 2000);
                });
            });



        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
</body>
</html>