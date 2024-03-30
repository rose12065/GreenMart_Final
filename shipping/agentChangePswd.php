<?php
    require('../connection.php');
    $agentId=$_SESSION['agnetid'];
    $sql_delivery="SELECT d.*, r.email AS role_email,r.password AS role_password
    FROM tbl_delivery_register d
    JOIN tbl_role r ON d.role_id = r.role_id
    WHERE d.role_id = $agentId";

    $all_delivery = $conn->query($sql_delivery);
    while ($row = mysqli_fetch_assoc($all_delivery)){
        $agent_name = $row['agent_name'];
        $agent_email = $row['role_email'];
        $agent_status = $row['status'];
        $agent_phone = $row['phone'];
        $agent_password=$row['role_password'];
    }

    if(isset($_POST['change-pswd'])){
        $oldPass=$_POST['oldPassword'];
        $newPass=$_POST['newPassword'];
        $confirmPass=$_POST['confirmPassword'];

        if($agent_password==$oldPass){
            if($newPass==$confirmPass){
                $sql_update = "UPDATE tbl_role SET password = '$newPass' WHERE role_id = $agentId ";
                $conn->query($sql_update);
                echo '<script>alert("Password updated succesfully")</script>';
            }
            else{
                echo '<script>alert("Password Doesn\'t match")</script>';
            }
        }
        else{
            echo '<script>alert("Current Password is Incorrect")</script>';
        }
    } 
?>


    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Agent Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Agent Dashboard">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/helper.css">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

    <script>
        function validatePassword() {
            var password = document.forms["myForm"]["newPassword"].value;
            var passwordPattern = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

            if (!password.match(passwordPattern)) {
                document.getElementById("lblErrorPass").innerText = "Password should be 6-16 characters, with at least one special character and one number.";
                return false;
            } else {
                document.getElementById("lblErrorPass").innerText = "";
                return true;
            }
        }

        function validateRepeatPassword() {
            var password = document.forms["myForm"]["newPassword"].value;
            var repeatPassword = document.forms["myForm"]["confirmPassword"].value;

            if (password !== repeatPassword) {
                document.getElementById("lblErrorRepeatPass").innerText = "Passwords do not match.";
                return false;
            } else {
                document.getElementById("lblErrorRepeatPass").innerText = "";
                return true;
            }
        }

        function validateForm() {
            return (
                validatePassword() &&
                validateRepeatPassword()
            );
        }
    </script>

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- Agent Header Section -->
        <div class="app-header header-shadow">
            <!-- Agent Header Content -->
            <!-- ... (similar to the admin dashboard) -->
            
        </div>

        <!-- Agent Sidebar Section -->
        <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="agentdashboard.php" class="mm-active">
                                    <i class="fa fa-dashboard"></i>
                                        Dashboard 
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Orders</li>
                                <li>
                                    <a href="agentOrderView.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Order
                                    </a>
                                </li>
                                <li>
                                    <a href="agentCompleteOrderView.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Completed Order
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Account Settings</li>
                                <li>
                                    <a href="agentChangePswd.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                         Change Password
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"><a href="../logout.php">LOGOUT</a></li>
                            </ul>
                        </div>
        </div>
</div>

        <!-- Agent Main Content -->
        <div class="app-main">    
            <div class="app-main__outer">
                <div class="app-main__inner">
                       
                        <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                <h3 class="text-center">Change Password</h3>
                                </div>
                                <div class="card-body">
                                <form name="myForm" onsubmit="return validateForm()" action="" method="post">
                                    <div class="form-group">
                                    <label for="oldPassword">Old Password</label>
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                                    </div>

                                    <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" onkeyup="validatePassword()" required>
                                    <span id="lblErrorPass" style="color: red"></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="confirmPassword">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" onkeyup="validateRepeatPassword()" required>
                                    <span id="lblErrorRepeatPass" style="color: red"></span>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block" name="change-pswd">Change Password</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            
                            </div>
                            <footer class="text-center text-lg-start bg-body-tertiary text-muted">
 
 <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
   © 2024 Copyright:
   <a class="text-reset fw-bold" href="#">GreenMart</a>
 </div>
</footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
