<?php
require('../components/db_conn.php');

$response = array();


if(isset($_GET["record_id"])) {
    $record_id = intval($_GET["record_id"]);

    $sql = "DELETE FROM records WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $record_id);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Record deleted successfully.";
    } else {
        $response["success"] = false;
        $response["message"] = "Error deleting record.";
    }

    $stmt->close();
} else {
    $response["success"] = false;
    $response["message"] = "Invalid request. Record ID not set.";
}

$conn->close();
echo json_encode($response);

