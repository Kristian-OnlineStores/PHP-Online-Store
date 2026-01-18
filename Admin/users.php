<?php 
include('../Admin/includes/header.php');
//require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    User Lists
                    <a href="users-create.php" class="btn btn-primary float-end">Add Users</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

                <div class="table-responsive"> <!-- Премахнете затварящия div тук -->
                    <table class="table table-bordered table-striped user-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Is Ban</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $users = getAll('users');
                            if($users && mysqli_num_rows($users) > 0){
                                while($item = mysqli_fetch_assoc($users)){
                                    ?>
                                    
                                    <tr class="Information">
                                        <td data-label="Id"><?= $item['id']; ?></td>
                                        <td data-label="First Name"><?= $item['FirstName']; ?></td>
                                        <td data-label="Last Name"><?= $item['LastName']; ?></td>
                                        <td data-label="Email"><?= $item['Email']; ?></td>
                                        <td data-label="Role"><?= $item['Role']; ?></td>
                                        <td data-label="Status"><?= $item['IsBan'] == 1 ? 'Banned' : 'Active'; ?></td>
                                        <td data-label="Action">
                                            <a href="users-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="users-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
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
                                    <td colspan='7'>No Records Found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- Добавете затварящ div тук -->
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
//require_once __DIR__ . '/../includes/footer.php';

?>