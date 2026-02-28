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
                    <label>User ID</label>
                    <input type="number" name="user_id" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Goods ID</label>
                    <input type="number" name="goods_id" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="1" required>
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