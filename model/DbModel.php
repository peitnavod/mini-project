<?php
class DbModel{
    public function connect(){
        $server_name = "127.0.0.1";
        $user_name = "root";
        $password = "";
        $database = "mvc_php";
        $conn = mysqli_connect($server_name,$user_name,$password,$database);
        if (mysqli_connect_errno())
        {
            echo "Failed : " . mysqli_connect_error();
        }
        return $conn;
    }
}



