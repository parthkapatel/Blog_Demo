<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}
$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];

require_once "../config/functions.php";
$conn = new Functions();



if(isset($_REQUEST['data']))
{

    $arr = $conn->blogDataValidation($_REQUEST['title'],$_REQUEST['desc']);
    if(isset($arr["title"]))
        $errTitle = $arr["title"];
    if(isset($arr["desc"]))
        $errDesc = $arr["desc"];

    $img_name= $_FILES["image"]['name'];
    $temp=$_FILES['image']['tmp_name'];
    if(isset($_FILES['image']["name"])){
        if(move_uploaded_file($temp,"/opt/lampp/htdocs/Parth/29-01-21/assets/img/".$img_name) and count($arr) == 0)
        {
            if (is_numeric($_REQUEST['data']) and count($arr) == 0 ) {
                $msg = $conn->insertBlogData($_REQUEST['data'], $userId, $_REQUEST['title'], $img_name, $_REQUEST['desc'], $_REQUEST['publish']);
                header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            }else if (is_string($_REQUEST['data']) and count($arr) == 0 ) {
                $msg = $conn->insertBlogData("", $userId, $_REQUEST['title'], $img_name, $_REQUEST['desc'], $_REQUEST['publish']);
                header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            }
        }
    }else if(empty($_FILES['image']["name"])){

        if (is_numeric($_REQUEST['data']) and count($arr) == 0 ) {
            $msg = $conn->insertBlogData($_REQUEST['data'], $userId, $_REQUEST['title'], "", $_REQUEST['desc'], $_REQUEST['publish']);
            header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        }else if (is_string($_REQUEST['data']) and count($arr) == 0 ) {
            $msg = $conn->insertBlogData("", $userId, $_REQUEST['title'], "", $_REQUEST['desc'], $_REQUEST['publish']);
            header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        }
    }


}

if (isset($_REQUEST['id']) and !empty($_REQUEST['id']) and isset($_REQUEST['bid']) and !empty($_REQUEST['bid'])) {
    if($_REQUEST['id'] == $_SESSION['id']){
        $upmsg = $conn->getBlogData($_REQUEST['bid'],"update");
        $value = $upmsg[0];

        // foreach ($upmsg as $value) {
        $id = $value['id'];
        $title = $value['title'];
        $image = $value['image'];
        $desc = $value['body'];
        $publish = $value['published'];

        //  }
    }else{
        header("Location:/Parth/29-01-21/blog/?val=mblogs");
    }
}


?>
<!DOCTYPE html>
<head>
    <title><?php
        if(isset($upmsg)){
            echo "Update Blog";
        }else{
            echo "Upload Blog";
        }
        ?></title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="../js/jquery.js"></script>
</head>
<body onload="selectTheme()">

<?php include "../Header/index.php" ?>

<div class="container mb-5 p-5 uploadBlog" style="margin-top:100px;">
    <div class="container-fluid m-0 p-0 uploadBlog">
        <?php
        if(isset($upmsg)){
            echo "<h2 class='container text-center text-white bg-dark '>Update Blog Data</h2>";
        }else{
            echo "<h2 class='container text-center text-white bg-dark '>Add New Blog</h2>";
        }
        ?>
    </div>

    <div class="container-fluid">
        <form class="form text-dark" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>"  method="post" action="#">
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" class="form-control" type="text" id="title" name="title" value="<?php echo (isset($title)) ? $title : '' ; ?>" placeholder="Enter Blog Title">
                <span class="text-danger" id="errTitle"><?php echo (isset($errTitle)) ? $errTitle : '' ; ?></span>
            </div>

            <div class="form-group">
                <label for="file">Blog Image</label>
                <input type="file" class="form-control" id="image"  name="image"  value="<?php echo (isset($image)) ? $image : '' ; ?>" placeholder="Select Blog Image">
                <span class="text-danger" id="errImage" ><?php echo (isset($errImage)) ? $errImage : '' ; ?></span>
            </div>

            <div class="form-group">
                <label for="description">Blog Description</label>
                <textarea type="text" class="form-control" id="desc"  name="desc" id="desc"  value="" placeholder="Enter Blog Description"><?php echo (isset($desc)) ? $desc : '' ; ?></textarea>
                <span class="text-danger" id="errDesc" ><?php echo (isset($errDesc)) ? $errDesc : '' ; ?></span>
            </div>

            <div class="form-group">
                <label for="status">Published Status</label>
                <select name="publish" id="status"  class="form-control">
                    <option value="1" id="publish" <?php echo (isset($publish) and $publish == 1) ? "selected" : ''; ?> >Publish</option>
                    <option value="0" id="draft"  <?php echo (isset($publish) and $publish == 0) ? "selected" : ''; ?> >Draft</option>
                </select>
                <span class="text-danger" id="errPublish" ><?php echo (isset($errPublish)) ? $errPublish : '' ; ?></span>
            </div>


            <?php
            if(isset($upmsg)){
                echo "<button type='submit' class='btn btn-success btn-block' value='".$id."' id='update' name='data'>Update Blog</button>";
            }else{
                echo "<input type='submit' class='btn btn-success btn-block' value='Upload Blog' id='submit'' name='data'>";
            }
            ?>
            <span class="text-success" id="msg"><?php echo (isset($msg)) ? $msg : '' ; ?></span>
        </form>
    </div>
</div>

<?php include "../Footer/index.php" ?>


<script>
      /*  function insertData(){
            var bid = $("#submit").val();
            var title = $("#title").val();
            var image = $("#image").val();
            var desc = $("#desc").val();
            var status = $("#status").val();
            //  var img = "<?php  //$_FILES["image"]["name"]; ?>";
            if(image != ""){
                var fd = new FormData();
                var files = $('#image')[0].files;
                console.log(files[0]);
                console.log(files);
                // Check file selected or not
                if(files.length > 0 ) {
                 //   fd.append('file', files);
                    console.log(fd);
                }
            }else{
                fd = "";
                $image = "";
            }
            if(title == "")
                $("#errTitle").text("Title is required");
            if(desc == "")
                $("#errDesc").text("Description is required");
            if(title != "" && desc != ""){
                $.ajax({
                    url: "insertPostData.php",
                    type: "GET",
                    data: {
                        bid   :bid,
                        title :title,
                        image :image,
                        desc  :desc,
                        status:status,
                        img  : fd
                    },
                    contentType: false,
                    processData: false,
                    //cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#msg").text(dataResult.msg);
                            console.log("msg : "+dataResult.msg);
                            console.log("img : "+dataResult.img);
                        } else {
                            console.log("error");
                        }
                    }
                });
            }

        }
        $(document).ready(function () {
            $("#submit").click(function(){
                insertData();
            });

            $("#update").click(function(){
                insertData();
            });
        });*/
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"
        integrity="sha512-oHBLR38hkpOtf4dW75gdfO7VhEKg2fsitvHZYHZjObc4BPKou2PGenyxA5ZJ8CCqWytBx5wpiSqwVEBy84b7tw=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>


</body>
</html>
