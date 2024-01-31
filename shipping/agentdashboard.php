<?php
    require('../connection.php');
    $agentId=$_SESSION['agnetid'];
    $sql_delivery="SELECT d.*, r.email AS role_email
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
        $sql = "SELECT 
                    o.order_id,
                    o.user_id,
                    o.delivery_status,
                    o.order_date,
                    p.address_id,
                    p.total_amount,
                    u.user_name
                FROM 
                    tbl_order o
                JOIN 
                    tbl_price p ON o.price_id = p.price_id
                JOIN 
                    tbl_user_register u ON o.user_id = u.user_id
                WHERE 
                    o.delivery_status = 0
                    AND o.status = 0
                    AND p.status = 0";
                    

        $result = $conn->query($sql);

        $conn->close();
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
                <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                        </i>
                                    </div>
                                    <div>Hello, 
                                        <div class="page-title-subheading">Welcome to the GreenMart Delivery Team. 
                                        </div>
                                    </div>
                                </div>
                              </div> 
                        </div>
                        <div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <!-- Display agent profile information here -->
                    <p class="card-text">Agent Name : <?php echo $agent_name ; ?></p>
                    <p class="card-text">Email : <?php echo $agent_email ; ?></p>
                    <p class="card-text">Phone : <?php echo $agent_phone ; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Delivery Status</h5>
                    <!-- Display delivery status information here -->
                    <p class="card-text">Pending Deliveries: 5</p>
                    <p class="card-text">Completed Deliveries: 10</p>
                </div>
            </div>
            <?php
                // if ($result->num_rows > 0) {
                //     // Output data of each row
                //     while ($row = $result->fetch_assoc()) {
                //         echo "Order ID: " . $row["order_id"] . "<br>";
                //         echo "Customer Name: " . $row["user_name"] . "<br>";
                //         echo "Delivery Status: " . $row["delivery_status"] . "<br>";
                //         echo "Order Date: " . $row["order_date"] . "<br>";
                //         echo "Address ID: " . $row["address_id"] . "<br>";
                //         echo "Total Amount: " . $row["total_amount"] . "<br>";
                //         echo "------------------------<br>";
                  ?>
            <!-- <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Recent Deliveries</h5>
                    
                    <ul>
                        <li>Delivery #1 - Status: Pending</li>
                        <li>Delivery #2 - Status: Completed</li>
                        
                    </ul>
                </div>
            </div> -->

            <?php
                // }
                // } 
            ?>
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
