<?php
session_start();

require_once "../config/functions.php";
$conn = new Functions();

if (!isset($_SESSION['email'])) {
    header("Location:/Parth/29-01-21/login.php");
}

$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];

if (isset($_REQUEST['id'])) {
    $upmsg = $conn->getBlogData($_REQUEST['id'], "blogpage");
    $value = $upmsg[0];

    $uname = $value['name'];
    $id = $value['id'];
    $title = $value['title'];
    $image = $value['image'];
    $desc = $value['body'];
    $publish = $value['published'];
    $create = $value['created_at'];
    $update = $value['updated_at'];

} else {
    header("Location:/Parth/29-01-21/blog/");
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <link rel="icon" type="image/x-icon" href="assets/img/internet.png"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Bootstrap CSS Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- JavaScript Link -->
    <!--<script src="../js/jquery.js"></script>-->


   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body onload="selectTheme();">
<!-- Include Header File From Header Directory -->

<?php include "../Header/index.php" ?>

<div class="container mb-4 w-auto h-100"
     style="background-color: rgba(255, 255, 255, 0.3);min-height:650px;margin-top:80px;border-radius: 20px;box-shadow: 0px 0px 20px rgba(67, 67, 67, 0.3) ;">
    <div class="container p-0 blog-post">
        <div class="container-fluid px-4 py-4 blog-post-title">
            <h2><?php echo $title; ?></h2>
            <hr>
            <div class="container m-0 p-0 clearfix">
                <h6 class="float-left ">By <b><?php echo $uname; ?></b>&nbsp;<span
                            class="date text-secondary"><?php echo date('d M Y', strtotime($create)); ?></span>
                </h6>
                <h6 class="float-right text-secondary" id="view_counter"></h6>
            </div>
            <hr>
        </div>
        <?php
        if(isset($value["image"])){
        ?>
        <div class="container  p-0">
            <img src="../assets/img/<?php echo $image ?>" class="img-fluid">
        </div>
        <?php
        }
        ?>
        <div class="container p-3 blog-post-title">
            <p class="text-justify overflow-auto"><?php echo $desc; ?></p>
        </div>
        <hr>
        <div class="container" id="LandD">

            <img id="likeimg" class="p-1 pb-2" width="32px" height="32px" style="cursor: pointer"><span class="" id="like" ></span>
            <img id="dislikeimg" class="p-1 pt-2" width="32px" height="32px" style="transform: scaleX(-1); cursor: pointer"><span class="" id="dislike" ></span>

            <span class="float-right btn btn-primary" id="comment">Comments <b id="c_counter">0</b></span>
        </div>
        <hr>
        <!-- style="display: none;" -->
        <div class="container p-2" id="comment-section" style="display: none;">
            <div class="container clearfix p-2 overflow-auto" id="co">


            </div>
            <div class="container mb-3 p-3 float-center bg-light border border-rounded">
                    <div class="form-group">
                        <label for="name" class="text-primary"><?php echo $_SESSION["name"]; ?></label>
                        <textarea cols="20" rows="5" class="form-control" id="commentData"
                                  placeholder="Type Comment Here....." ></textarea>
                        <button name="submit" id="submit" class="btn btn-success m-2">Post</button>
                        <span class="text-info" id="msg"></span>
                        <div class="alert alert-success alert-dismissible fade show" id="success" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Footer from Footer Directory -->
<?php include "../Footer/index.php" ?>
<!-- Bootstrap Script Links-->
<script>

    function getdata() {

        let bid = "<?php echo $id; ?>";
        $.ajax({
            url: "getCommentData.php",
            type: "POST",
            data: {
                bid: bid
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                   // console.log(dataResult);
                    $("#co").html(dataResult.data);
                    $("#view_counter").html(dataResult.view_counter+" views");
                } else if (dataResult.statusCode == 201) {
                    console.log("error");
                }
            }
        });

    }

    function getSetLikeDislike(str) {

        let bid = "<?php echo $id; ?>";

        $.ajax({
            url: "likeAndDislike.php",
            type: "POST",
            data: {
                bid: bid,
                str: str
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $("#like").text(dataResult.lkcount);
                    $("#likeimg").attr("src", dataResult.like_src);
                    $("#dislike").text(dataResult.dlcount);
                    $("#dislikeimg").attr("src", dataResult.dislike_src);
                    $("#c_counter").text(dataResult.comment_count);
                } else if (dataResult.statusCode == 201) {
                    console.log("error");
                }
            }
        });
    }

    window.onload = getdata();
    window.onload = getSetLikeDislike("get");

    $(document).ready(function () {

        /* comment section toggle*/
        $("#comment").on('click',function (){
            $("#comment-section").fadeToggle("slow");
        });

        $(document).off('click','.reply');
        $(document).on('click','.reply',function(){
        if($(this).data('clicked',true)){
            let v = $(this).val();
            let c = "#".concat(v);
            $(c).fadeToggle("slow");
        }
        });


        /* Like Button Code */
        $("#likeimg").on('click',function (){
            getSetLikeDislike("like");
            getSetLikeDislike("get");
        });

        /* Disike Button Code */
        $("#dislikeimg").on('click',function (){
            getSetLikeDislike("dislike");
            getSetLikeDislike("get");
        });




        /* Insert Comment Reply Data */
        $(document).on('click','.sub',function(){
            if($(this).data('clicked',true)){
                let v = $(this).val();
                $(".sub").attr("disabled", "disabled");
                const bid = "<?php echo $id; ?>";
                const cid = $(this).val();
                let c = "textarea#commentReply".concat(v);
                const commentReply = $(c).val();
                let str = "sub";
                if (bid != "" && commentReply != "" && cid != null) {
                    $.ajax({
                        url: "insertCommentData.php",
                        type: "POST",
                        data: {
                            bid: bid,
                            cid: cid,
                            comment: commentReply,
                            str:str
                        },
                        cache: false,
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                $(".sub").removeAttr("disabled");
                                $("#subSuccess").show();
                                $(c).val("");
                                getdata();
                                getSetLikeDislike("get");
                                $('#subSuccess').html(dataResult.msg);
                                setTimeout(function () {
                                    $("#subSuccess").hide();
                                    $(v).fadeToggle("slow");
                                }, 3000);
                            } else if (dataResult.statusCode == 201) {
                                $(".sub").removeAttr("disabled");
                                $("#subSuccess").show();
                                $("#subSuccess").addClass("alert-danger");
                                $('#subSuccess').html('Something is wrong!');
                            }
                        }
                    });
                } else {
                    $(".sub").removeAttr("disabled");
                    $("#subSuccess").show();
                    $("#subSuccess").addClass("alert-danger");
                    $('#subSuccess').html('Comment Not added successfully !');
                }
            }
        });

        /* Insert Post data */
        $("#submit").on('click',function (){
            $("#submit").attr("disabled", "disabled");
            const bid = "<?php echo $id; ?>";
            const com = $("textarea#commentData").val();
            const str = "comment";
            if (bid != "" && com != "") {

                $.ajax({
                    url: "insertCommentData.php",
                    type: "POST",
                    data: {
                        bid: bid,
                        comment: com,
                        str : str
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#submit").removeAttr("disabled");
                            $("#success").show();
                            $("#commentData").val("");
                            getdata();
                            getSetLikeDislike("get");
                            $('#success').html(dataResult.msg);
                            setTimeout(function () {
                                $("#success").hide();
                            }, 3000);
                        } else if (dataResult.statusCode == 201) {
                            $("#submit").removeAttr("disabled");
                            $("#success").show();
                            $("#success").addClass("alert-danger");
                            $('#success').html('Something is wrong!');
                        }
                    }
                });
            } else {
                $("#success").show();
                $("#success").addClass("alert-danger");
                $('#success').html('Comment Not added successfully !');
            }
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