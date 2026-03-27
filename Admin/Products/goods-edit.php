    <?php //include('includes/header.php'); 
    require_once __DIR__ . '/../config/function.php';
    
    require_once __DIR__ . '/../includes/header.php';
    ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Product
                    <a href="products.php" class="btn btn-danger float-end">Back</a>
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

                $goods = getById('goods', checkParamId('id'));
                if($goods['status'] == 200) {
                    ?>

                    <input type="hidden" name="goodsId" value="<?= $goods['data']['id'] ;?>" required>
                    
                     <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Brand</label>
                                <input type="text" value="<?= $goods['data']['brand'] ;?>" name="brand" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Model</label>
                                <input type="text" value="<?= $goods['data']['model'] ;?>" name="model" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Year</label>
                               <select name="year" id="year" class="form-control" required>
                                    <option value="">Select Year</option>
                                    <?php 
                                    $currentYear = date('Y');
                                    for($y = $currentYear; $y >= 1900; $y--): 
                                    ?>
                                        <option value="<?= $y; ?>" <?= ($goods['data']['year'] == $y) ? 'selected' : ''; ?>>
                                            <?= $y; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                 <label>Original Price</label>
                                <input type="number" step="0.01" name="price" id="originalPrice" value="<?= $goods['data']['price']; ?>" class="form-control" required>
                            </div>
                        </div>

                         <div class="col-md-3">
                            <div class="mb-3">
                                <label>Sale Status</label>
                                <br/>
                                <input type="checkbox" name="saleCheckbox" id="saleCheckbox" value="1" 
                                    style="width:30px; height: 30px" 
                                    <?= ($goods['data']['saleStatus'] == 1) ? 'checked' : ''; ?>
                                    onclick="toggleDiscountField()"/>
                            </div>
                        </div>
                        
                        <div class="col-md-3" style="display: <?= ($goods['data']['saleStatus'] == 1 && $goods['data']['discountPercent'] > 0) ? 'block' : 'none'; ?>;" id="discountField">
                            <div class="mb-3">
                                <label>Discount Percent</label>
                                <select name="discountPercent" id="discountPercent" class="form-select" onchange="calculateNewPrice()">
                                    <option value="">Select Discount</option>
                                    <?php for($i = 0; $i <= 90; $i += 5): ?>
                                        <option value="<?= $i; ?>" <?= ($goods['data']['discountPercent'] == $i) ? 'selected' : ''; ?>>
                                            <?= $i; ?>% off
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" style="display: <?= ($goods['data']['saleStatus'] == 1 && $goods['data']['discountPercent'] > 0) ? 'block' : 'none'; ?>;" id="pricePreview">
                            <div class="mb-3">
                                <label>New Price</label>
                                <div id="finalPrice" style="font-size: 15px; font-weight: bold; ">
                                    <?php 
                                    if($goods['data']['saleStatus'] == 1 && $goods['data']['discountPercent'] > 0) {
                                        $newPrice = $goods['data']['price'] - ($goods['data']['price'] * $goods['data']['discountPercent'] / 100);
                                        echo number_format($newPrice, 2) . ' BGN';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="b-3 text-end">
                                <br>
                                <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
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
 <script src="../config/function.js"></script>
<?php //include('includes/footer.php'); 
require_once __DIR__ . '/../includes/footer.php';
?>