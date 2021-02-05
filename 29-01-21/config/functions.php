<?php

class Functions
{
    private $conn;

    function __construct()
    {
        require_once "connection.php";
        $db = new connection();
        $this->conn = $db->DBConnect();
    }

    function insertData($id, $name, $gender, $email, $password, $phone)
    {
        $this->createTable();
        if ($id == "") {
            $dataQuery = "INSERT INTO student_data( name, gender, email,password, phone) VALUES (:name,:gender,:email,:password,:phone)";
        } else {
            $dataQuery = "update student_data set name=:name ,gender=:gender ,email=:email ,password=:password ,phone=:phone where id=:id";
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
                CREATE TABLE IF NOT EXISTS student_data(
                    id int primary key AUTO_INCREMENT,
                    name varchar(25) not null,
                    gender varchar(6) not null,
                    email varchar(50) not null,
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
            $getData = "Select * from student_data";
        } else {
            $getData = "Select * from student_data where id=:id";
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
        
        $deleteData = "delete from student_data where id=:id";
        $stmt = $this->conn->prepare($deleteData);
        $stmt->bindParam(":id", $id);
        $msg = "Data Not Deleted";
        if ($stmt->execute())
            $msg = "Data Deleted Successfully";
        return $msg;
    }

    function checkEmail($email)
    {
        
        $checkEmail = "select * from student_data where email=:email";
        $stmt = $this->conn->prepare($checkEmail);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchAll();
        return $stmt->rowCount();
    }

    function checkEmailAndPassword($email, $password)
    {
        
        $checkEmail = "select id,email,password from student_data where email=:email";
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
}