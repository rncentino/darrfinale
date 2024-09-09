<?php
require("../components/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $reg_date = date("Y-m-d H:i:s");

    $emailCheckQuery = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($emailCheckQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "error: Email is already in use.";
        exit();
    }

    $stmt->close();
    try {

        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, reg_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $password, $reg_date);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "error: Failed to insert the record.";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>
