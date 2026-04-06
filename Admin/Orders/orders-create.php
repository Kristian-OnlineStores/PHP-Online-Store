    <?php //include('includes/header.php'); 
    require_once __DIR__ . '/../includes/header.php';
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Order
                        <a href="orders.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="../code.php" method="POST">
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
                                                echo '<option value="' . $user['id'] . '">' . $user['id'].' - '.$user['FirstName'].' '.$user['LastName']. '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                   

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total</label>
                                    <input type="decimal" name="total" class="form-control" required>
                                </div>
                            </div>

                            <!--<div class="col-md-6">
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <input type="text" name="payment_method" class="form-control" required>
                                </div>
                            </div>-->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <select name="paymentMethod" id="paymentMethod" required class="form-select">
                                        <option value="">Select Payment Method</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Holder Name</label>
                                    <input type="text" name="cardName" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" name="cardNumber" id="cardNumber" class="form-control" placeholder="1234 5678 9012 3456" pattern="[0-9\s]{16,19}" maxlength="19"
                                        oninput="this.value = this.value.replace(/[^0-9\s]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').trim()" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardExpiry">Card Expiry</label>
                                    <input type="text" name="cardExpiry" id="cardExpiry" class="form-control" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" maxlength="5"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\d{2})(?=\d)/g, '$1/').trim()" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cardCvv">Card Cvv</label>
                                    <input type="text" name="cardCvv" id="cardCvv" class="form-control" placeholder="123" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3)" required>
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Order Status</label>
                                    <select name="orderStatus" required class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Is Payed</label>
                                    <br>
                                    <input type="hidden" name="paid" value="0">
                                    <input type="checkbox" name="paid" value="1" style="width:30px; height: 30px" />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="b-3 text-end">
                                    <br>
                                    <button type="submit" name="saveOrder" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php //include('includes/footer.php'); 
    require_once __DIR__ . '/../includes/footer.php';
    ?>