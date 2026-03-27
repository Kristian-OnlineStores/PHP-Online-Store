<?php 
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Ordered Items
                    <a href="orderedItems-create.php" class="btn btn-primary float-end">Add Ordered Item</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Goods ID</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $orderedItems = getAll('orderedItems');
            if(mysqli_num_rows($orderedItems) > 0){
                foreach($orderedItems as $item){
                                  
                    ?>
                    
                    <tr class="Information">
                        <td data-label="ID"><?= $item['id']; ?></td>
                        <td data-label="Order ID"><?= $item['order_id']; ?></td>
                        <td data-label="Goods ID"><?= $item['goods_id']; ?></td>
                        <td data-label="Quantity"><?= $item['quantity']; ?></td>
                        <td data-label="Price">€<?= number_format($item['price'], 2); ?></td>
                        <td data-label="Action">
                            <a href="orderedItems-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="orderedItems-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
                               onclick="return confirm('Are you sure you want to delete this item?');">
                               Delete
                            </a>
                        </td>
                    </tr>

                    <?php
                }
            }else{
                ?>
                <tr>
                    <td colspan='8'>No Records Found</td>
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