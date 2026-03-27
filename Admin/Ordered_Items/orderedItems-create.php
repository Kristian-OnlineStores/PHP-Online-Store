<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Ordered Item
                    <a href="orderedItems.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="../code.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Order ID</label>
                                <select name="order_id" class="form-select" required>
                                    <option value="">Select Order</option>
                                    <?php
                                    $orders = getAll('orders');
                                    if (mysqli_num_rows($orders) > 0) {
                                        foreach ($orders as $order) {
                                            echo '<option value="' . $order['id'] . '">Order #' . $order['id'] . ' - Total: €' . number_format($order['total'], 2) . '</option>';
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
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required oninput="calculateSubtotal()">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Price per Unit</label>
                                <input type="text" name="price" id="price" class="form-control" readonly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Subtotal</label>
                                <input type="text" id="subtotal" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 text-end">
                                <br>
                                <button type="submit" name="saveOrderedItem" class="btn btn-primary">Save Ordered Item</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../config/function.js"></script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>