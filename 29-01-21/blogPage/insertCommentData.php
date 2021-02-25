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
    $str = $_REQUEST["str"];
    $comment = $_REQUEST["comment"];

    if ($str == "comment") {
        $msg = $conn->insertCommentData($bid, $userId, $comment);
        if (isset($msg)) {
            echo json_encode(array("statusCode" => 200, "msg" => "Comment added successfully!"));
        }
    } else if ($str == "sub") {
        $cid = $_REQUEST["cid"];
        $msg = $conn->insertCommentReplyData($bid, $userId, $cid, $comment);
        if (isset($msg)) {
            echo json_encode(array("statusCode" => 200, "msg" => "Comment added successfully!"));
        }
    }


?>