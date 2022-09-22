<div class="bg-white hide" id="sidebar">
    <div class="d-flex justify-content-between align-items-center d-block d-md-none">
        <h5 class="d-block d-md-none mt-4 mb-3">MY DASHBOARD</h5>
        <button class="btn p-0" id="userAccountCloseMenuBtn">
            <span data-feather="plus" class="rotate_45"></span>
        </button>
    </div>
    <ul class="nav-tab list-group">
        <li class="list-group-item">
            <a href="account/index" class="<?php if(basename($_SERVER['PHP_SELF']) == 'index.php')  echo 'active'; ?>">My Account</a>
        </li>
        <li class="list-group-item">
            <a href="account/orders" class="<?php if(basename($_SERVER['PHP_SELF']) == 'orders.php' || basename($_SERVER['PHP_SELF']) == 'order-details.php') echo 'active'; ?>">Orders</a>
        </li>
        <li class="list-group-item">
            <a href="account/pending-reviews" class="<?php if(basename($_SERVER['PHP_SELF']) == 'pending-reviews.php' || basename($_SERVER['PHP_SELF']) == 'review.php') echo 'active'; ?>">Pending Reviews</a>
        </li>
        <li class="list-group-item">
            <a href="account/wishlist" class="<?php if(basename($_SERVER['PHP_SELF']) == 'wishlist.php') echo 'active'; ?>">Saved Items</a>
        </li>
    </ul>

</div>