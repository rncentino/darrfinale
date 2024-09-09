<?php
require('../components/db_conn.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM records WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();

        $formattedDateApproved = date('F j, Y', strtotime($record['date_approved']));
        $formattedUploadedAt = date('F j, Y', strtotime($record['uploaded_at']));

        echo '<div class="container-fluid">';
        echo '    <div class="row">';
        echo '        <div class="col-md-12">';
        echo '            <div class="row">';
        echo '                <div class="col-md-6">';
        echo "                    <p><strong>OCT/TCT No:</strong> {$record['OCT_TCT_no']}</p>";
        echo "                    <p><strong>Lot No:</strong> {$record['lot_no']}</p>";
        echo "                    <p><strong>Survey No:</strong> {$record['survey_no']}</p>";
        echo "                    <p><strong>Sheet No:</strong> {$record['sheet_no']}</p>";
        echo "                    <p><strong>Area:</strong> " . number_format($record['area']) . "</p>";
        echo "                    <p><strong>Date Approved:</strong> {$formattedDateApproved}</p>";
        echo '                </div>';
        echo '                <div class="col-md-6">';
        echo "                    <p><strong>Municipality:</strong> {$record['municipality']}</p>";
        echo "                    <p><strong>Barangay:</strong> {$record['brgy']}</p>";
        echo "                    <p><strong>Land Owner:</strong> {$record['land_owner']}</p>";
        echo "                    <p><strong>Geodetic Engineer:</strong> {$record['geodetic_engr']}</p>";
        echo "                    <p><strong>Survey Type:</strong> {$record['survey_type']}</p>";
        echo "                    <p><strong>Uploaded At:</strong> {$formattedUploadedAt}</p>";
        echo '                </div>';
        echo '            </div>';
        
        if (!empty($record['map'])) {
            $mapPath = 'uploads/' . $record['map'];
            $mapName = basename($record['map']);
            echo "<p><strong>Map:</strong> <a href='$mapPath' target='_blank'>$mapName</a></p>";
            echo "<iframe src='$mapPath' width='100%' height='500px'></iframe>";
        } else {
            echo "<p><strong>Map:</strong> No map available.</p>";
        }

        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    } else {
        echo "<p>Record not found.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
}

$conn->close();
