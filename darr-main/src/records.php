<?php 
session_start();
$title = "Records";
require("components/auth.php");
require('components/header.php'); 

?>


<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <!-- Main wrapper -->
    <div class="body-wrapper">

      <!-- Header Start -->
      <?php require("components/nav.php") ?>
      <!-- Header End -->


      

      

      <!-- Tables Section-->
      <div class="container-fluid">
        <div class="card bg-secondary-subtle">
          <div class="card-body">
            <h2 class="fw-bold mb-4 p-3 border-bottom border-success border-3">DAR Survey Team Records</h2>

            <!-- stats record -->
            <?php include('backend/counts.php') ?>
                <div class="row" id="countTable">
                <div class="col-md-4">
                    <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="bg-primary rounded-2 p-4 d-flex align-items-center justify-content-center">
                            <i class="ti ti-files text-white" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                        <div class="col ms-3">
                            <div class="numbers">
                            <p class="card-category">Files</p>
                            <h4 class="card-title">
                                <?php echo $file_count; ?>
                            </h4>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="bg-success rounded-2 p-4 d-flex align-items-center justify-content-center">
                            <i class="ti ti-folders text-white" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                        <div class="col ms-3">
                            <div class="numbers">
                            <p class="card-category">Record</p>
                            <h4 class="card-title">
                                <?php echo $record_count; ?>
                            </h4>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="card card-stats card-round">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="bg-warning rounded-2 p-4 d-flex align-items-center justify-content-center">
                    <i class="ti ti-map text-white" style="font-size: 1rem;"></i>
                </div>
            </div>
            <div class="col ms-3">
                <div class="numbers">
                    <p class="card-category">Area</p>
                    <h4 class="card-title" id="area-display">
                        <!-- Initially blank, will be populated by JavaScript -->
                    </h4>
                </div>
            </div>
            <div class="col-auto">
                <select class="form-select" id="year-select">
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
            </div>
        </div>
    </div>
</div>

                </div>
                </div>
                <!-- stats end -->

            <p class="alert alert-info d-flex align-items-center">
                <i class="ti ti-info-square me-2" style="font-size: 1.5rem;"></i>
                Search by: OTC/TCT No, Lot No, Survey No, Geodetic Engr, Land Owner, Date Approved (Yr) & Location 
            </p>
            <!-- record list -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <!-- Header section -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                            <h5 class="card-title fw-semibold mb-2 mb-md-0">Manage Records</h5>
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                                <!-- Search Bar -->
                                <div class="mb-2 mb-md-0">
                                    <form class="d-flex" action="record-search.php" method="get">
                                        <div class="input-group">
                                            <input type="text" id="search" name="q" class="form-control" placeholder="Search...">
                                            <button type="submit" class="btn btn-success" aria-label="Search" disabled>
                                                <i class="ti ti-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Add Record Button -->
                                <button type="button" class="btn btn-primary ms-md-3" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                                    <i class="ti ti-plus"></i> Add Record
                                </button>
                            </div>
                        </div>


                        <!-- Table Section -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle table-striped">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Area</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Lot No.</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Survey No.</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Land Owner</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Location</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Date Approved</h6>
                                        </th>
                                       
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Map</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="search-results">
                                    <!-- Records will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example" class="mt-4">
                            <ul class="pagination justify-content-end" id="pagination">
                                <!-- Pagination links will be loaded here via AJAX -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


          </div>
        </div>
      </div>
      <!-- End Tables Section -->

      <div class="container-fluid">
                <div class="card bg-secondary-subtle">
                <div class="card-body">
                    <h2 class="fw-bold mb-4 p-3 border-bottom border-success border-3">
                    KML File Viewer
                    </h2>
            
                 

                    <!-- leaflet filelayer (kml viewer) -->
                    <div class="card">
                    <div class="card-body">
                        <p class="alert alert-info d-flex align-items-center">
                            <i class="ti ti-info-square me-2" style="font-size: 1.5rem;"></i>
                            Click on the icon to browse and load local kml files on the map.
                        </p>

                        <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                    </div>
                    <!-- leaflet filelayer (kml viewer) end -->

                </div>
                </div>
            </div>


      <!-- Modals -->
       <!-- Preloader Modal -->
        <div class="modal fade" id="preloaderModal" tabindex="-1" aria-labelledby="preloaderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <dotlottie-player src="https://lottie.host/ab3a3932-b401-40d9-b6e2-9ce8fc53d034/4Ec7cbetuI.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                    </div>
                </div>
            </div>
        </div>

      <!-- Add Record Modal -->
      <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addRecordModalLabel">Add Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="addRecordForm" class="row g-3">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="OCT_TCT_no" class="form-label">OCT/TCT No</label>
                    <input type="text" class="form-control" id="OCT_TCT_no" name="OCT_TCT_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="lot_no" class="form-label">Lot No</label>
                    <input type="text" class="form-control" id="lot_no" name="lot_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="survey_no" class="form-label">Survey No</label>
                    <input type="text" class="form-control" id="survey_no" name="survey_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="sheet_no" class="form-label">Sheet No</label>
                    <input type="text" class="form-control" id="sheet_no" name="sheet_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="area" class="form-label">Area (Sq. M)</label>
                    <input type="text" class="form-control" id="area" name="area" required>
                  </div>
                  <div class="mb-3">
                    <label for="date_approved" class="form-label">Date Approved</label>
                    <input type="date" class="form-control" id="date_approved" name="date_approved" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="municipality" class="form-label">Municipality</label>
                    <input type="text" class="form-control" id="municipality" name="municipality" required>
                  </div>
                  <div class="mb-3">
                    <label for="brgy" class="form-label">Brgy</label>
                    <input type="text" class="form-control" id="brgy" name="brgy" required>
                  </div>
                  <div class="mb-3">
                    <label for="land_owner" class="form-label">Land Owner</label>
                    <input type="text" class="form-control" id="land_owner" name="land_owner" required>
                  </div>
                  <div class="mb-3">
                    <label for="geodetic_engr" class="form-label">Geodetic Engr.</label>
                    <input type="text" class="form-control" id="geodetic_engr" name="geodetic_engr" required>
                  </div>
                  <div class="mb-3">
                    <label for="survey_type" class="form-label">Survey Type</label>
                    <input type="text" class="form-control" id="survey_type" name="survey_type" required>
                  </div>
                  
                  <div class="mb-3">
                    <label for="map" class="form-label">Map</label>
                    <input type="file" class="form-control" id="map" name="map">
                  </div>
                </div>

                <div class="modal-footer">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Add Record Modal -->

      <!-- View PDF Modal -->
      <div class="modal fade" id="viewPDFModal" tabindex="-1" aria-labelledby="viewPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewPDFModalLabel">View PDF</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="" style="width:100%; height:450px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
          </div>
        </div>
      </div>

      <!-- View Record Modal -->
      <div class="modal fade" id="viewRecordModal" tabindex="-1" aria-labelledby="viewRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewRecordModal">Record Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="recordDetails">
              </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End View Record Modal -->

      <!-- Edit Record Modal -->
      <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editRecordModalLabel">Edit Record</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="editRecordForm" class="row g-3">
                          <input type="hidden" id="edit_id" name="id">

                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="edit_OCT_TCT_no" class="form-label">OTC/TCT No</label>
                                  <input type="text" class="form-control" id="edit_OCT_TCT_no" name="OCT_TCT_no" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_lot_no" class="form-label">Lot No</label>
                                  <input type="text" class="form-control" id="edit_lot_no" name="lot_no" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_survey_no" class="form-label">Survey No</label>
                                  <input type="text" class="form-control" id="edit_survey_no" name="survey_no" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_sheet_no" class="form-label">Sheet No</label>
                                  <input type="text" class="form-control" id="edit_sheet_no" name="sheet_no" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_area" class="form-label">Area (Sq. M)</label>
                                  <input type="text" class="form-control" id="edit_area" name="area" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_date_approved" class="form-label">Date Approved</label>
                                  <input type="date" class="form-control" id="edit_date_approved" name="date_approved" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label for="edit_municipality" class="form-label">Municipality</label>
                                  <input type="text" class="form-control" id="edit_municipality" name="municipality" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_brgy" class="form-label">Brgy</label>
                                  <input type="text" class="form-control" id="edit_brgy" name="brgy" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_land_owner" class="form-label">Land Owner</label>
                                  <input type="text" class="form-control" id="edit_land_owner" name="land_owner" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_geodetic_engr" class="form-label">Geodetic Engr.</label>
                                  <input type="text" class="form-control" id="edit_geodetic_engr" name="geodetic_engr" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_survey_type" class="form-label">Survey Type</label>
                                  <input type="text" class="form-control" id="edit_survey_type" name="survey_type" required>
                              </div>
                              
                              <div class="mb-3">
                                  <label for="edit_map" class="form-label">Map</label>
                                  <input type="file" class="form-control" id="edit_map" name="map">
                                  <small id="edit_map_name" class="form-text text-muted"></small>
                              </div>
                          </div>

                        <div class="modal-footer">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Update Record</button>
                            </div>
                        </div>

                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Edit Record Modal -->

      <!-- Delete Record Modal -->
      <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteRecordModalLabel">Delete Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="OCT_TCT_no" class="form-label">Type "Confirm" to Delete</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteRecordButton">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Record Modal  -->


      
        </div>
    </div>

   
    <?php include('footer.php') ?>

   
</body>


<!-- scripts -->
<?php include('components/scripts.php') ?>
<?php include('components/kml.php') ?>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false, 
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const selectElement = document.getElementById('year-select');
        const areaDisplay = document.getElementById('area-display');

        function fetchAndUpdateArea(year) {
            fetch(`backend/get_area.php?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    areaDisplay.textContent = data.area ? data.area + ' sq km' : 'No data';
                })
                .catch(error => {
                    console.error('Error:', error);
                    areaDisplay.textContent = 'Error fetching data';
                });
        }

        // Fetch area for the initially selected year on page load
        fetchAndUpdateArea(selectElement.value);

        // Update area when a new year is selected
        selectElement.addEventListener('change', function() {
            const year = this.value;
            fetchAndUpdateArea(year);
        });
    });

// fetch record
$(document).ready(function() {
    function loadRecords(page, query = '') {
        $.ajax({
            url: "backend/record-fetch.php",
            type: "GET",
            data: { page: page, q: query },
            success: function(response) {
    if (typeof response === 'string') {
        response = JSON.parse(response);
    }
    if (response.error) {
        console.error("Error fetching records:", response.error);
        return;
    }
    $("#search-results").html(response.records);
    $("#pagination").html(response.pagination);
},
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);  // Handle errors
            }
        });
    }

    // Initial load
    loadRecords(1);

    // Handle pagination click
    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();
        var page = $(this).data("page");
        var query = $('#search').val();  // Get the current search query
        loadRecords(page, query);
    });


    $('#search').on('input', function() {
        var query = $(this).val();
        if (query.length > 3) {
            loadRecords(1, query);  
        } else {
            loadRecords(1);  
        }
    });
});

// pdf viewer
$(document).on('click', '.view-pdf-btn', function(e) {
    e.preventDefault();
    var pdfUrl = $(this).attr('href');
    
    PDFObject.embed(pdfUrl, '#pdfViewer', {
        height: "450px",
        width: "100%",  
    });

    $('#viewPDFModal').modal('show');  
});

$(document).on('click', '.view-pdf-btn', function() {
    var pdfPath = $(this).data('pdf-path'); 
    $('#viewPDFModal iframe').attr('src', pdfPath);  
});


// add record
$(document).ready(function() {
    $('#addRecordForm').submit(function(e) {
        e.preventDefault();

        // Check if a file is present
        var hasFile = $('#addRecordForm')[0].querySelector('input[type="file"]').files.length > 0;
        $('#addRecordModal').modal('hide');

        // If there's a file, show the preloader modal
        if (hasFile) {
            $('#addRecordModal').modal('hide');
            $('#preloaderModal').modal('show');
        }

        // Perform AJAX request
        $.ajax({
            url: 'backend/record-add.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // If there was a file, hide the preloader modal
                if (hasFile) {
                    $('#preloaderModal').modal('hide');
                }

                if (response.trim() === "success") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Record added successfully!'
                    });

                    // Optionally, wait a short period before reloading the table
                    setTimeout(function() {
                        $('#recordTable').load(location.href + ' #recordTable');
                    }, 500);

                    loadRecords(1);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response
                    });
                }
            },
            error: function(xhr, status, error) {
                // If there was a file, hide the preloader modal
                if (hasFile) {
                    $('#preloaderModal').modal('hide');
                }

                Toast.fire({
                    icon: 'error',
                    title: 'Failed to add record. Please try again later.'
                });
            }
        });
    });
});


// edit record
function editRecord(id) {
    $.ajax({
        url: 'backend/record-edit.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            const record = JSON.parse(response);
            $('#edit_id').val(record.id);
            $('#edit_OCT_TCT_no').val(record.OCT_TCT_no);
            $('#edit_lot_no').val(record.lot_no);
            $('#edit_survey_no').val(record.survey_no);
            $('#edit_sheet_no').val(record.sheet_no);
            $('#edit_area').val(record.area);
            $('#edit_date_approved').val(record.date_approved);
            $('#edit_municipality').val(record.municipality);
            $('#edit_brgy').val(record.brgy);
            $('#edit_land_owner').val(record.land_owner);
            $('#edit_geodetic_engr').val(record.geodetic_engr);
            $('#edit_survey_type').val(record.survey_type);
            
            // Display the current map file name from the database
            if (record.map) {
                $('#edit_map_name').text("Current file: " + record.map);
            } else {
                $('#edit_map_name').text("No file uploaded.");
            }
        }
    });
}


$(document).ready(function() {
    $('#editRecordForm').submit(function(e) {
        e.preventDefault();

        var hasFile = $('#editRecordForm')[0].querySelector('input[type="file"]').files.length > 0;
        $('#editRecordModal').modal('hide');

        // If there's a file, show the preloader modal
        if (hasFile) {
            $('#editRecordModal').modal('hide');
            $('#preloaderModal').modal('show');
        }

        // Store FormData
        var formData = new FormData(this);

        $.ajax({
            url: 'backend/record-update.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var jsonResponse = JSON.parse(response);

                setTimeout(function() {
                    if (hasFile) {
                    $('#preloaderModal').modal('hide');
                }
                    
                    if (jsonResponse.message === 'Record updated successfully') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Record updated successfully!'
                        });

                        $('#recordTable').load(location.href + ' #recordTable');
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: jsonResponse.message
                        });
                    }
                },); 
            },
            error: function(xhr, status, error) {
                
                setTimeout(function() {
                    if (hasFile) {
                    $('#preloaderModal').modal('hide');
                }
                    Toast.fire({
                        icon: 'error',
                        title: 'Failed to update record. Please try again later.'
                    });
                }); 
            }
        });
    });
});

// view record
function viewRecord(id) {
    $.ajax({
        url: 'backend/record-view.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            // Populate the modal with the response data
            $('#recordDetails').html(response);
        },
        error: function() {
            alert('Error fetching record details.');
        }
    });
}


// delete record
var recordId;
$(document).on("click", ".delete-record-btn", function() {
    // Assign the ID when the delete button is clicked
    recordId = $(this).data("id"); // Get the record ID from the button's data attribute
    console.log("Record ID:", recordId); // Debug: Check if the correct ID is being logged
    $('#deleteRecordModal').modal('show'); // Show the modal
});


$('#confirmDeleteRecordButton').click(function() {
    if (recordId !== undefined) {
        $.ajax({
            url: "backend/record-delete.php", // Adjust the path as needed
            type: "GET",
            data: { record_id: recordId }, // Send recordId to the server
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    $('#deleteRecordModal').modal('hide');

                    // Show success toast
                    Toast.fire({
                        icon: 'success',
                        title: 'Record deleted successfully!'
                    });

                    // Reload the records after a short delay
                    setTimeout(function() {
                        $('#recordTable').load(location.href + ' #recordTable');
                    }, 500);
                    
                } else {
                    // Show error toast
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);  // Handle errors

                // Show error toast
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to delete record. Please try again later.'
                });
            }
        });
    } else {
        console.error("Record ID is not defined."); 

        // Show error toast
        Toast.fire({
            icon: 'error',
            title: 'Record ID is not defined.'
        });
    }
});

</script>
