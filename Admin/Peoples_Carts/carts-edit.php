    <?php //include('includes/header.php'); 
    require_once __DIR__ . '/../config/function.php';
    
    require_once __DIR__ . '/../includes/header.php';
    ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Cart
                    <a href="carts.php" class="btn btn-danger float-end">Back</a>
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

                $carts = getById('cart', checkParamId('id'));
                if($carts['status'] == 200) {
                    ?>

                    <input type="hidden" name="cartId" value="<?= $carts['data']['id'] ;?>" required>
                             <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>User ID</label>
                    <input type="number" value="<?= $carts['data']['user_id'] ;?>" name="user_id" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Goods ID</label>
                    <input type="number" value="<?= $carts['data']['goods_id'] ;?>" name="goods_id" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?= $carts['data']['quantity'] ;?>" min="1" required>
                </div>
            </div>
        
                        
                        <div class="col-md-6">

                            <div class="b-3 text-end">
                                <br>
                                <button type="submit" name="updateCart" class="btn btn-primary">Update</button>
                            </div>
                        </div>
</div>
                    </div>

                    <?php
                    

                }else{
                    echo '<h5>'.$carts['message'].'</h5>';
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