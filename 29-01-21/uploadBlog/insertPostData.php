<?php
session_start();
require_once "../config/functions.php";
$conn = new Functions();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

    $userEmail = $_SESSION['email'];
    $userId = $_SESSION['id'];


    $bid = $_REQUEST["bid"];
    $title = $_REQUEST["title"];
    $image = $_REQUEST["image"];
    $desc = $_REQUEST["desc"];    $status = $_REQUEST["status"];

    $img = $_REQUEST['img'];
    $img_name = $img;
    echo $img_name."<br>";
    $temp = $_FILES['file']['name'];
    print_r($temp);
    echo "<script>console.log(" . json_encode($temp, JSON_HEX_TAG) . ")</script>";
    if ($image != "") {
        echo "if";
        list($txt, $ext) = explode(".", $img_name);
        if (move_uploaded_file($temp, "/opt/lampp/htdocs/Parth/29-01-21/assets/img/" . $img_name)) {
            echo "upload";
            if (is_numeric($bid)) {
                echo "num";
                    $msg = $conn->insertBlogData($bid, $userId, $title, $image, $desc, $status);
               // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            } else if (is_string($bid)) {
                echo "numwithoutid";
                $msg = $conn->insertBlogData("", $userId, $title, $image, $desc, $status);
               // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            }
        }
    } else if ($image == "") {
        echo "else <br>";
        if (is_numeric($bid)) {
            echo "else num<br>";
            $msg = $conn->insertBlogData($bid, $userId, $title, "", $desc, $status);
            //header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        } else if (is_string($bid)) {
            echo "else string<br>";
            $msg = $conn->insertBlogData("", $userId, $title, "", $desc, $status);
           // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        }
    }

echo json_encode(array("statusCode" => 200,"msg"=>$msg,"img"=>$img_name));
