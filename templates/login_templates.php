<?php
require_once("../controller/UserController.php");
$controller = new UserController();
ob_start();
session_start();
if(isset($_SESSION['UserName']))
{header('location: ../view/index.php');}
else
{
  $rs=$controller->validateToken();
  if($rs!=null)
  {
      header('location: ../view/index.php');
      die();
  }
  else
  {
      require_once ('../view/login.php');
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="../assets/StyleSheet.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<form action="?action=getUser" method="POST" enctype="multipart/form-data">
    <div class="container">
       <div class="col-md-12">
           <label for="uname"><b>Username</b></label>
           <input type="text" placeholder="Enter Username" id="Name" name="UserName" value="<?php echo ($_COOKIE["UserName"])?>" required>

           <label for="psw"><b>Password</b></label>
           <input type="password" placeholder="Enter Password" id="Pass" name="PassWord" value="<?php echo ($_COOKIE["PassWord"])?>" required>

           <button type="submit" name="login">Login</button>
           <label>
               <input type="checkbox" checked="checked" name="remember" onclick="return confirm('Ban co muon luu mat khau?')"> Remember me
           </label>
       </div>
    </div>
</form>
</body>
</html>
