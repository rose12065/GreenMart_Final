<?php
require('./fpdf/fpdf.php');
include('connection.php');

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    $sql = "SELECT 
                o.*,p.*,pr.*,a.*,u.*
            FROM 
                tbl_order o
            JOIN 
                tbl_price pr ON o.price_id = pr.price_id
            JOIN 
                tbl_product p ON o.product_id = p.product_id
            JOIN 
                tbl_user_register u ON o.user_id = u.role_id
            JOIN 
                tbl_address a ON pr.address_id = a.address_id
            WHERE 
                o.order_id = '$orderId' Group by o.order_id";
    $result = $conn->query($sql);

    $sql_product = "SELECT p.*, o.*,pr.* from tbl_order o join tbl_product p on o.product_id = p.product_id 
                    join tbl_price pr on pr.price_id=o.price_id
                    where o.order_id ='$orderId'";
    $result_product = $conn->query($sql_product);

    $sql_amount = "SELECT o.*,pr.checkout_amount as amount from tbl_order o join tbl_price pr on pr.price_id=o.price_id
                    where o.order_id ='$orderId' ";
    $result_amount = $conn->query($sql_amount);

    if ($result->num_rows > 0 && $result_product->num_rows > 0 && $result_amount->num_rows > 0) {
        // Initialize total amount variable
        $checkout_Amount = 0;

        // Step 4: Generate PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font for company details
        $pdf->SetFont('Arial', 'B', 14);

        // Set background color for company details
        $pdf->SetFillColor(144, 238, 144); 
        $pdf->Cell(0, 10, 'GreenMart', 0, 1, 'C', true);
        $pdf->Cell(0, 10, 'Kottayam | Phone: 7845968754 | Email: greenmart@gmail.com', 0, 1, 'C', true); // Add space after company details

        $pdf->Ln(10); // Add space between company details and customer details

        // Customer Details
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(45, 10, 'OrderId: ', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $row['order_id'], 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(45, 10, 'Customer Name: ', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $row['user_name'], 0, 1);
        
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(45, 10, 'Address: ', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $row['flat'] . ', ' . $row['landmark'] . ' P.O, ' . $row['pincode'] . ', ' . $row['mobile'], 0, 1);
        
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(45, 10, 'Order Date: ', 0, 0);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $row['order_date'], 0, 1);
        
            $pdf->Ln(5); // Add space between customer details and product details
        }
        

        // Product List
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(220, 220, 220); // Light gray background for headers
        $pdf->Cell(100, 10, 'Product Name', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Unit Price', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'Quantity', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Total Price', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 12);
        while ($row_pdt = mysqli_fetch_assoc($result_product)) {
            $pdf->Cell(100, 10, $row_pdt['product_name'], 1);
            $pdf->Cell(30, 10, $row_pdt['unit_price'], 1);
            $pdf->Cell(20, 10, $row_pdt['quantity'], 1);
            $totalPrice = $row_pdt['unit_price'] * $row_pdt['quantity'];
            $pdf->Cell(40, 10, $totalPrice, 1, 1);

            // Add to total amount
            $checkout_Amount += $totalPrice;
        }

        // Total Amount
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(150, 10, 'Total Amount', 1, 0, 'R', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, $checkout_Amount, 1, 1, '', true);

        // Output PDF
        $pdf->Output();
    }
}
?>
