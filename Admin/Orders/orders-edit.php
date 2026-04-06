<?php 
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Order
                    <a href="orders.php" class="btn btn-danger float-end">Back</a>
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

                    $order = getById('orders', checkParamId('id'));
                    if ($order['status'] == 200) {
                    ?>

                        <input type="hidden" name="orderId" value="<?= $order['data']['id']; ?>" required>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>User</label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        <?php
                                        $users = getAll('users');
                                        if (mysqli_num_rows($users) > 0) {
                                            foreach ($users as $user) {
                                                $selected = ($user['id'] == $order['data']['user_id']) ? 'selected' : '';
                                                echo '<option value="' . $user['id'] . '" ' . $selected . '>' . $user['id'].' - '.$user['FirstName'].' '.$user['LastName']. '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total</label>
                                    <input type="number" step="0.01" value="<?= $order['data']['total']; ?>" name="total" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <select name="paymentMethod" id="paymentMethod" required class="form-select">
                                        <option value="">Select Payment Method</option>
                                        <option value="Credit Card" <?= $order['data']['paymentMethod'] == 'Credit Card' ? 'selected' : ''; ?>>Credit Card</option>
                                        <option value="Debit Card" <?= $order['data']['paymentMethod'] == 'Debit Card' ? 'selected' : ''; ?>>Debit Card</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Holder Name</label>
                                    <input type="text" value="<?= $order['data']['cardName']; ?>" name="cardName" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" value="<?= $order['data']['cardNumber']; ?>" name="cardNumber" id="cardNumber" class="form-control" placeholder="1234 5678 9012 3456" pattern="[0-9\s]{16,19}" maxlength="19"
                                        oninput="this.value = this.value.replace(/[^0-9\s]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').trim()" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardExpiry">Card Expiry</label>
                                    <input type="text" value="<?= $order['data']['cardExpiry']; ?>" name="cardExpiry" id="cardExpiry" class="form-control" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" maxlength="5"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\d{2})(?=\d)/g, '$1/').trim()" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardCvv">Card Cvv</label>
                                    <input type="text" value="<?= $order['data']['cardCvv']; ?>" name="cardCvv" id="cardCvv" class="form-control" placeholder="123" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3)" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Order Status</label>
                                    <select name="orderStatus" required class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="Pending" <?= $order['data']['orderStatus'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Processing" <?= $order['data']['orderStatus'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="Completed" <?= $order['data']['orderStatus'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="Cancelled" <?= $order['data']['orderStatus'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Is Paid</label>
                                    <br>
                                    
                                    <input type="checkbox" name="paid"  <?= $order['data']['paid'] == true ? 'checked' : ''; ?> style="width:30px; height: 30px" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 text-end">
                                    <br>
                                    <button type="submit" name="updateOrder" class="btn btn-primary">Update Order</button>
                                </div>
                            </div>

                        </div>

                    <?php
                    } else {
                        echo '<h5>' . $order['message'] . '</h5>';
                    }
                    ?>

                </form>

            </div>
        </div>
    </div>
</div>

<?php 
require_once __DIR__ . '/../includes/footer.php';
?>