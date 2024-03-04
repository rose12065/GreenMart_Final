<?php
    require('../connection.php');
    //session_start();
    $adminId=$_SESSION['adminid'];
    $sql="SELECT * FROM tbl_admin_register WHERE admin_id=$adminId";
    $all_admin = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($all_admin)){
        $adminName=$row['admin_name'];
        $adminMobile=$row['admin_mobile'];
        $adminEmail=$row['admin_email'];
    }
    
    $sql_orderTotal="SELECT COUNT(*) as total_orders
    FROM tbl_order WHERE delivery_status=0";
    $total_orderCount = $conn->query($sql_orderTotal);
    while($row=mysqli_fetch_assoc($total_orderCount)){
        $totalOrder=$row['total_orders'];
    }
    if(isset($_POST['add_cat'])){
        $new_cat_name=$_POST['category'];
        $sql_category="SELECT * FROM tbl_category WHERE category_name= '$new_cat_name'";
        $catCheckResult = mysqli_query($conn,  $sql_category);
        if (mysqli_num_rows($catCheckResult) > 0) {  
            
            echo"<script>
            alert('The category already exsit');
            window.location.href='viewCategory.php';</script>";  
            exit();
        }
        $query_insert="INSERT INTO tbl_category(category_name)VALUES(' $new_cat_name')";
        if ($conn->query($query_insert) === TRUE) {
           // echo "<script>window.location.href='viewCategory.php';</scrtpt>";
            $success_message="Category Inserted successfully";
            
        }
    }
   
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Optional - Adds useful class to manipulate icon font display -->
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/helper.css">
</head>

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <!-- <div class="logo-src"></div> -->
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
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <!-- <img width="42" class="rounded-circle" src="" alt=""> -->
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                       <?php echo $adminName ; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
        </div>        
        <div class="app-main">
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
                                    <a href="admindashboard.php" class="mm-active">
                                    <i class="fa fa-dashboard"></i>
                                        Dashboard 
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Customer</li>
                                <li>
                                    <a href="viewCustomer.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        View Customer
                                    </a>
                                    <a href="orderDetails.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Order
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"><?php echo $totalOrder ; ?></span>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Seller</li>
                                <li>
                                    <a href="dashboard-boxes.html">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                         Seller Details
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Shipping </li>
                                <li>
                                    <a href="delivery.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                         Delivery 
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Category</li>
                                <li>
                                    <a href="addCategory.php">
                                        <i class="metismenu-icon pe-7s-mouse">
                                        </i>Add Category
                                    </a>
                                </li>
                                <li>
                                    <a href="viewCategory.php">
                                        <i class="metismenu-icon pe-7s-eyedropper">
                                        </i>View Category
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Products</li>
                                <li>
                                    <a href="viewProducts.php">
                                        <i class="metismenu-icon pe-7s-graph2">
                                        </i>View Products
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"><a href="../logout.php">LOGOUT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>    <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                        </i>
                                    </div>
                                    <div>Hello, <?php echo $adminName ; ?>,
                                        <div class="page-title-subheading">Welcome to the heart of our online ecosystem. The Admin Dashboard is your command center for managing our platform. 
                                        </div>
                                    </div>
                                </div>
                              </div> 
                              <?php
                         if (isset($success_message)){ 
                         echo'<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> '. $success_message;
                  
   }
    ?>
                   </div>
                       

                        <h1>ADD CATEGORY</h1><br>
                    <div class="row">
                            
                            <form class="text-center"onsubmit="return validateForm()" action="" method="post" name="myForm">
                            <div class="form-outline mb-4">
                                <input type="text" name="category" id="cat_name" class="form-control" placeholder="Category Name" onkeyup="validateCategory()" />
                                <span id="lblError" style="color: red"></span>
                            </div>
                        <button type="submit" id="add_cat" class="btn btn-primary" name="add_cat">ADD</button>
                            </form>
                            
                    </div>


                <br><br>


                    <div class="app-wrapper-footer ">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
        <script>
                function validateCategory()
                {
                    var category = document.forms["myForm"]["category"].value;
                    var namePattern = /^[A-Za-z\s&]+$/;

                    if (!category.match(namePattern)) {
                        document.getElementById("lblError").innerText = "* Category should contain only alphabet characters.";
                        return false;
                    } else {
                        document.getElementById("lblError").innerText = "";
                        return true;
                    }
                }
                
                function validateForm()
                {
                    return(validateCategory());
                }

        </script>
</body>
</html>
