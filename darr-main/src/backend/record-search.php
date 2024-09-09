<?php
include 'db_conn.php';

$q = $_GET['q'] ?? '';

if (!empty($q)) {
    $searchQuery = $conn->real_escape_string($q);

    $query = "SELECT id, oct_tct_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, uploaded_at, map 
              FROM records 
              WHERE oct_tct_no LIKE '%$searchQuery%' 
                 OR lot_no LIKE '%$searchQuery%' 
                 OR survey_no LIKE '%$searchQuery%' 
                 OR municipality LIKE '%$searchQuery%' 
                 OR brgy LIKE '%$searchQuery%' 
                 OR land_owner LIKE '%$searchQuery%' 
                 OR geodetic_engr LIKE '%$searchQuery%'";
} else {
    $query = "SELECT id, oct_tct_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, uploaded_at, map 
              FROM records";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['oct_tct_no']}</p></td>";
        echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['lot_no']}</p></td>";
        echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_no']}</p></td>";
        echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['municipality']}, {$row['brgy']}</p></td>";
        echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>Engr. {$row['geodetic_engr']}</p></td>";
        echo "<td class='border-bottom-0'>
                <button href='uploads/{$row['map']}' class='btn btn-primary view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                    <i class='ti ti-file-text'></i>
                </button>
                <button href='uploads/{$row['map']}' class='btn btn-success view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewImgModal'>
                    <i class='ti ti-photo'></i>
                </button>
              </td>";
        echo "<td class='border-bottom-0'>
                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                    <i class='ti ti-eye'></i>
                </button>
                <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                    <i class='ti ti-edit'></i>
                </button>
                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteRecordModal' onclick='deleteRecord({$row['id']})'>
                    <i class='ti ti-trash'></i>
                </button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
}
?>
