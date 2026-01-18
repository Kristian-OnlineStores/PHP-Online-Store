<?php include('../includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Product Lists
                    <a href="products-create.php" class="btn btn-primary float-end">Add Products</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

<div class="table-responsive"></div>
    <table class="table table-bordered table-striped user-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cars = getAll('cars');
            if(mysqli_num_rows($cars) > 0){
                foreach($cars as $item){
                    ?>
                    
                    <tr class="Information">
    <td data-label="Id"><?= $item['id']; ?></td>
    <td data-label="Brand"><?= $item['brand']; ?></td>
    <td data-label="Model"><?= $item['model']; ?></td>
    <td data-label="Year"><?= $item['year']; ?></td>
    <td data-label="Price"><?= $item['price']; ?></td>
    <td data-label="Action">
        <a href="products-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
        <a href="products-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
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

<?php include('../includes/footer.php'); ?>
