<?php
$base_url = getBasePath();
?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <a class="navbar-brand m-0" href="index.php">
      <h4>Services</h4>
    </a>

    </a>
  </div>

  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link  active" href="../index.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-house text-white fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Enquiries</h6>
      </li>

      <li class="nav-item">
        <a class="nav-link  " href="enquiries.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-bullhorn text-dark fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Enquiries</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manage Services</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="<?= $base_url ?>services.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-gears text-dark fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Services</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Site Management</h6>
      </li>
      <li class="nav-item">
        <!--<a class="nav-link  " href="Users/users.php">-->
        <a class="nav-link" href="<?= $base_url ?>Users/users.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-user-plus text-dark fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Admin / Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>Products/products.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-boxes-stacked text-dark fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Goods</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>Peoples_Carts/carts.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-cart-shopping text-dark fs-5"></i>
          </div>
          <span class="nav-link-text ms-1">Peoples Carts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>Orders/orders.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-clipboard-list text-dark fs-5"></i><!--<i class="fa-solid fa-truck text-dark fs-5"></i>-->
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>Social_Media/social_media.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-globe text-dark fs-5"></i>

          </div>
          <span class="nav-link-text ms-1">Social Media</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  " href="<?= $base_url ?>settings.php">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-gear text-dark fs-5"></i>

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