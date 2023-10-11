<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the selected country from the form
        $kotaDipilih = $_POST['kota'];
    
        // Set a cookie with the selected country
        setcookie('kota_user', $kotaDipilih, time() + (86400 * 30), "/"); // 86400 seconds = 1 day

        // Redirect back to the page or do any other processing
        header("Location: frontend.php"); // Change 'index.php' to your actual page
        exit();
    }
?>