<?php
session_start();
if(isset($_SESSION['email'])){
    header("Location:home.php");
}
    require_once "config/functions.php";
    $conn = new Functions();

    if(isset($_REQUEST['data'])){
        if(empty($_REQUEST['email'])){
            $errEmail = "Email Id is Required";
            $chk = false;
        }
        if(empty($_REQUEST['password'])){
            $errPwd = "Password is Required";
            $chk = false;
        }
        else{
            $pwd = $_REQUEST['password'];
            $len = strlen($pwd);
            if(16 < $len or 8 > $len) {
                $errPwd = "Please enter password in between 8 to 16 character";
                $chk = false;
            }
        }

        $result = $conn->checkEmailAndPassword(strtolower($_REQUEST['email']),$_REQUEST['password']);

        if(isset($result))
        {
            echo "hello";
            $_SESSION['email'] = $result['email'];
            $_SESSION['id'] = $result['id'];
            header("Location:home.php");
        }else if($result == false){
            $msg = "User id or password is worng!";
            $chk = false;
        }
    }

?>
<!DOCTYPE html>
  <head>
    <title>Student Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid m-0 p-0 bg-dark" style="min-height:657px;">
            <div class="container-fluid m-0 p-0">
                <h2 class='text-center text-warning bg-secondary py-2'>Student Login</h2>
        </div>
        <div class="container p-5">
            <form class="form text-warning" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="form-group">
                    <label for="email">Student Email</label>
                    <input type="email" class="form-control" name="email" id="email"  value="<?php echo (isset($email)) ? $email : '' ; ?>" placeholder="Enter Student Email ID">
                    <span class="text-danger"><?php echo (isset($errEmail)) ? $errEmail : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Student Password</label><span class="text-info">(Password must be 8 to 16 character.)</span>
                    <input type="password" class="form-control" name="password" id="password"  value="<?php echo (isset($password)) ? $password : '' ; ?>" placeholder="Enter Student Password">
                    <span class="text-danger"><?php echo (isset($errPwd)) ? $errPwd : '' ; ?></span>
                </div>
                <input type='submit' class='btn btn-success btn-block' value='Submit Data' name='data'>
                <span class="text-info float-right">Not registered ? <a href="index.php" class="text-danger">Register here!</a></span>
                <span class="text-success"><?php echo (isset($msg)) ? $msg : '' ; ?></span>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>