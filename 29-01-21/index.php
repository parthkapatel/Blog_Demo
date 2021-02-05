<?php
session_start();

    require_once "config/functions.php";
    $conn = new Functions();

if(isset($_SESSION['email']) and (empty($_REQUEST['id']) or !isset($_REQUEST['id']))){
    header("Location:home.php");
}

    if(isset($_REQUEST['data']))
    {
        $arr = $conn->dataValidation($_REQUEST['name'],$_REQUEST['gender'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['phone']);
        if(isset($arr["name"]))
            $errName = $arr["name"];
        if(isset($arr["gender"]))
            $errGen = $arr["gender"];
        if(isset($arr["email"]))
            $errEmail = $arr["email"];
        if(isset($arr["password"]))
            $errPwd = $arr["password"];
        if(isset($arr["phone"]))
            $errPhone = $arr["phone"];
        if (is_numeric($_REQUEST['data']) and count($arr) == 0 ) {
            $msg = $conn->insertData($_REQUEST['data'], $_REQUEST['name'], $_REQUEST['gender'], strtolower($_REQUEST['email']), $_REQUEST['password'],$_REQUEST['phone']);
            header("Refresh:2 url=home.php ");
        } else if (is_string($_REQUEST['data']) and count($arr) == 0 ) {
            $result = $conn->checkEmail($_REQUEST['email']);
            if ($result > 0) {
                $msg = "Email id already exists.";
                $chk = false;
            } else {
                $msg = $conn->insertData("", $_REQUEST['name'], $_REQUEST['gender'], strtolower($_REQUEST['email']), $_REQUEST['password'], $_REQUEST['phone']);
                header("Location:login.php");
            }
            header("Refresh:2 url=index.php ");
        }
    }

        if (isset($_REQUEST['id']) and !empty($_REQUEST['id'])) {
            if($_REQUEST['id'] == $_SESSION['id']){
                $upmsg = $conn->getData($_REQUEST['id']);
                $value = $upmsg[0];
               // foreach ($upmsg as $value) {
                    $id = $value['id'];
                    $nm = $value['name'];
                    $gen = $value['gender'];
                    $email = $value['email'];
                    $password = $value['password'];
                    $phone = $value['phone'];
              //  }
            }else{
                header("Location:home.php");
            }
        }


?>
<!DOCTYPE html>
  <head>
    <title>Student Registration</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid m-0 p-0 bg-dark" style="min-height:657px;">
            <div class="container-fluid m-0 p-0">
                <?php
                if(isset($upmsg)){
                    echo "<h2 class='text-center text-warning bg-secondary py-2'>Update Student Data</h2>";
                }else{
                    echo "<h2 class='text-center text-warning bg-secondary py-2'>Student Registration</h2>";
                }
                ?>
        </div>
        <div class="container p-5">
            <form class="form text-warning" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="<?php echo (isset($nm)) ? $nm : '' ; ?>" placeholder="Enter Student Name">
                    <span class="text-danger"><?php echo (isset($errName)) ? $errName : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="gender">Select Gender</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="male"  checked value="male" >
                            Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="female" <?php ((isset($gen) and $gen == "female")) ? $ch1="checked" : $ch1="" ; ?> value="female" <?php echo $ch1; ?>>
                            Female
                        </label>
                    </div>
                    <span class="text-danger"><?php echo (isset($errGen)) ? $errGen : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="email">Student Email</label>
                    <input type="email" class="form-control" name="email" id="email"  value="<?php echo (isset($email)) ? $email : '' ; ?>" <?php echo (isset($email)) ? 'readonly' : '' ; ?> placeholder="Enter Student Email ID">
                    <span class="text-danger"><?php echo (isset($errEmail)) ? $errEmail : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Student Password</label><span class="text-info">(Password must be 8 to 16 character.)</span>
                    <input type="password" class="form-control" name="password" id="password"  value="" placeholder="Enter Student Password"><p id="counter" value=""></p>
                    <span class="text-danger"><?php echo (isset($errPwd)) ? $errPwd : '' ; ?></span>
                </div>

                <div class="form-group">
                    <label for="phone">Student Contact No.</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo (isset($phone)) ? $phone : '' ; ?>" placeholder="Enter Student Contact No.">
                    <span class="text-danger"><?php echo (isset($errPhone)) ? $errPhone : '' ; ?></span>
                </div>


                    <?php
                        if(isset($upmsg)){
                            echo "<button type='submit' class='btn btn-success btn-block' value='".$id."' name='data'>Update Data</button>";
                        }else{
                            echo "<input type='submit' class='btn btn-success btn-block' value='Submit Data' name='data'>
                            <span class='text-info float-right'>already registered ? <a href='login.php' class='text-danger'>Login here!</a></span>";
                        }
                    ?>
                <span class="text-success"><?php echo (isset($msg)) ? $msg : '' ; ?></span>
            </form>
        </div>
    </div>

    <script>
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>