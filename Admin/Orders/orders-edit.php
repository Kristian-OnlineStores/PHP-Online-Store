    <?php //include('includes/header.php'); 
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
                if(!is_numeric($ParamResult)){
                    echo '<h5>'.$ParamResult.'</h5>';
                    return false;
                }

                $orders = getById('orders', checkParamId('id'));
                if($orders['status'] == 200) {
                    ?>

                    <input type="hidden" name="ordersId" value="<?= $orders['data']['id'] ;?>" required>
                     <div class="row">
                       
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>User ID</label>
                                    <input type="number" value="<?= $orders['data']['user_id'] ;?>" name="user_id" class="form-control" required>
                                </div>
                            </div>
                        

                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total</label>
                                    <input type="number" value="<?= $orders['data']['total'] ;?>" name="total" class="form-control" required>
                                </div>
                            </div>
                        

                         
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Payment Method</label>
                                    <input type="text" value="<?= $orders['data']['payment_method'] ;?>" name="payment_method" class="form-control" required>
                                </div>
                            </div>
                        

                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Name</label>
                                    <input type="text" value="<?= $orders['data']['card_name'] ;?>" name="card_name" class="form-control" required>
                                </div>
                            </div>
                        

                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Number</label>
                                    <input type="number" value="<?= $orders['data']['card_number'] ;?>" name="card_number" class="form-control" required>
                                </div>
                            </div>
                        

                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Expiry</label>
                                    <input type="number" value="<?= $orders['data']['card_expiry'] ;?>" name="card_expiry" class="form-control" required>
                                </div>
                            </div>
                        

                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Card Cvv</label>
                                    <input type="number" value="<?= $orders['data']['card_cvv'] ;?>" name="card_cvv" class="form-control" required>
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

                        <div class="col-md-6">

                            <div class="b-3 text-end">
                                <br>
                                <button type="submit" name="updateOrders" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </div>

                    <?php
                    

                }else{
                    echo '<h5>'.$user['message'].'</h5>';
                }

                ?>
                
                    



                </form>

            </div>
        </div>
    </div>
</div>

<?php //include('includes/footer.php'); 
require_once __DIR__ . '/../includes/footer.php';
?>