<?php
$btnDisabled = false; // Default value
?>
<div class="card border-0 shadow-sm mt-3">
    <div class="card-body p-0 ml-4 mr-4">
        <h5 class="mt-4" style="margin-bottom: 0;">
            <strong><?php echo htmlspecialchars($selectedConcern ?? 'Misaligned time inputs'); ?></strong>
        </h5>
        <p style="margin-top: 0;">The staff's time inputs in the digital persona are not aligned accurately. </p>
        <hr>
        <div>
            <div>
                <!-- Table-like structure for time inputs -->
                <div class="time-inputs-container">
                    <p style="font-weight:bold; margin-bottom: 0;">Captured Time Inputs</p>
                    <!-- Header Row -->
                    <div class="time-inputs-header">
                        <div class="header-item">TIME IN</div>
                        <div class="header-item">BREAK OUT</div>
                        <div class="header-item">BREAK IN</div>
                        <div class="header-item">TIME OUT</div>
                    </div>
                    <!-- Input Row -->
                    <div class="time-inputs captured-inputs d-flex justify-content-center align-items-center">
                        <input type="text" id="capturedTimeIn" class="form-control text-center" disabled>
                        <input type="text" id="capturedBreakOut" class="form-control text-center mx-2" disabled>
                        <input type="text" id="capturedBreakIn" class="form-control text-center mx-2" disabled>
                        <input type="text" id="capturedTimeOut" class="form-control text-center" disabled>
                    </div>
                </div>
                <!-- Table-like structure for proposed inputs -->
                <div class="time-inputs-container">
                    <!-- Container for checkbox with proper spacing -->
                    <div class="checkbox-section" style="display: flex; justify-content: space-between; align-items: center;">
                        <p style="font-weight:bold; margin-bottom: 0;">Proposed Time Inputs <span style="color:red;">*</span></p>
                        <!-- Checkbox with text "With 1 hour break" -->
                        <div class="checkbox-container">
                            <label style="font-weight:bold;">
                                <input type="checkbox" id="oneHourBreakCheckbox">
                                Check If No Break
                            </label>
                        </div>
                    </div>
                    <!-- Header Row -->
                    <div class="time-inputs-header">
                        <div class="header-item">TIME IN</div>
                        <div class="header-item">BREAK OUT</div>
                        <div class="header-item">BREAK IN</div>
                        <div class="header-item">TIME OUT</div>
                    </div>
                    <!-- Input Row -->
                    <div class="time-inputs proposed-inputs">
                        <input type="text" id="proposedTimeIn" class="form-control" placeholder="00:00">
                        <input type="text" id="proposedBreakOut" class="form-control" placeholder="00:00">
                        <input type="text" id="proposedBreakIn" class="form-control" placeholder="00:00">
                        <input type="text" id="proposedTimeOut" class="form-control" placeholder="00:00">
                    </div>
                </div>
                <!-- Attachments image select Section -->
                <div class="attachments-container">
                    <p style="font-weight:bold; margin-bottom: 0;">Attachments <span style="color:red;">*</span></p>
                    <div class="input-group mt-3 d-flex justify-content-center">
                        <!-- File input field -->
                        <input type="file" name="attachment1" id="attachment1" class="form-control" style="height: 45px;" accept=".jpg,.jpeg,.png" />
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
                <div class="text-right mt-3 mb-3">
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
</div>