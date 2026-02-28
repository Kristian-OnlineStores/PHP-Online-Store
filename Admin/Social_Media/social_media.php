<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Social Media Lists
                    <a href="social_media-create.php" class="btn btn-primary float-end">Add Social Media</a>
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
                                <th>URL</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                        <?php 
                            $socialMedia = getAll('social_media');
                            if($socialMedia && mysqli_num_rows($socialMedia) > 0){
                                while($item = mysqli_fetch_assoc($socialMedia)){
                                    ?>
                                    
                                    <tr class="Information">
                                        <td data-label="Id"><?= $item['id']; ?></td>
                                        <td data-label="Name"><?= $item['Name']; ?></td>
                                        <td data-label="URL"><?= $item['Url']; ?></td>
                                        <td data-label="Status"><?= $item['Media_Status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                        <td data-label="Action">
                                            <a href="social_media-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="social_media-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
                                               onclick="return confirm('Are you sure you want to delete this data?');">
                                               Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan='5'>No Records Found</td>
                                </tr>
                                <?php
                            }
                            ?>
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