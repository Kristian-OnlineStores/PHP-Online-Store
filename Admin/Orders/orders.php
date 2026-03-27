<?php 
//include('../includes/header.php');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Orders Lists
                    <a href="orders-create.php" class="btn btn-primary float-end">Add Order</a>
                </h4>
            </div>
           <div class="card-body">

           <?= alertMessage(); ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped user-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Card Name</th>
                <th>Card Number</th>
                <th>Card Expiry</th>
                <th>Card CVV</th>
                <th>Payed</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $orders = getAll('orders');
            if(mysqli_num_rows($orders) > 0){
                foreach($orders as $item){
                    ?>
                    
                    <tr class="Information">
    <td data-label="Id"><?= $item['id']; ?></td>
    <td data-label="User"><?= $item['user_id']; ?></td>
    <td data-label="Total"><?= $item['total']; ?></td>
    <td data-label="Payment Method"><?= $item['paymentMethod']; ?></td>
    <td data-label="Card Name"><?= $item['cardName']; ?></td>
    <td data-label="Card Number"><?= $item['cardNumber']; ?></td>
    <td data-label="Card Expiry"><?= $item['cardExpiry']; ?></td>
    <td data-label="Card CVV"><?= $item['cardCvv']; ?></td>
    <td data-label="Payed"><?= $item['paid'] == 0 ? 'Pending' : 'Paid'; ?></td>
 <td data-label="Status">
    <?php 
    switch($item['orderStatus']) {
        case 'Pending':
            echo '<span class="badge bg-warning">Pending</span>';
            break;
        case 'Processing':
            echo '<span class="badge bg-info">Processing</span>';
            break;
        case 'Completed':
            echo '<span class="badge bg-success">Completed</span>';
            break;
        case 'Cancelled':
            echo '<span class="badge bg-danger">Cancelled</span>';
            break;
        default:
            echo '<span class="badge bg-secondary">Unknown</span>';
    }
    ?>
</td>  

    <td data-label="Action">
        <a href="orders-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
        <a href="orders-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm mx-2"
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
