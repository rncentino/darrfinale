<?php
require('../components/db_conn.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT id, OCT_TCT_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, map FROM records WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode($record); 
    } else {
        echo json_encode(['error' => 'Record not found']);
    }
    $stmt->close();
}
?>
