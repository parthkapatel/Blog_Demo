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


$data = $conn->deleteBlogData($bid);
if(isset($data)){
    echo json_encode(array("statusCode" => 200, "msg" => $data));
}