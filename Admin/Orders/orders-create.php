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
                                    <label>User ID</label>
                                    <input type="number" name="user_id" class="form-control" required>
                                </div>
                            </div>
       
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total</label>
                                    <input type="number" name="total" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <input type="text" name="payment_method" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Name</label>
                                    <input type="text" name="card_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Number</label>
                                    <input type="number" name="card_number" class="form-control" required>
                                </div>
                            </div>
 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Expiry</label>
                                    <input type="number" name="card_expiry" class="form-control" required>
                                </div>
                            </div>
                   
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Cvv</label>
                                    <input type="number" name="card_cvv" class="form-control" required>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Cvv</label>
                                    <input type="number" name="card_cvv" class="form-control" required>
                                </div>
                            </div>
                            
                                         <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Is Payed</label>
                                    <br>
                                    <input type="hidden" name="is_payed" value="0">
                                    <input type="checkbox" name="is_payed" value="1" style="width:30px; height: 30px" 
                                    onclick=""/>
                                </div>
                            </div>

                                    <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Is Delivered</label>
                                    <br>
                                    <input type="hidden" name="is_delivered" value="0">
                                    <input type="checkbox" name="is_delivered" value="1" style="width:30px; height: 30px" 
                                    onclick=""/>
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