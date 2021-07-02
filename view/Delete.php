<?php
require_once ('../model/UserModel.php');
$user_Model = new UserModel();
$rs = $user_Model->Delete($_GET['UserName']);
if($rs)
{
    header("location: ../view/ManageUser.php");
    echo "xoa thanh cong";
}
