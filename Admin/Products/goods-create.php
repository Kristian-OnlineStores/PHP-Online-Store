    <?php //include('includes/header.php'); 
    require_once __DIR__ . '/../includes/header.php';
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Product
                        <a href="products.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="../code.php" method="POST">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Brand</label>
                                    <input type="text" name="brand" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Model</label>
                                    <input type="text" name="model" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Year</label>
                                    <input type="number" name="year" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>On Sale</label>
                                    <br/>
                                    <input type="hidden" name="yes" value="1">
                                    <input type="checkbox" name="no" value="0" style="width:30px; height: 30px" 
                                    onclick=""/>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3 text-end">
                                    <br>
                                    <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
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