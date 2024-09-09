<?php
require('../components/db_conn.php');

$response = ['message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $OCT_TCT_no = $_POST['OCT_TCT_no'];
    $lot_no = $_POST['lot_no'];
    $survey_no = $_POST['survey_no'];
    $sheet_no = $_POST['sheet_no'];
    $area = $_POST['area'];
    $date_approved = $_POST['date_approved'];
    $municipality = $_POST['municipality'];
    $brgy = $_POST['brgy'];
    $land_owner = $_POST['land_owner'];
    $geodetic_engr = $_POST['geodetic_engr'];
    $survey_type = $_POST['survey_type'];

    $map = isset($_FILES['map']['name']) ? $_FILES['map']['name'] : '';
    $map_tmp_name = isset($_FILES['map']['tmp_name']) ? $_FILES['map']['tmp_name'] : '';

    if (!empty($map)) {
        $upload_dir = '../uploads/';
        $map_path = $upload_dir . basename($map);

        if (move_uploaded_file($map_tmp_name, $map_path)) {
            $query = "UPDATE records SET OCT_TCT_no = ?, lot_no = ?, survey_no = ?, sheet_no = ?, area = ?, date_approved = ?, municipality = ?, brgy = ?, land_owner = ?, geodetic_engr = ?, survey_type = ?, map = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssssssssssi', $OCT_TCT_no, $lot_no, $survey_no, $sheet_no, $area, $date_approved, $municipality, $brgy, $land_owner, $geodetic_engr, $survey_type, $map, $id);
        }
    } else {
        $query = "UPDATE records SET OCT_TCT_no = ?, lot_no = ?, survey_no = ?, sheet_no = ?, area = ?, date_approved = ?, municipality = ?, brgy = ?, land_owner = ?, geodetic_engr = ?, survey_type = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssssssi', $OCT_TCT_no, $lot_no, $survey_no, $sheet_no, $area, $date_approved, $municipality, $brgy, $land_owner, $geodetic_engr, $survey_type, $id);
    }

    if ($stmt->execute()) {
        $response['message'] = 'Record updated successfully';
    } else {
        $response['message'] = 'Failed to update record';
    }

    $stmt->close();
} else {
    $response['message'] = 'Invalid request';
}

$conn->close();
echo json_encode($response);
?>
