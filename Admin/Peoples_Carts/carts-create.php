    <?php //include('includes/header.php'); 
    require_once __DIR__ . '/../includes/header.php';
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Cart
                        <a href="carts.php" class="btn btn-danger float-end">Back</a>
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
                                    <label>Product</label>
                                    <select name="goods_id" id="goods_id" class="form-select" required>
                                        <option value="">Select Product</option>
                                        <?php
                                        $goods = getAll('goods');
                                        if (mysqli_num_rows($goods) > 0) {
                                            foreach ($goods as $good) {
                                                echo '<option value="' . $good['id'] . '" data-price="' . $good['price'] . '">'
                                                    . $good['id'] . ' - ' . $good['brand'] . ' ' . $good['model'] . ' - €' . number_format($good['price'], 2) .
                                                    '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" value="1" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3 text-end">
                                    <br>
                                    <button type="submit" name="saveCart" class="btn btn-primary">Save</button>
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