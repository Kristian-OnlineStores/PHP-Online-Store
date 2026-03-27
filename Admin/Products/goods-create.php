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
<!--<input type="date" name="year" class="form-control"  max="<?= date('Y-m-d'); ?>"  required >-->
                                    <select name="year" id="year" class="form-control" required >
                                        <option value="">Select Year</option>
                                        <?php 
                    $currentYear = date('Y');
                    for($y = $currentYear; $y >= 1900; $y--): 
                    ?>
                        <option value="<?= $y; ?>"><?= $y; ?></option>
                    <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Original Price</label>
                                    <input type="number" step="0.01" name="price" id="originalPrice" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Sale Status</label>
                                    <br/>
                    <!--<input type="hidden" name="Sale1" value="0">-->
                                    <input type="checkbox" name="saleCheckbox" id="saleCheckbox" value="1" style="width:30px; height: 30px" 
                                    onclick="toggleDiscountField()"/>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;" id="discountField">
                                <div class="mb-3">
                                    <label>Discount Percent</label>
                                    <select name="discountPercent" id="discountPercent" class="form-select" >
                                        <option value="">Select Discount</option>
                                        <?php for($i = 0; $i <= 90; $i += 5): ?>
                                       <option value="<?= $i; ?>"><?= $i; ?>% off</option>
                                       <?php endfor; ?>
                                    </select>
                                    
                                </div>
                            </div>

                           <div class="col-md-3" style="display:none;" id="pricePreview">
                                <div class="mb-3">
                                    <label>New Price</label>
                                    <div  id="finalPrice" style="font-size: 15px; font-weight: bold; "></div>
                                </div>
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

    <script src="../config/function.js"></script>

    <?php //include('includes/footer.php'); 
    require_once __DIR__ . '/../includes/footer.php';
    ?>