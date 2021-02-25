<?php
session_start();
require_once "../config/functions.php";
$conn = new Functions();

$userEmail = $_SESSION['email'];
$userId = $_SESSION['id'];

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}
    $val = "";

            $val .= "<h3 class='display-4 text-danger  text-center p-2'>My Uploded Blogs</h3>
            <div class='table-responsive'>
            <table class='table table-hover text-center table-light usersTable p-0 m-0'>";
                $data = $conn->getBlogData($userId,'');
            $val .= "<thead class='thead usersTable-head'>
                    <tr class='text-light bg-dark'>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Views</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Publish Status</th>
                        <th>Total Likes</th>
                        <th>Total Dislikes</th>
                        <th>Total Comments</th>
                        <th colspan='2'>Actions</th>
    
                    </tr>
                    </thead>
                    <tbody class='tbody usersTable-body'>";

                if(count($data) > 0){
                    foreach ($data as $value){
                        $val .= "<script type='text/javascript'>
                        getSetLikeDislike('get','".$value["id"]."');
                        </script>";

                        $val .= "<tr class='". (($value["published"]) == 0 ? 'bg-secondary text-white' : 'bg-success text-white')."'>
                                            <td>".$value["id"]."</td>
                                            <td><a href='/Parth/29-01-21/blogPage/index.php?id=".$value["id"]."'  class='text-white' style='cursor: pointer;text-decoration:none;'>".$value["title"]."</a></td>
                                            <td><a href='/Parth/29-01-21/blogPage/index.php?id=".$value["id"]."'  class='text-white' style='cursor: pointer;text-decoration:none;'><img src='/Parth/29-01-21/assets/img/".$value["image"]."' width='100px' height='100px' ></a></td>
                                            <td>".$value["views"]."</td>
                                            <td>".date('d M,Y H:i:s', strtotime($value['created_at']))."</td>
                                            <td>".date('d M,Y H:i:s', strtotime($value['updated_at']))."</td>
                                            
                                            <td>".(($value["published"]) == 0 ? 'Draft' : 'Publish') ."</td>
                                            <td id='likes_counter".$value["id"]."'>10</td>
                                            <td id='dislikes_counter".$value["id"]."'>20</td>
                                            <td id='comment_counter".$value["id"]."'>20</td>
                                            <td><a href='/Parth/29-01-21/uploadBlog/index.php?id=".$userId."&bid=".$value["id"]."' class='btn btn-primary'>Update</a></td>
                                            <td><button type='button' class='btn btn-danger del' id='del' value='".$value["id"]."' >Delete</button></td>
                                      </tr>";

                    }
                }else{
                    $val .= "<tr><td><h2 class='text-warning'>No Data Found</h2></td></tr>";
                }
                $val .="</tbody>
                </table>
                </div>";

echo json_encode(array("statusCode" => 200, "data" => $val));