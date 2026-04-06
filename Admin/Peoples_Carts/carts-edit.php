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
                                    <label>User</label>
                                    
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        <?php
                                        $users = getAll('users');
                                        if (mysqli_num_rows($users) > 0) {
                                            foreach ($users as $user) {
                                                $selected = ($user['id'] == $carts['data']['user_id']) ? 'selected' : '';
                                                echo '<option value="' . $user['id']. '" ' . $selected . '>' . $user['id'].' - '.$user['FirstName'].' '.$user['LastName']. '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

              <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Product</label>
                                    <select name="goods_id" id="goods_id" class="form-select" required>
                                        <option value="">Select Product</option>
                                        <?php
                                        $goods = getAll('goods');
                                        if (mysqli_num_rows($goods) > 0) {
                                            foreach ($goods as $good) {
                                                $selected = ($good['id'] == $carts['data']['goods_id']) ? 'selected' : '';
                                               echo '<option value="' . $good['id'] . '" ' . $selected . ' data-price="' 
                                               . $good['price'] . '">'. $good['id'] . ' - ' . $good['brand'] . ' ' . $good['model'] . ' - €' . number_format($good['price'], 2)
                . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" value="<?= $carts['data']['quantity'] ;?>" min="1" required>
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