<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Social Media
                    <a href="social_media.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

           <form action="../code.php" method="POST">
             <div class="row">
             <div class="col-md-6">
            <div class="mb-3">
                <label>Social Media Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
        </div>

         <div class="col-md-6">
            <div class="mb-3">
                <label>Social Media URL</label>
                <input type="text" name="url" class="form-control" required>
            </div>
        </div>

            <div class="col-md-3">
            <div class="mb-3">
                <label>Status</label>
                <br/>
                <input type="hidden" name="status" value="1">
                <input type="checkbox" name="status" value="0" style="width: 30px; height: 30px;"  
                onclick=""/>
            </div>
            </div>
            
            <div class="mb-3 text-end">
               <button type="submit" name="saveSocialMedia" class="btn btn-primary">Save</button>
            </div>
            </div>
           </form>
            </div>
        </div>
    </div>
</div>

<?php 
//include('includes/footer.php');
require_once __DIR__ . '/../includes/footer.php';

?>