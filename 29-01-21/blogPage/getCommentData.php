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


$views = $conn->getSetViewsCounter($bid, "first");

$comm = $conn->getCommentData($bid);
$var = "";
foreach ($comm as $val) {
    $id = $val["id"];
    $bid = $val["bid"];
    $uid = $val["uid"];
    $name = $val["name"];
    $comment = $val["comment"];
    $created_at = $val["created_at"];
    $updated_at = $val["updated_at"];
    //$counter = $val["counter"];
    $date = date('d M Y', strtotime($created_at));

    $subComment = $conn->getCommentReplyData($bid,$id);
    $sub = "";
    if ($uid == $userId) {
        $var = $var . "<div class='container mb-3 float-right bg-secondary comment-post w-75'>
                            <div class='container clearfix w-100'>
                               <h6 class='text-white float-left '>" . $name . "</h6>
                               <h6 class='float-left text-warning'>&nbsp" . $date . "</h6>
                               <button type='button' class='text-right  reply float-right text-white btn btn-primary' value='" . $id . "'  style='cursor: pointer;' >Reply</button>
                            </div>
                            <hr class='m-2 bg-warning'>
                            <div class='container '>
                                <p class=' text-white '>
                                    " . $comment . "
                                </p>
                            </div>";


                                if(count($subComment) > 0 ){
                                    foreach ($subComment as $subValue){
                                        $sub = $sub .         "<div class='container p-2 mb-3 w-75 float-right bg-white rounded' >
                                            <div class='container clearfix w-100'>
                                               <h6 class='text-dark float-left '>" . $subValue["name"] . "</h6>
                                               <h6 class='float-left text-secondary'>&nbsp" . date('d M Y', strtotime($subValue["created_at"])) . "</h6>
                                            </div>
                                            <hr class='m-2 bg-secondary'>
                                            <div class='container '>
                                                <p class=' text-dark '>
                                                    " . $subValue["subcomment"] . "
                                                </p>
                                            </div>
                                        </div>";
                                    }
                                }
            $var = $var .  $sub . "            <div class='container p-2 w-75 float-right bg-white rounded' id='" . $id . "' style='display: none;'>
                                                    <div class='form-group'>
                                                        <label for='name' class='text-primary'>" . $_SESSION['name'] . "</label>
                                                        <textarea cols='20' rows='3' class='form-control commentReply' id='commentReply".$id."'
                                                                  placeholder='Type Comment Here.....'  value=''></textarea>
                                                       <button name='sub'  id='sub' value='".$id."' class='sub btn btn-success m-2 float-right'>Post</button>   
                                                                                         
                                                        <div class='alert alert-success alert-dismissible fade show' id='success' style='display:none;'>
                                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                    </div>";
    } else {
        $var = $var . "<div class='container float-left  mb-3 bg-secondary comment-post w-75' '>
                        <div class='container clearfix w-100'>
                            <h6 class='text-white float-left '>" . $name . "</h6>
                            <h6 class='float-left text-warning'>&nbsp" . $date . "</h6>
                           <button type='button' class='text-right  reply float-right text-white btn btn-primary ' value='" . $id . "'  style='cursor: pointer;' >Reply</button>
                        </div>
                        <hr class='m-2 bg-warning'>
                        <div class='container'>
                            <p class='text-white'>
                                 " . $comment . "
                            </p>
                        </div>";

                            if(count($subComment) > 0 ){
                                foreach ($subComment as $subValue){
                                    $sub = $sub .         "<div class='container p-2 mb-3 w-75 float-right bg-white rounded' >
                                                                <div class='container clearfix w-100'>
                                                                   <h6 class='text-dark float-left '>" . $subValue["name"] . "</h6>
                                                                   <h6 class='float-left text-secondary'>&nbsp" . date('d M Y', strtotime($subValue["created_at"])) . "</h6>
                                                                </div>
                                                                <hr class='m-2 bg-secondary'>
                                                                <div class='container '>
                                                                    <p class=' text-dark '>
                                                                        " . $subValue["subcomment"] . "
                                                                    </p>
                                                                </div>
                                                            </div>";
                                }
                            }


            $var = $var .  $sub . "             <div class='container p-2 w-75 float-right bg-white rounded' id='" . $id . "' style='display: none;'>
                                                    <div class='form-group'>
                                                        <label for='name' class='text-primary'>" . $_SESSION['name'] . "</label>
                                                        <textarea cols='20' rows='3' class='form-control commentReply' id='commentReply".$id."'
                                                                  placeholder='Type Comment Here.....' ></textarea>
                                                       <button name='sub' id='sub'  value='".$id."' class='sub btn btn-success m-2 float-right'>Post</button>   
                                                                                         
                                                        <div class='alert alert-success alert-dismissible fade show' id='subSuccess' style='display:none;'>
                                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                  </div>";
    }
}

echo json_encode(array("statusCode" => 200, "data" => $var, "view_counter" => $views["views"]));