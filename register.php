<?php
// Include database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'email' and 'password' are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email']; // Get Institutional Email
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Insert user into database
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ss", $email, $password);

            // Execute the query
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Institutional Email and password are required.";
    }
}
?>
