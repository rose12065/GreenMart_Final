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
    $sql = "SELECT o.*,p.*,u.*,a.*, count(o.order_id) AS order_count from tbl_order o join tbl_price p on o.price_id = p.price_id join tbl_user_register u on u.role_id = p.user_id join tbl_address a on o.user_id = a.user_id where o.delivery_status = 0 and o.status = 0 and p.status = 0 group by order_id";
    
    $result = $conn->query($sql);

        $conn->close();
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
  <div class="row">
<?php
    if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
        $user_mobile = $row['user_mobile'];
        $order_id = $row['order_id'];
        $user_id = $row['user_id'];
        $delivery_status = $row['delivery_status'];
        $order_date = $row['order_date'];
        $address_id = $row['address_id'];
        $total_amount = $row['total_amount'];
        $landmark = $row['landmark'];
        $pincode = $row['pincode']; 
        $count=$row['order_count'];;      

    ?>
    <!-- Example card 1 -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-header bg-info text-white">
          Latest Undelivered Order
        </div>
        <div class="card-body">
          <h5 class="card-title">Total : <?php echo '&#8377;'. $total_amount; ?></h5>
          <p class="card-text">Ship to : <?php echo $user_name ?></p>
          <p class="card-text">Order Id : <?php echo $order_id ?> </p>
          <p class="card-text">Location : <?php echo $landmark. ', '. $pincode ?>  </p>
          <p class="card-text">Items : <?php echo $count ?>  </p>
          
          <a href="acceptOrder.php ? order_id= <?php echo $order_id ?>" class="btn btn-success">ACCEPT ORDER</a>
          
        </div>
      </div>
    </div>
<?php
  }
    }
    else {
        // No orders received yet
        echo '<div class="alert alert-info" role="alert">
            <span><h5>No orders have been received yet....</h5></span>
          </div>';
    }
  ?>

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
