
<?php
require_once ("../model/UserModel.php");
ob_start();
session_start();
if(!isset($_SESSION['UserName']))
{
    require_once ('../view/login.php');
}
else
{
    require_once ('../view/ManageUser.php');
}
require_once ("../model/UserModel.php");
$user_Model = new UserModel();
$query = $user_Model->ShowUser2();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Login_Test
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<style>
    table,th,td{
        border: 1px solid #04AA6D;
    }
</style>
<body class="">
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active ">
                    <a href="../view/ManageUser.php">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>Quản Lí User</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="../view/index.php">
                        Trang chủ
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <div class="photo">
                                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                                </div>
                                <b class="caret d-none d-lg-block d-xl-block"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item"><?php  echo($_SESSION['UserName'])?></a></li>

                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Cài đặt</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="nav-link"><a href="getController.php?controller=User&action=logout" class="nav-item dropdown-item">
                                        Log Out
                                    </a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        <div class="content">
                <div class="container"  >
                    <h2>Danh sách tài khoản</h2>
                    <br/>
                    <table style="text-align: center; border: 1px solid #04AA6D">
                        <th ">Mã tài khoản</th>
                        <th>Tên Tài Khoản</th>
                        <th>Mật khẩu</th>
                        <th colspan="3" style="text-align: center;">Thao tác</th>
                        <th></th>
                        <?php
                        $i =1;
                        while ($rs =mysqli_fetch_array($query))
                        {
                            ?>
                            <tr>
                                <td><?php echo $rs['ID']; ?></td>
                                <td><?php echo $rs['UserName']; ?></td>
                                <td><?php echo $rs['PassWord']; ?></td>
                                <td colspan="2" style="text-align: center;"><a href="getController.php?controller=User&action=Update_User&UserName=<?php echo isset($rs['UserName'])?$rs['UserName']:$_COOKIE["UserName"] ?>" class="btn btn-primary">Sua</a>
                                    </td>
                                <td><a href="Delete.php?UserName=<?php echo $rs['UserName']?>" class="btn btn-primary"
                                       onclick="return confirm('Ban co chac chan muon xoa?')">Xoa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <br/>
                        <a href="getController.php?controller=User&action=Create_New">Them Moi</a>
                        <br/>
                    </table>
                </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>

<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script>
    window.TrackJS &&
    TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
    });
</script>
</body>
</html>