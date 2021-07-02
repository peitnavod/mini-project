<?php
include ("DbModel.php");
class UserModel extends DbModel
{
    public function check($user_name)
    {
        $conn = self::connect();
        $sql = "select * from User where UserName = '$user_name'";
        $rs = $conn->query($sql);
        return $user = mysqli_fetch_assoc($rs);
    }
    public function checkToken($token)
    {
        $conn = self::connect();
        $sql = "select * from User where token = '$token'";
        $rs = $conn->query($sql);
        return $user = mysqli_fetch_assoc($rs);
    }
    public  function ShowUser2(){
        $conn = $this->connect();
        $sql = "select * from User";
        return  $rs = $conn->query($sql);;
    }
   public function Create_new($Post)
   {
       $conn = $this->connect();
       $user_name = $_POST['UserName'];
       $pass_word = password_hash($_POST['PassWord'],PASSWORD_DEFAULT);
       $sql = "INSERT INTO `User` (`UserName`, `PassWord`) VALUES ('$user_name', '$pass_word');";
       return  $rs = $conn->query($sql);
   }
    public function Update($user_name,$pass_word)
    {
        $conn = $this->connect();
        $sql = "Update User set PassWord = '$pass_word' Where UserName = '$user_name'";
        return  $rs = $conn->query($sql);
    }
    public function UpdateToKen($user_name,$token)
    {
        $conn = $this->connect();
        $sql = "Update User set token = '$token' Where UserName = '$user_name'";
        return  $rs = $conn->query($sql);
    }
    public function UpdateToKenLogOut($token)
    {
        $conn = $this->connect();
        $sql = "Update User set token = '' Where token = '$token'";
        return  $rs = $conn->query($sql);
    }
    public function Delete($user_name)
    {
        $conn = $this->connect();
        $sql = "Delete From User Where UserName = '$user_name'";
        return  $rs = $conn->query($sql);
    }
}










