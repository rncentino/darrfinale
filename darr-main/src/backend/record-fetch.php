<?php
require('../components/db_conn.php');

$records_per_page = 10;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($current_page - 1) * $records_per_page;
$searchQuery = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$query = "SELECT id, oct_tct_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, uploaded_at, map FROM records";

if (!empty($searchQuery)) {
    $query .= " WHERE oct_tct_no LIKE '%$searchQuery%' 
                OR lot_no LIKE '%$searchQuery%' 
                OR survey_no LIKE '%$searchQuery%' 
                OR municipality LIKE '%$searchQuery%' 
                OR brgy LIKE '%$searchQuery%' 
                OR land_owner LIKE '%$searchQuery%' 
                OR geodetic_engr LIKE '%$searchQuery%'
                OR date_approved LIKE '%$searchQuery%'";
}

$total_query = "SELECT COUNT(*) FROM ($query) AS total";
$total_result = $conn->query($total_query);
$total_records = $total_result->fetch_row()[0];
$total_pages = ceil($total_records / $records_per_page);

$query .= " LIMIT $offset, $records_per_page";

$result = $conn->query($query);

$records = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $formattedDateApproved = date('F j, Y', strtotime($row['date_approved']));

        $records .= "<tr>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>" . number_format($row['area']) . "</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['lot_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['land_owner']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['municipality']}, {$row['brgy']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$formattedDateApproved}</p></td>";

        $records .= "<td class='border-bottom-0'>
            <button class='btn btn-primary view-pdf-btn' data-pdf-path='uploads/{$row['map']}' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                <i class='ti ti-file-text'></i>
            </button>
        </td>";
        
        $records .= "<td class='border-bottom-0'> 
            <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#viewRecordModal' onclick='viewRecord({$row['id']})'>
                <i class='ti ti-eye'></i>
            </button>
            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                <i class='ti ti-edit'></i>
            </button>
            <button class='btn btn-danger delete-record-btn' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#deleteRecordModal'>
                <i class='ti ti-trash'></i>
            </button>
        </td>";
        
        $records .= "</tr>";
    }
}
 else {
    $records .= "<tr><td colspan='7' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
}


$pagination = '';
if ($total_pages > 1) {
    if ($current_page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page - 1) . '">Previous</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }

    if ($current_page < $total_pages) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page + 1) . '">Next</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link">Next</a></li>';
    }
}

$response = ['records' => $records, 'pagination' => $pagination];
header('Content-Type: application/json');
echo json_encode($response);

