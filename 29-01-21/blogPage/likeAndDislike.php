<?php
session_start();
require_once "../config/functions.php";
$conn = new Functions();

$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

$bid = $_REQUEST["bid"];
$str = $_REQUEST["str"];

$var = "";

if ($str == "like") {
    $like = $conn->LikeDislikeData($bid, $userId, $str);
} else if ($str == "dislike") {
    $dislike = $conn->LikeDislikeData($bid, $userId, $str);
} else if ($str == "get") {
    $total = $conn->getUserLikeDislikeData($bid);
    $total_comment = $conn->getTotalCounterComment($bid);
    $comm = $conn->LikeDislikeData($bid, $userId, $str);
    $lk_src = "/Parth/29-01-21/assets/icon/like.png";
    $dl_src = "/Parth/29-01-21/assets/icon/dislike.png";
    if ($comm[0]["like"] == 1 && $comm[0]["uid"] == $userId)
        $lk_src = "/Parth/29-01-21/assets/icon/like fill.png";
    else if ($comm[0]["dislike"] == 1 && $comm[0]["uid"] == $userId)
        $dl_src = "/Parth/29-01-21/assets/icon/dislike fill.png";
}

echo json_encode(array("statusCode" => 200, "like_src" => $lk_src, "dislike_src" => $dl_src, "lkcount" => $total[0][0], "dlcount" => $total[0][1], "uid" => $comm[0][2], "comment_count" => $total_comment[0][0], "like" => $comm[0]["like"], "dislike" => $comm[0]["dislike"]));








