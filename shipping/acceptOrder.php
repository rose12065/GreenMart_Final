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
    }
    if(isset($_GET['order_id'])){
        $orderId=$_GET['order_id'];
        $sql_agent_update = "UPDATE tbl_order SET delivery_agent_id = $agentId, delivery_status='Shipped' WHERE order_id =  '$orderId'";
        $result_agent_update = $conn->query($sql_agent_update);

        $sql_orders="SELECT o.*,a.*,u.*, count(o.order_id) AS order_count FROM tbl_order o 
        JOIN tbl_user_register u on u.role_id = o.user_id 
        JOIN tbl_address a on a.user_id = o.user_id 
        WHERE o.delivery_status = 'Shipped' AND o.status = 0 
        AND o.delivery_agent_id = $agentId 
        GROUP BY order_id";
        $result_orders = $conn->query($sql_orders);

    
    }
       
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
    <h2 class="mb-4">ORDER LOGS</h2>

    
    <!-- Order Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Delivery Address</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result_orders) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result_orders))
            {
                $user_name = $row['user_name'];
                $user_mobile = $row['user_mobile'];
                $order_id = $row['order_id'];
                $user_id = $row['user_id'];
                $delivery_status = $row['delivery_status'];
                $order_date = $row['order_date']; 
                $address_id = $row['address_id'];
                $flat = $row['flat'];
                $landmark = $row['landmark'];
                $pincode = $row['pincode']; 
                $count = $row['order_count'];
            
    ?>
        <!-- Sample Data (Replace with actual data) -->
        <tr>
            <td><?php echo $order_id ?></td>
            <td><?php echo $user_name ?></td>
            <td><?php echo $flat. '(H), '.$landmark.  " P.O".', '. $pincode ?></td>
            <?php 
                if($delivery_status==0)
                {
                    ?>
                   <td class="text-center">
                    <div class="badge badge-warning">PENDING</div>
                </td>

                <form method="POST">
                    <td>
                            <button type="submit" name="delivery_success" class="btn btn-success btn-sm">Delivered</button>
                    </td>
                </form>
               <?php
                }
                else
                {
                    ?>
                    <td class="text-center">
                    <div class="badge badge-success">DELIVERED</div>
                </td>
                 </td>
                 <?php
                }
            ?>
            
            
        </tr>
        <?php
  }

    }
    else {
        // No orders received yet
        echo '<div class="alert alert-info" role="alert">
            <span><h5>No orders have been received yet....</h5></span>
          </div>';
    }

    if(isset($_POST['delivery_success']))
    {
        $sql_delivery_status_update = "UPDATE tbl_order SET delivery_status = 1 WHERE order_id =  '$orderId'";
        if ($conn->query($sql_delivery_status_update) == TRUE)
        {
            echo'<script>alert("Do you successfully delivered")</script>';
            echo'<script>window.location.href="agentCompleteOrderView.php";</script>';
        }
    }

    $conn->close();

  ?>
        <!-- Add more rows based on actual data -->
        </tbody>
    </table>
</div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            
        </div>
    </div>
</div>
                    <!-- Agent Main Content -->
                    <!-- ... (similar to the admin dashboard) -->
                    
                </div>
            </div>
        </div>

        <!-- Optional: Theme Settings -->
        <div class="ui-theme-settings">
            <!-- ... (similar to the admin dashboard) -->
        </div>
    </div>

    <!-- Your Scripts -->
    <!-- ... (include your JavaScript files and other scripts) -->

</body>
</html>
