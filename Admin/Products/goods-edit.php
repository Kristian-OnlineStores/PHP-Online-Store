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
                                <input type="number" value="<?= $goods['data']['year'] ;?>" name="year" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Price</label>
                                    <input type="number" value="<?= $goods['data']['price'] ;?>" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Is on Sale</label>
                                <br>
                                <input type="checkbox" <?= $goods['data']['IsOnSale'] == 1 ? 'checked' : '' ;?> name="is_sale" style="width:30px; height: 30px" />
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

<?php //include('includes/footer.php'); 
require_once __DIR__ . '/../includes/footer.php';
?>