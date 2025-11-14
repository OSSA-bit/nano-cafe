<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

    $conn = new mysqli('localhost', 'root', '', 'nano_form');
    
    if($conn->connect_error){
        die('Connection Failed: ' . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, email, phone, comments) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $comments);
    
    if($stmt->execute()){
        // SUCCESS - redirect back to form with success message
        header("Location: index.html?success=1");
        exit();
    } else {
        echo "Database Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    // If someone tries to access form.php directly
    header("Location: index.html");
    exit();
}
?>