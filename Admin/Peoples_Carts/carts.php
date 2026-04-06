<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
 ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Carts Lists
                    <a href="carts-create.php" class="btn btn-primary float-end">Add Cart</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

<div class="table-responsive">
    <table id="myTable" class="table table-bordered table-striped user-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cars = getAll('cart');
            if(mysqli_num_rows($cars) > 0){
                foreach($cars as $item){
                    ?>
                    
                    <tr class="Information">
    <td data-label="Id"><?= $item['id']; ?></td>
    <td data-label="User"><?= getUser($item['user_id']); ?></td>
    <td data-label="Product"><?= getProduct($item['goods_id']); ?></td>
    <td data-label="Quantity"><?= $item['quantity']; ?></td>
          
    <td data-label="Action">
        <a href="carts-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
        <a href="carts-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
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
