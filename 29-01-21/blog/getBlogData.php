<?php
session_start();
require_once "../config/functions.php";
$conn = new Functions();

$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];


if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}
$str = $_REQUEST["str"];

    $total = $conn->getLastId();
    $data = $conn->getBlogData("", $str);
    $val = "";
    $counter = 0;
    if (count($data) > 0) {
        foreach ($data as $value) {
                $val .= "<div class='container p-0 my-5 blog-post'>";

                if (isset($value["image"])) {

                    $val .= "<div class='container blog-post-img p-0'>
                                    <img src='../assets/img/".$value['image']."' class='img-fluid'>
                                </div>";
                }

                    $val .=  "<div class='container clearfix px-4 py-2 blog-post-title'>
                                    <h2>". $value['title']."</h2>
                                    <h6>Author : <b>".$value['name']."</b></h6>
                                    <h6 class='date text-secondary'>Published Date
                                        : ". date('d M,Y', strtotime($value['created_at'])) ."</h6>
                                    <hr>
                                    <p class='text-truncate text-justify'>". $value['body'] ."</p>
                                    <a href='/Parth/29-01-21/blogPage/?id=". $value['id']."' class='btn btn-primary float-right'
                                       name='submit' id='post' value='". $value['id'] ."'>Read More...
                                    </a>
                                </div>
                            </div>";

            $counter++;
        }
    } else {

        $val .= "<div class='container blog-post'>
                        <span class='text-info display-2'>No Data Found</span>
                    </div>";

    }
echo json_encode(array("statusCode" => 200, "data" => $val,"total"=>$total[0]["count(id)"],"counter"=>$counter));
