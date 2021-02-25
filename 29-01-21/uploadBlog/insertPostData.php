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
    $desc = $_REQUEST["desc"];
    $status = $_REQUEST["status"];

    $img = $_REQUEST['img'];
    $img_name = $img;
    $temp = $_FILES['file']['name'];
    if ($image != "") {
        list($txt, $ext) = explode(".", $img_name);
        if (move_uploaded_file($temp, "/opt/lampp/htdocs/Parth/29-01-21/assets/img/" . $img_name)) {

            if (is_numeric($bid)) {
                    $msg = $conn->insertBlogData($bid, $userId, $title, $image, $desc, $status);
               // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            } else if (is_string($bid)) {
                $msg = $conn->insertBlogData("", $userId, $title, $image, $desc, $status);
               // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
            }
        }
    } else if ($image == "") {
        if (is_numeric($bid)) {
            $msg = $conn->insertBlogData($bid, $userId, $title, "", $desc, $status);
            //header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        } else if (is_string($bid)) {
            $msg = $conn->insertBlogData("", $userId, $title, "", $desc, $status);
           // header("Refresh:2 url=/Parth/29-01-21/blog/index.php?val=mblogs");
        }
    }

echo json_encode(array("statusCode" => 200,"msg"=>$msg,"img"=>$img_name));
