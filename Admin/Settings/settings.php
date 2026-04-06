<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Settings
                    
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

           <form action="../code.php" method="POST">

           <?php $settingID = getById('settings', 1) ?>
           <input type="hidden" name="settingID" value="<?=  $settingID['data']['id'] ?? 'insert'; ?>" />
              
           <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="<?=  $settingID['data']['title'] ?? ' '; ?>" class="form-control" >
            </div>

            <div class="mb-3">
                <label>URL/Domain</label>
                <input type="text" name="url" value="<?=  $settingID['data']['url'] ?? ' '; ?>" class="form-control" >
            </div>

            <div class="mb-3">
                <label>Small Description</label>
                <input type="text" name="small_description" value="<?=  $settingID['data']['small_description'] ?? ' '; ?>" class="form-control" >
            </div>

            <h4 class="my-3">SEO Settings</h4>
            <div class="mb-3">
                <label>Meta Description</label>
                <textarea name="meta_description"  class="form-control" rows="3" ><?=  $settingID['data']['meta_description'] ?? ' '; ?></textarea>
            </div>

            <div class="mb-3">
                <label>Meta Keyword</label>
                <textarea name="meta_keyword"  class="form-control" rows="3" ><?=  $settingID['data']['meta_keyword'] ?? ' '; ?></textarea>
            </div>

             <h4 class="my-3">Contact Information</h4>
             <div class="row">
             <div class=" col-md-6 mb-3">
                <label>Email 1</label>
                <input type="email" name="email" value="<?=  $settingID['data']['email'] ?? ' '; ?>" class="form-control" >
            </div>

            <div class=" col-md-6 mb-3">
                <label>Email 2</label>
                <input type="email" name="email2" value="<?=  $settingID['data']['email2'] ?? ' '; ?>" class="form-control">
            </div>

            <div class=" col-md-6 mb-3">
                <label>Phone 1</label>
                <input type="tel" name="phone" value="<?=  $settingID['data']['phone'] ?? 'insert'; ?>" class="form-control" >
            </div>

            <div class=" col-md-6 mb-3">
                <label>Phone 2</label>
                <input type="tel" name="phone2" value="<?=  $settingID['data']['phone2'] ?? ' '; ?>" class="form-control">
            </div>

            <div class=" col-md-12 mb-3">
                <label>Address</label>
                <textarea type="text" name="address" class="form-control" rows="3"><?=  $settingID['data']['address'] ?? ' '; ?></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" name="saveSetting" class="btn btn-primary float-end">Save Setting</button>
            </div>
           </div>
            </form>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php 
//include('includes/footer.php');
require_once __DIR__ . '/../includes/footer.php';

?>