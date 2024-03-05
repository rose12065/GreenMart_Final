<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"></i>
                        Sales Report
                    </div>
                    <ul class="nav">
                        <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Current</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                            <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                        <canvas id="salesChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('connection.php');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT order_date FROM tbl_order";
    $result = mysqli_query($conn, $sql);
    
    // Initialize monthly sales array
    $monthlySalesData = array();
    
    // Process the fetched data
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Extract order date
            $orderDate = $row['order_date'];
    
            // Extract month and year from order date
            $monthYear = date('F Y', strtotime($orderDate));
    
            // Check if the month/year already exists in the monthly sales array
            if (array_key_exists($monthYear, $monthlySalesData)) {
                // Increment the count for the existing month/year
                $monthlySalesData[$monthYear]++;
            } else {
                // Add a new entry for the month/year
                $monthlySalesData[$monthYear] = 1;
            }
        }
    }
    
    // Close the database connection
    mysqli_close($conn);
    
    // Print the monthly sales array
    //print_r($monthlySalesData);
    ?>

    <script>
        // Sales data from PHP
        var salesData = <?php echo json_encode($monthlySalesData); ?>;

        // Extract labels and values from PHP data
        var labels = Object.keys(salesData);
        var values = Object.values(salesData);

        // Chart.js configuration
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales Report',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
