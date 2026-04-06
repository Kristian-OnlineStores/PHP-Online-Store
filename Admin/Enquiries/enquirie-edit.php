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
                    Edit Enquirie
                    <a href="enquirie.php" class="btn btn-danger float-end">Back</a>
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

                    $enquirie = getById('enquiries', checkParamId('id'));
                    if ($enquirie['status'] == 200) {
                    ?>

                        <input type="hidden" name="enquiryId" value="<?= $enquirie['data']['id']; ?>" required>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?= $enquirie['data']['name'] ?>" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?= $enquirie['data']['email'] ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Service</label>
                                    <select name="service" class="form-select">
                                        <option value=" ">Select Service</option>
                                        <?php
                                        $services = getAll('services');
                                        if (mysqli_num_rows($services) > 0) {
                                            foreach ($services as $service) {
                                                $selected = ($service['id'] == $enquirie['data']['service']) ? 'selected' : '';
                                                echo '<option value="' . $service['id'] . '"  ' . $selected . '>'
                                                    . $service['id'] . ' - ' . $service['name'] .
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
                                    <textarea  name="message" rows="3"   required class="form-control"><?=  $enquirie['data']['message']  ?></textarea>
                                </div>
                            </div>

                            <div class="mb-3 text-end">
                                <button type="submit" name="updateEnquiry" class="btn btn-primary">Update</button>
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