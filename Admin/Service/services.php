<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Services 
                    <a href="services-create.php" class="btn btn-primary float-end">Add Service</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

                <div class="table-responsive"> 
                    <table class="table table-bordered table-striped user-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <a href="services-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="services-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
                               onclick="return confirm('Are you sure you want to delete this item?');">
                               Delete
                            </a>
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