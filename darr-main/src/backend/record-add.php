<?php
require("../components/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $OCT_TCT_no = $_POST["OCT_TCT_no"];
    $lot_no = $_POST["lot_no"];
    $survey_no = $_POST["survey_no"];
    $sheet_no = $_POST["sheet_no"];
    $area = $_POST["area"];
    $date_approved = $_POST["date_approved"];
    $municipality = $_POST["municipality"];
    $brgy = $_POST["brgy"];
    $land_owner = $_POST["land_owner"];
    $geodetic_engr = $_POST["geodetic_engr"];
    $survey_type = $_POST["survey_type"];

    $map = $_FILES["map"]["name"];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($map);
    move_uploaded_file($_FILES["map"]["tmp_name"], $target_file);

    $uploaded_at = date('Y-m-d H:i:s');

    try {
        $stmt = $conn->prepare("INSERT INTO records (OCT_TCT_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, map, uploaded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssssssss", $OCT_TCT_no, $lot_no, $survey_no, $sheet_no, $area, $date_approved, $municipality, $brgy, $land_owner, $geodetic_engr, $survey_type, $map, $uploaded_at);
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