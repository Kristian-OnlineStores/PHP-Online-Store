    <?php include('includes/header.php'); 
    
    ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add User
                    <a href="users.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                    <?= alertMessage(); ?>

                <form action="code.php" method="POST">
                    
                    <?php
                $ParamResult = checkParamId('id');
                if(!is_numeric($ParamResult)){
                    echo '<h5>'.$ParamResult.'</h5>';
                    return false;
                }

                $user = getById('users', checkParamId('id'));
                if($user['status'] == 200) {
                    ?>

                    <input type="hidden" name="userId" value="<?= $user['data']['id'] ;?>" required>

                     <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" value="<?= $user['data']['FirstName'] ;?>" name="firstname" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" value="<?= $user['data']['LastName'] ;?>" name="lastname" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" value="<?= $user['data']['Email'] ;?>" name="email"  required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Leave empty to keep current password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Select Role</label>
                                <select name="role" required class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="admin" <?= $user['data']['Role'] == 'admin' ? 'selected' : '' ;?>>Admin</option>
                                    <option value="user" <?= $user['data']['Role'] == 'user' ? 'selected' : '' ;?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Is Ban</label>
                                <br>
                                <input type="checkbox" <?= $user['data']['IsBan'] == true ? 'checked' : '' ;?> name="is_ban" style="width:30px; height: 30px" />
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="b-3 text-end">
                                <br>
                                <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </div>

                    <?php
                    

                }else{
                    echo '<h5>'.$user['message'].'</h5>';
                }

                ?>
                
                    



                </form>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); 

?>