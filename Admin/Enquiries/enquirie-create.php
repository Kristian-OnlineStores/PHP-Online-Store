<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Enquiry
                    <a href="enquirie.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="../code.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label> Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Service</label>
                                <select name="service" class="form-select">
                                    <option value="">Select Service</option>
                                    <?php
                                    $services = getAll('services');
                                    if (mysqli_num_rows($services) > 0) {
                                        foreach ($services as $service) {
                                            echo '<option value="' . $service['id'] . '">'
                                                . $service['id'] . ' ' . $service['name'] .
                                                '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Message</label>
                                <textarea type="text" name="message" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6"></div>
                            <div class="mb-3 text-end">
                                <br>
                                <button type="submit" name="saveEnquiry" class="btn btn-primary">Save Enquiry</button>
                            </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../config/function.js"></script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>