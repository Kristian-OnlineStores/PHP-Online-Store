<?php
//include('../includes/header.php');
require_once __DIR__ . '/../config/function.php';

require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Social Media
                    <a href="social_media.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="../code.php" method="POST">
                    <?php
                    $ParamResult = checkParamId('id');
                    if (!is_numeric($ParamResult)) {
                        echo '<h5>' . $ParamResult . '</h5>';
                        return false;
                    }

                    $socialMedia = getById('social_media', checkParamId('id'));
                    if ($socialMedia['status'] == 200) {
                    ?>

                        <input type="hidden" name="socialMediaId" value="<?= $socialMedia['data']['id']; ?>" required>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Social Media Name</label>
                                    <input type="text" name="name" value="<?= $socialMedia['data']['Name'] ?>" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Social Media URL</label>
                                    <input type="text" name="url" value="<?= $socialMedia['data']['Url'] ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <br />
                                    <input type="checkbox" <?= $socialMedia['data']['Media_Status'] == true ? 'checked' : '' ;?> name="Media_Status" style="width: 30px; height: 30px;" />
                                </div>
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" name="updateSocialMedia" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    <?php


                    } else {
                        echo '<h5>' . $user['message'] . '</h5>';
                    }

                    ?>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
//include('includes/footer.php');
require_once __DIR__ . '/../includes/footer.php';

?>