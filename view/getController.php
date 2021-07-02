<?php
include ('../model/UserModel.php');
$db = new UserModel();
$controller = isset($_GET['controller'])?$_GET['controller']:'';
switch ($controller){
    case 'User': require_once ('../controller/UserController.php');
    break;
    default: require_once ('../controller/UserController.php');break;
}

