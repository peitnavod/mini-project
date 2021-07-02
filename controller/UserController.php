<?php

class UserController
{
    public function getPwdSecurity($pwd) {
        return md5(md5($pwd));
    }
    public function validateToken(){
        $token ='';
        if(isset($_COOKIE['token'])){
            $token = $_COOKIE['token'];
            require_once ("../model/UserModel.php");
            $user_Model = new UserModel();
            $rs = $user_Model->checkToken($token);
            if($rs)
            {
                return $rs['UserName'];
            }
        }
        return null;
    }
    public function getUser()
    {
        ob_start();
        session_start();
        $user_name = isset($_POST['UserName'])?$_POST['UserName']:'';
        $pass = isset($_POST['PassWord'])?$_POST['PassWord']:'';
        require_once ("../model/UserModel.php");
        $user_Model = new UserModel();
        $rs = $user_Model->check($user_name);
        if(count($rs))
        {
            if(password_verify($pass,$rs['PassWord'])==true)
            {
                $_SESSION['UserName'] = $user_name;
                $_SESSION['PassWord'] = $pass;
                if (isset($_POST["remember"])) {
                        setcookie("UserName", $user_name);
                        setcookie("PassWord", $pass);
                    $token = $this->getPwdSecurity(time().$rs['UserName']);
                    setcookie('token',$token,time() + 7*24*60*60,'/');
                    $user_Model->UpdateToKen($rs['UserName'],$token);
                }
                header("location: ../view/index.php");
            }
            else
            {
                require_once ('../view/login.php');
                echo "Sai mật khẩu";
                var_dump(password_verify($pass,$rs['PassWord']));
            }
        }
        else
        {
            require_once ('../view/login.php');
            echo "Sai tên tài khoản";
        }
    }
    public function Create_New()
    {
            $user_name = $_POST['UserName'];
            $pass_word = password_hash($_POST['PassWord'],PASSWORD_DEFAULT);
            require_once ("../model/UserModel.php");
            $user_Model = new UserModel();
            $rs = $user_Model->check($user_name);
            if(count($rs)>0)
            {echo "Da ton tai tai khoan nay roi";}
            else {
                    $Post = array(
                        'UserName' => $user_name,
                        'PassWord' => $pass_word,
                    );
                    require_once ('../model/UserModel.php');
                    $user_Model = new UserModel();
                    $rs = $user_Model->Create_new($Post);
                    if($rs) {
                        header("location: ../view/ManageUser.php");
                    }
            }
    }
    public function Update_User($user_name)
    {
        $pass_word = password_hash($_POST['PassWord'],PASSWORD_DEFAULT);
        require_once ('../model/UserModel.php');
        $user_Model = new UserModel();
        $rs = $user_Model->Update($user_name,$pass_word);
        if($rs)
        {header("location: ../view/ManageUser.php");}
        else {
            header("location: ../view/Edit.php");}
    }
    public function logout()
    {
        ob_start();
        session_start();
        $token ='';
        if(isset($_COOKIE['token'])){
            $token = $_COOKIE['token'];
            require_once ("../model/UserModel.php");
            $user_Model = new UserModel();
            $user_Model->UpdateToKenLogOut($token);
        }
        setcookie('token','',time() - 7*24*60*60,'/');
        unset($_SESSION["UserName"]);
        unset($_SESSION["PassWord"]);
        header('location: ../templates/login_templates.php');
    }
}
$action = isset($_GET['action'])?$_GET['action']:'';
$controller = new UserController();
var_dump($action);
switch ($action)
{
    case 'getUser':
        if (isset($_POST['login']))
        {
            $controller->getUser();
        }
        break;
    case 'Create_New':
        require_once ('../view/Create.php');
        if(isset($_POST['create']))
        {
            $controller->Create_New();
        }
            break;
    case 'Update_User':
        $conn = new UserModel();
        $id = $_GET['UserName'];
        $row = $conn->check($id);
        require_once ('../view/Edit.php');
        if(isset($_POST['']))
        {
            $controller->Update_User($id);
        }
       break;
    case  'logout':
            $controller->logout();
        break;
    default:
        break;
}



