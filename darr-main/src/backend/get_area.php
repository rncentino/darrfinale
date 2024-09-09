<?php
require('../components/db_conn.php');

$year = $_GET['year'] ?? '';

$query = "SELECT SUM(area) as total_area FROM records WHERE YEAR(date_approved) = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $year);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode(['area' => $data['total_area'] ?? 0]);

$stmt->close();
$mysqli->close();
?>
