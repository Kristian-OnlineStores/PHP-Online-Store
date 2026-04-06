<?php
$pageName = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
$base_url = getBasePath();
?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <a class="navbar-brand m-0" href="../index.php">
      <h4>Services</h4>
    </a>

    </a>
  </div>

  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link  
        <?= ($pageName == 'index.php') ? 'active' : '' ?>"
         href="../index.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-house <?= ($pageName == 'index.php') ? 'text-white' : 'text-dark' ?> fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Enquiries</h6>
      </li>

      <li class="nav-item">
        <a class="nav-link  
        <?= ($pageName == 'enquirie.php') ? 'active' : '' ?>
        <?= ($pageName == 'enquirie-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'enquirie-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Enquiries/enquirie.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-bullhorn 
            <?= ($pageName == 'enquirie.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'enquirie-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'enquirie-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Enquiries</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manage Services</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  
        <?= ($pageName == 'services.php') ? 'active' : '' ?>
        <?= ($pageName == 'services-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'services-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Service/services.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-gears 
            <?= ($pageName == 'services.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'services-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'services-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Services</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Site Management</h6>
      </li>
      <li class="nav-item">
        <!--<a class="nav-link  " href="Users/users.php">-->
        <a class="nav-link 
        <?= ($pageName == 'users.php') ? 'active' : '' ?>
        <?= ($pageName == 'users-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'users-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Users/users.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-user-plus 
            <?= ($pageName == 'users.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'users-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'users-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Admin / Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link 
        <?= ($pageName == 'products.php') ? 'active' : '' ?>
        <?= ($pageName == 'goods-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'goods-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Products/products.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-boxes-stacked 
            <?= ($pageName == 'products.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'goods-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'goods-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Goods</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link
        <?= ($pageName == 'carts.php') ? 'active' : '' ?>
        <?= ($pageName == 'carts-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'carts-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Peoples_Carts/carts.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-cart-shopping 
            <?= ($pageName == 'carts.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'carts-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'carts-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Peoples Carts</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link
        <?= ($pageName == 'orders.php') ? 'active' : '' ?>
        <?= ($pageName == 'orders-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'orders-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Orders/orders.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-clipboard-list 
            <?= ($pageName == 'orders.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'orders-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'orders-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i><!--<i class="fa-solid fa-truck text-dark fs-5"></i>-->
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
      </li>

           <li class="nav-item">
        <a class="nav-link
        <?= ($pageName == 'orderedItems.php') ? 'active' : '' ?>
        <?= ($pageName == 'orderedItems-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'orderedItems-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Ordered_Items/orderedItems.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-regular fa-clipboard 
            <?= ($pageName == 'orderedItems.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'orderedItems-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'orderedItems-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Ordered Items</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link 
        <?= ($pageName == 'social_media.php') ? 'active' : '' ?>
        <?= ($pageName == 'social_media-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'social_media-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Social_Media/social_media.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-globe 
            <?= ($pageName == 'social_media.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'social_media-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'social_media-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>

          </div>
          <span class="nav-link-text ms-1">Social Media</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  
        <?= ($pageName == 'settings.php') ? 'active' : '' ?>
        <?= ($pageName == 'settings-create.php') ? 'active' : '' ?>
        <?= ($pageName == 'settings-edit.php') ? 'active' : '' ?>"
         href="<?= $base_url ?>Settings/settings.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-gear 
            <?= ($pageName == 'settings.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'settings-create.php') ? 'text-white' : 'text-dark' ?> 
            <?= ($pageName == 'settings-edit.php') ? 'text-white' : 'text-dark' ?> 
            fs-5"></i>

          </div>
          <span class="nav-link-text ms-1">Settings</span>
        </a>
      </li>

    </ul>
  </div>
  <div class="sidenav-footer mx-3 ">

    <a class="btn btn-primary mt-3 w-100" href="/../../php/logout.php">
      Logout</a>
  </div>
</aside>