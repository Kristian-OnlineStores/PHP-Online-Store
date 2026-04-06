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
                    <table id="myTable" class="table table-bordered table-striped user-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
            $services = getAll('services');
            if(mysqli_num_rows($services) > 0){
                foreach($services as $item){
                    ?>
                    
                    <tr class="Information">
    <td data-label="Id"><?= $item['id']; ?></td>
    <td data-label="Name"><?= $item['name']; ?></td>
    <td data-label="Description"><?= $item['description']; ?></td>
    <td data-label="Status">
                                            <?php if($item['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Action">
                                            <a href="services-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="services-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
                                               onclick="return confirm('Are you sure you want to delete this data?');">
                                               Delete
                                            </a>
                                        </td>
                                    </tr>


                    <?php
                }
            }else{
                ?>
                <tr >
                    <td colspan = '7'>No Records Found</td>
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