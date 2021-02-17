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
        $arr = $conn->blogDataValidation($_REQUEST['title'],$_REQUEST['image'],$_REQUEST['desc']);
        if(isset($arr["title"]))
            $errName = $arr["title"];
        if(isset($arr["image"]))
            $errGen = $arr["image"];
        if(isset($arr["desc"]))
            $errEmail = $arr["desc"];
        
        if (is_numeric($_REQUEST['data']) and count($arr) == 0 ) {
            $msg = $conn->insertBlogData($_REQUEST['data'], $userId, $_REQUEST['title'], $_REQUEST['image'], $_REQUEST['body'], $_REQUEST['publish']);
            header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        }else if (is_string($_REQUEST['data']) and count($arr) == 0 ) {
            
                $msg = $conn->insertBlogData("", $userId, $_REQUEST['title'], $_REQUEST['image'], $_REQUEST['body'], $_REQUEST['publish']);
                header("Location:/Parth/29-01-21/blog/index.php?val=mblogs");
            header("Refresh:2 url=index.php ");
            
        }
    }

        if (isset($_REQUEST['id']) and !empty($_REQUEST['id'])) {
            if($_REQUEST['id'] == $_SESSION['id']){
                $upmsg = $conn->getBlogData($_REQUEST['id']);
                $value = $upmsg[0];
               // foreach ($upmsg as $value) {
                    $id = $value['id'];
                    $title = $value['title'];
                    $views = $value['views'];
                    $image = $value['image'];
                    $desc = $value['body'];
                    $publish = $value['published'];
              //  }
            }else{
                header("Location:home.php");
            }
        }


?>
<!DOCTYPE html>
  <head>
    <title>Upload Blog</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body onload="selectTheme()">

  <?php include "../Header/index.php" ?>      

    <div class="container mb-5 p-5 uploadBlog" style="margin-top:100px;">
        <div class="container-fluid m-0 p-0 uploadBlog">
            <?php
            if(isset($upmsg)){
                echo "<h2 class='container text-center text-white bg-dark >Update Blog Data</h2>";
            }else{
                echo "<h2 class='container text-center text-white bg-dark '>Add New Blog</h2>";
            }
            ?>
        </div>
        
        <div class="container-fluid">
            <form class="form text-dark" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title" value="<?php echo (isset($title)) ? $title : '' ; ?>" placeholder="Enter Blog Title">
                    <span class="text-danger"><?php echo (isset($errTitle)) ? $errTitle : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="file">Blog Image</label>
                    <input type="file" class="form-control" name="image" id="image"  value="<?php echo (isset($image)) ? $image : '' ; ?>" placeholder="Select Blog Image">
                    <span class="text-danger"><?php echo (isset($errImage)) ? $errImage : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="description">Blog Description</label>
                    <textarea type="text" class="form-control" name="desc" id="desc"  value="" placeholder="Enter Blog Description"><?php echo (isset($desc)) ? $desc : '' ; ?></textarea>
                    <span class="text-danger"><?php echo (isset($errDesc)) ? $errDesc : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="status">Published Status</label>                    
                    <select name="publish" id="publish" class="form-control">
                        <option value="1">Publish</option>
                        <option value="0">Draft</option>
                    </select>
                    <span class="text-danger"><?php echo (isset($errPublish)) ? $errPublish : '' ; ?></span>
                </div>


                    <?php
                        if(isset($upmsg)){
                            echo "<button type='submit' class='btn btn-success btn-block' value='".$id."' name='data'>Update Blog</button>";
                        }else{
                            echo "<input type='submit' class='btn btn-success btn-block' value='Upload Blog' name='data'>";
                        }
                    ?>
                <span class="text-success"><?php echo (isset($msg)) ? $msg : '' ; ?></span>
            </form>
        </div>
    </div>

    <?php include "../Footer/index.php" ?>

    <script>
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
