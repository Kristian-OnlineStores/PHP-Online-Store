<?php
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4> Enquiries
                        <a href="enquirie-create.php" class="btn btn-primary float-end">Add Enquiry</a>
                    </h4>

                    
<!--                <form action="" method="GET" class="float-end">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="date" name="date" value="<?= isset($_GET['date']) ==true? $_GET['date']:'' ?>" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary ">Filter</button>
                                    <a href="enquirie.php" class="btn btn-danger">Clear</a>
                                </div>
                            </div>
                        </form>
--> 
                </div>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped user-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            /*if (isset($_GET['date']) && $_GET['date'] != '') {
                                
                                $date = validate($_GET['date']);
                                $enquiries = mysqli_query($con, "SELECT * FROM enquiries WHERE created_at = '$date' ORDER BY id DESC");

                            } else {
                               $enquiries = getAll('enquiries');
                            }*/
                               
                               $enquiries = getAll('enquiries');
                            if (mysqli_num_rows($enquiries) > 0) {
                                foreach ($enquiries as $item) {
                            ?>

                                    <tr class="Information">
                                        <td data-label="Id"><?= $item['id']; ?></td>
                                        <td data-label="Name"><?= $item['name']; ?></td>
                                        <td data-label="Email"><?= $item['email']; ?></td>
                                        <td data-label="Service"><?= getService($item['service']); ?></td>
                                        <td data-label="Message">
                                            <textarea name="message" rows="4" class="form-control" disabled style="margin: -3px; margin-right: -4px; padding: 5px;"><?= $item['message']; ?></textarea>
                                        </td>
                                        <td data-label="Action">
                                            <a href="enquirie-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="enquirie-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
                                                onclick="return confirm('Are you sure you want to delete this data?');">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>


                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan='7'>No Records Found</td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//include('includes/footer.php');
require_once __DIR__ . '/../includes/footer.php';

?>