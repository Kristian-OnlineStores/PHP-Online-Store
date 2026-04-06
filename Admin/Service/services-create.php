<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Service
                    <a href="services.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="../code.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status </label>
                                <br/>
                                <input type="checkbox" name="status" value="1" style="width:30px; height:30px;">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                                <div class="mb-3 text-end">
                                    <br>
                                    <button type="submit" name="saveService" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?php
require_once __DIR__ . '/../includes/footer.php';
?>