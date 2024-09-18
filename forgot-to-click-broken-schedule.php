<?php
$HRconnect = mysqli_connect("localhost", "root", "", "hrms");

// Retrieve the empno, concernDate, name, position, and Concern from the URL parameters
$empno = isset($_GET['empno']) ? $_GET['empno'] : null;
$concernDate = isset($_GET['concernDate']) ? $_GET['concernDate'] : null;
$name = isset($_GET['name']) ? $_GET['name'] : null;
$position = isset($_GET['position']) ? $_GET['position'] : null;
$selectedConcern = isset($_GET['Concern']) ? $_GET['Concern'] : null;
$type_concern = isset($_GET['type_concern']) ? $_GET['type_concern'] : null;
$type_errors = isset($_GET['type_errors']) ? $_GET['type_errors'] : null;
$btnDisabled = false; // Default value

if ($empno && $concernDate) {
     // Prepare and execute the query using type_concern
     $sql = "SELECT COUNT(*) AS submission_count FROM hear_you_out WHERE empno = ? AND date_submitted = ? AND type_concern = ? AND status = 'Active'";
    $stmt = $HRconnect->prepare($sql);
    $stmt->bind_param("is", $empno, $concernDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the user has already submitted the form
    $formSubmitted = $row['submission_count'] > 0;

    // Construct the URL based on whether the form was submitted or not
    if ($formSubmitted) {
        $hearYouOutUrl = "hear-you-out-view-only.php?empno=$empno&type_concern=" . urlencode($type_concern) . "&ConcernDate=" . urlencode($concernDate);
        $linkText = "You already submitted HYO form, click to review";
        $linkAction = "window.open('$hearYouOutUrl', '_blank'); return false;";
    } else {
        $hearYouOutUrl = "hear-you-out.php?empno=$empno&name=" . urlencode($name) . "&position=" . urlencode($position) . "&ConcernDate=" . urlencode($concernDate) . "&type_concern=" . urlencode($type_concern) . "&Concern=" . urlencode($selectedConcern) . "&type_errors=" . urlencode($type_errors);
        $linkText = "Click here to create and submit your HYO form";
        $linkAction = "window.location.href='$hearYouOutUrl'; return false;";
        $btnDisabled = true; // Disable the button if the form has not been submitted
    }
}
?>

<div class="card border-0 shadow-sm mt-3">
    <div class="card-body p-0 ml-4 mr-4">
        <h5 class="mt-4" style="margin-bottom: 0;">
            <strong><?php echo htmlspecialchars($selectedConcern ?? 'Forgot to click broken schedule'); ?></strong>
        </h5>
        <p style="margin-top: 0;">The staff forgot to check Broken Schedule for Gen Meet/Gen Cleaning. It is only applicable if you already completed 4 time inputs for that shift.</p>
        <hr>
        <div class="form-group">
            <!-- Attachments Section -->
            <div class="attachments-container">
                <p style="font-weight:bold; margin-bottom: 0;">Attachments <span style="color:red;">*</span></p>
                <div class="input-group mt-3 d-flex justify-content-center">
                    <a href="#" onclick="<?php echo $linkAction; ?>"
                        style="color: <?php echo (isset($formSubmitted) && $formSubmitted) ? '#6c757d' : '#007bff'; ?>; text-decoration: underline; font-size: 20px;">
                        <?php echo $linkText; ?>
                    </a>
                </div>
            </div>
            <hr>
            <!-- Table-like structure for time inputs -->
            <div class="time-inputs-container">
                <p style="font-weight:bold; margin-bottom: 0;">Captured Time Inputs</p>
                <!-- Header Row -->
                <div class="time-inputs-header">
                    <div class="header-item">BROKEN SCHEDULE IN</div>
                    <div class="header-item">BROKEN SCHEDULE OUT</div>
                </div>
                <!-- Input Row -->
                <div class="time-inputs captured-inputs d-flex justify-content-center align-items-center">
                    <input type="text" id="capturedBrokenSchedIn" name="capturedBrokenSchedIn" class="form-control text-center" disabled>
                    <input type="text" id="capturedBrokenSchedOut" name="capturedBrokenSchedOut" class="form-control text-center" disabled>
                </div>
            </div>
            <!-- Table-like structure for proposed inputs -->
            <div class="time-inputs-container">
                <!-- Container for checkbox with proper spacing -->
                <div class="checkbox-section" style="display: flex; justify-content: space-between; align-items: center;">
                    <p style="font-weight:bold; margin-bottom: 0;">Proposed Time Inputs <span style="color:red;">*</span></p>
                </div>
                <!-- Header Row -->
                <div class="time-inputs-header">
                    <div class="header-item">BROKEN SCHEDULE IN</div>
                    <div class="header-item">BROKEN SCHEDULE OUT</div>
                </div>
                <!-- Input Row -->
                <div class="time-inputs proposed-inputs">
                    <input type="text" id="proposedBrokenSchedIn" class="form-control" placeholder="00:00">
                    <input type="text" id="proposedBrokenSchedOut" class="form-control" placeholder="00:00">
                </div>
            </div>

            <hr>
            <!-- Agreement Section -->
            <div class="agreement-container mt-2">
                <p style="font-weight: bold; margin-bottom: 10px;">Agreement <span style="color: red;">*</span></p>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agreementCheckbox" required>
                    <label class="form-check-label" for="agreementCheckbox">
                        I hereby certify that the above information provided is correct. Any falsification of
                        information in this regard may form grounds for disciplinary action up to and
                        including dismissal.
                    </label>
                </div>
            </div>
            <!-- Proceed Button -->
            <div class="text-right mt-3">
                <button
                    type="button"
                    id="btnSubmit"
                    class="btn btn-primary"
                    style="font-weight: bold; margin-top: 20px; <?php echo $btnDisabled ? 'cursor: not-allowed;' : ''; ?>"
                    <?php echo $btnDisabled ? 'disabled' : ''; ?>>
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>