<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Add Service
                    <a href="services.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                <form action="../code.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
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