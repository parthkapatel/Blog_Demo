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
    header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
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
    <script src="../js/style.js"></script>

</head>

<body onload="selectTheme()">
<!-- Include Header File From Header Directory -->
<?php include "../Header/index.php" ?>

<div class="container-fluid p-5" style="background-color: rgba(253,251,251,0.7);min-height:650px;margin-top:60px;">
    <?php  if(!isset($_REQUEST["val"])){ ?>
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-sm-12 p-0 m-0">
                <div class="container-fluid ">
                    <!---->
                    <?php
                            $data = $conn->getBlogData("","");
                            if(count($data) > 0){
                                foreach ($data as $value){
                        ?>
                                    <div class="container p-0 my-5 blog-post">
                                        <div class="container blog-post-img p-0">
                                            <img src="../assets/img/<?php echo $value["image"]; ?>" class="img-fluid">
                                        </div>
                                        <div class="container clearfix px-4 py-2 blog-post-title">
                                            <h2><?php echo $value["title"]; ?></h2>
                                            <h6>Author : <b><?php echo $value["name"]; ?></b></h6>
                                            <h6 class="date text-secondary">Published Date : <?php echo date('d M,Y', strtotime($value["created_at"])); ?></h6>
                                            <hr>
                                            <p class="text-truncate text-justify"><?php echo $value["body"]; ?></p>
                                            <a href="/Parth/29-01-21/blogPage/?id=<?php echo $value['id']; ?>" class="btn btn-primary float-right" name="submit" id="post" value="<?php echo $value['id']; ?>">Read More...
                                            </a>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                            else{
                                ?>
                                <div class="container blog-post">
                                    <span class="text-info display-2">No Data Found</span>
                                </div>
                                <?php
                            }

                    ?>
                    <!---->

                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-sm-12 " style="background-color: rgba(253,251,251,0.7);margin-top:60px;">
                <div class="container">
                    <div class="container blog-popular">
                        <div class="container p-2">
                            <h2 class="text-center"> Popular Blogs </h2>
                            <hr>
                            <?php $data1 = $conn->getBlogData("","popular");
                                if(count($data1) > 0){
                                    foreach ($data1 as $value1){
                            ?>
                                        <a href="/Parth/29-01-21/blogPage/index.php?id=<?php echo $value1["id"]; ?>">
                                            <div class="container my-2  clearfix">
                                                <div class="float-left">
                                                    <img src="../assets/img/<?php echo $value1["image"]; ?>" width="80px" height="80px"
                                                         class="img-fluid">
                                                </div>
                                                <div class="float-left p-2 ">
                                                    <h5 class="" title="hello"><?php echo $value1["title"]; ?></h5>
                                                    <h6 class="date text-secondary">Published Date : <?php echo date('d M,Y', strtotime($value1["created_at"])); ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="m-0">
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
                                    <a href="/Parth/29-01-21/blogPage/index.php?id=<?php echo $value2["id"]; ?>">
                                        <div class="container my-2  clearfix">
                                            <div class="float-left">
                                                <img src="../assets/img/<?php echo $value2["image"]; ?>" width="80px" height="80px"
                                                     class="img-fluid">
                                            </div>
                                            <div class="float-left p-2 ">
                                                <h5 class="" title="hello"><?php echo $value2["title"]; ?></h5>
                                                <h6 class="date text-secondary">Published Date : <?php echo date('d M,Y', strtotime($value2["created_at"])); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="m-0">
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


                <div class="table-responsive blog-post h-100">
                    <h3 class="display-4 text-danger text-center p-2">My Uploded Blogs</h3>
                    <table class="table table-hover text-center table-light usersTable p-0 m-0">
                        <?php $data = $conn->getBlogData($userId,""); ?>
                        <thead class="thead usersTable-head">
                        <tr class="text-light bg-dark">
                            <th>Id</th>
                            <th>Title</th>
                            <!--<th class="text-truncate" style='width:100px;'>Descripton</th>-->
                            <th>Image</th>
                            <th>Views</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Publish Status</th>
                            <th>Total Likes</th>
                            <th>Total Comments</th>
                            <th>Update Block</th>
                            <th>Delete Blog</th>

                        </tr>
                        </thead>
                        <tbody class="tbody usersTable-body ">
                        <?php
                        if(count($data) > 0){
                            foreach ($data as $value){

                                echo "<tr class='".(($value['published']) == 0 ? 'bg-secondary text-white' : 'bg-success text-white')."'>
                                                    <td>".$value['id']."</td>
                                                    <td>".$value['title']."</td>
                                                    <td><img src='/Parth/29-01-21/assets/img/".$value['image']."' width='100px' height='100px' ></td>
                                                    <!--<td>".substr($value['body'],0,100)."</td>-->
                                                    <td>".$value['views']."</td>
                                                    <td>".$value['created_at']."</td>
                                                    <td>".$value['updated_at']."</td>
                                                    <td>".(($value['published']) == 0 ? 'Draft' : 'Publish') ."</td>
                                                    <td>10</td>
                                                    <td>20</td>
                                                    <td><a href='/Parth/29-01-21/uploadBlog/index.php?id=".$userId."&bid=".$value['id']."' class='btn btn-primary'>Update</a></td>
                                                    <td><a href='index.php?del=".$value['id']."' class='btn btn-primary'>Delete</a></td>
                                              </tr>";
                            }
                        }else{
                            echo "<tr><td><h2 class='text-warning'>No Data Found</h2></td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>


    <?php } ?>
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