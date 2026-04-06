<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Product Lists
                    <a href="goods-create.php" class="btn btn-primary float-end">Add Products</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

<div class="table-responsive">
    <table id="myTable" class="table table-bordered table-striped user-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Original Price</th>
                <th>Sale Status</th>
                <th>Discount</th>
                <th>Final Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cars = getAll('goods');
            if(mysqli_num_rows($cars) > 0){
                foreach($cars as $item){
                     $final_price = $item['price'];
                                    if($item['saleStatus'] == 1 && $item['discountPercent'] > 0) {
                                        $final_price = $item['price'] - ($item['price'] * $item['discountPercent'] / 100);
                                    }
                    ?>
                    
                    <tr class="Information">
    <td data-label="Id"><?= $item['id']; ?></td>
    <td data-label="Brand"><?= $item['brand']; ?></td>
    <td data-label="Model"><?= $item['model']; ?></td>
    <td data-label="Year"><?= $item['year']; ?></td>
    <td data-label="Original Price">€<?= number_format($item['price'], 2); ?></td>
    <td data-label="Status">
                                            <?php if($item['saleStatus'] == 1): ?>
                                                <span class="badge bg-success">On Sale</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Not on Sale</span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Discount">
                                            <?= $item['saleStatus'] == 1 ? $item['discountPercent'] . '%' : '0%'; ?>
                                        </td>
                                        <td data-label="Final Price">
                                            <?php if($item['saleStatus'] == 1 && $item['discountPercent'] > 0): ?>
                                                <strong class="text-success">€<?= number_format($final_price, 2); ?></strong>
                                                <br>
                                                <small class="text-muted"><del>€<?= number_format($item['price'], 2); ?></del></small>
                                            <?php else: ?>
                                                €<?= number_format($item['price'], 2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Action">
                                            <a href="goods-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="goods-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
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
