<?php
$con = mysqli_connect("localhost", "root", "", "greenmart");

if ($con === false) {
    die("Error");
}

if (isset($_GET['delivery_id'])) {
    $id = $_GET['delivery_id'];

    // Retrieve file details from the database
    $result = mysqli_query($con, "SELECT cv FROM tbl_delivery_register WHERE role_id = $id");

    if ($result && mysqli_num_rows($result) > 0) {
        $info = mysqli_fetch_assoc($result);

        // Assuming the 'cv' column stores the filename in the 'pdf' folder
        $filename = "C:/xampp/htdocs/GreenMart_final/pdf/" . $info['cv'];

        // Check if the file exists
        if (file_exists($filename)) {
            // Set the appropriate headers for a PDF file
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($filename) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            // Set Content-Length header
            header('Content-Length: ' . filesize($filename));

            // Output the file content directly to the browser
            readfile($filename);
            exit;
        } else {
            echo 'File not found in the "pdf" folder.';
        }
    } else {
        echo 'File not found or invalid data.';
    }
}

mysqli_close($con);
exit;
?>
