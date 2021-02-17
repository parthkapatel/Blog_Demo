<?php

class Functions
{
    private $conn;
    private $table_name;
    private $blog_posts;
    function __construct()
    {
        require_once "connection.php";
        $db = new connection();
        $this->conn = $db->DBConnect();
        $this->table_name = "student_details";
        $this->blog_posts = "posts";
    }

    function insertData($id, $name, $gender, $email, $password, $phone)
    {

        $this->createTable();
        if ($id == "") {
            $dataQuery = "INSERT INTO $this->table_name( name, gender, email,password, phone) VALUES (:name,:gender,:email,:password,:phone)";
        } else {
            $dataQuery = "update $this->table_name set name=:name ,gender=:gender ,email=:email ,password=:password ,phone=:phone where id=:id";
        }

        $stmt = $this->conn->prepare($dataQuery);
        if (is_numeric($id))
            $stmt->bindParam(":id", $id);
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $pass);
        $stmt->bindParam(":phone", $phone);
        $stmt->execute();

        if ($id == "") {
            $msg = "Data Not Inserting";
            if (isset($stmt))
                $msg = "Data Insert Successfully";
        } else {
            $msg = "Data Not Updating";
            if (isset($stmt))
                $msg = "Data Update Successfully";
        }
        return $msg;
    }

    function createTable()
    {

        $createTable = "
                CREATE TABLE IF NOT EXISTS student_details(
                    id int primary key AUTO_INCREMENT,
                    name varchar(25) not null,
                    gender varchar(6) not null,
                    email varchar(50) not null,
                    password char(60) not null,
                    phone varchar(10) not null
                )
                ";

        if ($this->conn->exec($createTable)) {
            echo "<script>console.log(" . json_encode('Table Created', JSON_HEX_TAG) . ")</script>";
        }
    }

    function getData($id)
    {
        if ($id == "") {
            $getData = "Select * from $this->table_name";
        } else {
            $getData = "Select * from $this->table_name where id=:id";
        }
        $stmt = $this->conn->prepare($getData);
        if (isset($id))
            $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function deleteData($id)
    {
        
        $deleteData = "delete from $this->table_name where id=:id";
        $stmt = $this->conn->prepare($deleteData);
        $stmt->bindParam(":id", $id);
        $msg = "Data Not Deleted";
        if ($stmt->execute())
            $msg = "Data Deleted Successfully";
        return $msg;
    }

    function checkEmail($email)
    {

        $this->createTable();
        $checkEmail = "select * from $this->table_name where email=:email";
        $stmt = $this->conn->prepare($checkEmail);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchAll();
        return  $stmt->rowCount();

    }

    function checkEmailAndPassword($email, $password)
    {
        
        $checkEmail = "select id,email,password from $this->table_name where email=:email";
        $stmt = $this->conn->prepare($checkEmail);
        $stmt->bindParam(":email", $email);
        //$stmt->bindParam(":password",$password);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $val = $stmt->fetch();
        if (isset($password) && isset($val['password'])) {
            if (password_verify($password, $val['password'])) {
                return $val;
            }
        }
    }

    function dataValidation($name, $gender, $email, $password, $phone)
    {

        $chk = array();
        if (empty($name)) {
            $chk["name"] = "Name is Required";
        }
        if (empty($gender)) {
            $chk["gender"] = "Gender is Required";
        }
        if (empty($email)) {
            $chk["email"] = "Email Id is Required";
        }
        if (empty($password)) {
            $chk["password"] = "Password is Required";
        } else if (!empty($password)) {
            $len = strlen($password);
            if (16 < $len or 8 > $len) {
                $chk["password"] = "Please enter password in between 8 to 16 character";
            }
        }
        if (empty($phone)) {
            $chk["phone"] = "Contact No. is Required";
        } else if (!empty($phone)) {
            $num = is_numeric($phone);
            $len = strlen($phone);
            if ($num == false) {
                $chk["phone"] = "Please enter number in digits";
            } else if (10 < $len or 10 > $len) {
                $chk["phone"] = "Please enter 10 digit number";
            }
        }
        return $chk;
    }

    function blogDataValidation($title,$image,$desc){
        $chk = array();
        if (empty($title)) {
            $chk["title"] = "Title is Required";
        }
        if (empty($image)) {
            $chk["image"] = "Image is Required";
        }
        if (empty($desc)) {
            $chk["desc"] = "Description is Required";
        }
        return $chk;
    }

    function createBlogTable(){
        $createBlogTable = "
                CREATE TABLE IF NOT EXISTS `posts` (
                    `id` int(11) NOT NULL,
                    `user_id` int(11) DEFAULT NULL,
                    `title` varchar(255) NOT NULL,
                    `views` int(11) NOT NULL DEFAULT 0,
                    `image` varchar(255) NOT NULL,
                    `body` text NOT NULL,
                    `published` tinyint(1) NOT NULL,
                    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                    ";
               
        if ($this->conn->exec($createBlogTable)) {
            echo "<script>console.log(" . json_encode('Blog Table Created', JSON_HEX_TAG) . ")</script>";
        }
    }

    function insertBlogData($id,$user_id,$title, $img, $body, $publish)
    {

        $this->createBlogTable();
        
        if ($id == "") {
            $dataQuery = "INSERT INTO $this->blog_posts  (user_id,title, image, body, published,updated_at) VALUES (:userid,:title,:img,:body,:publish,:updated)";
            
        } else {
            $dataQuery = "update $this->blog_posts set title=:title ,image=:img ,body=:body ,published=:publish,updated_at=:updated where id=:id";
        }

        $stmt = $this->conn->prepare($dataQuery);
        
        if (is_numeric($id))
        {
            $stmt->bindParam(":id", $id);
        }
        $stmt->bindParam(":userid", $user_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":img", $img);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":publish", $publish);
        $t=time();
        $update = date("Y-m-d h:i:s",$t);
        $stmt->bindParam(":updated", $update);
        $stmt->execute();
        

        if ($id == "") {
            $msg = "Blog Data Not Inserting";
            if (isset($stmt))
                $msg = "Blog Upload Successfully";
        } else {
            $msg = "Data Not Updating";
            if (isset($stmt))
                $msg = "Blog Update Successfully";
        }
        return $msg;
    }

    function getBlogData($id){
       
        if ($id == "" ){  //&& $num == 0) {
            $getData = "Select * from $this->blog_posts ORDER BY created_at DESC";
        } else if($id != ""){   //} && $num == 0){
            $getData = "Select * from $this->blog_posts where user_id=:id ORDER BY created_at DESC";
        }
        /*else{
            $getData = "Select * from $this->blog_posts ORDER BY date DESC LIMIT :num";
        }*/
        $stmt = $this->conn->prepare($getData);
        if (isset($id))
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":num", $num);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}