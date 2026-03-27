<?php 
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Ordered Item
                    <a href="orderedItems.php" class="btn btn-danger float-end">Back</a>
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

                    $orderedItem = getById('orderedItems', checkParamId('id'));
                    if ($orderedItem['status'] == 200) {
                    ?>

                        <input type="hidden" name="orderedItemId" value="<?= $orderedItem['data']['id']; ?>" required>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Order ID</label>
                                    <select name="order_id" class="form-select" required>
                                        <option value="">Select Order</option>
                                        <?php 
                                        $orders = getAll('orders');
                                        if(mysqli_num_rows($orders) > 0){
                                            foreach($orders as $order){
                                                $selected = ($order['id'] == $orderedItem['data']['order_id']) ? 'selected' : '';
                                                echo '<option value="'.$order['id'].'" '.$selected.'>Order #'.$order['id'].' - Total: $'.number_format($order['total'], 2).'</option>';
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
                                                $selected = ($good['id'] == $orderedItem['data']['goods_id']) ? 'selected' : '';
                                                echo '<option value="' . $good['id'] . '" data-price="' . $good['price'] . '" ' . $selected . '>'
                                                    . $good['id'] . ' ' . $good['brand'] . ' ' . $good['model'] . ' - €' . number_format($good['price'], 2) .
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
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="<?= $orderedItem['data']['quantity']; ?>" required oninput="calculateSubtotal()">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Price per Unit</label>
                                    <input type="text" name="price" id="price" class="form-control" value="€<?= number_format($orderedItem['data']['price'], 2); ?>" readonly required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Subtotal</label>
                                    <input type="text" id="subtotal" class="form-control" value="€<?= number_format($orderedItem['data']['quantity'] * $orderedItem['data']['price'], 2); ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 text-end">
                                    <br>
                                    <button type="submit" name="updateOrderedItem" class="btn btn-primary">Update Ordered Item</button>
                                </div>
                            </div>

                        </div>

                    <?php
                    } else {
                        echo '<h5>' . $orderedItem['message'] . '</h5>';
                    }
                    ?>

                </form>

            </div>
        </div>
    </div>
</div>

<script src="../config/function.js"></script>

<?php 
require_once __DIR__ . '/../includes/footer.php';
?>