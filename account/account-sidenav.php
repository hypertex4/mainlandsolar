<style>
    #user-account-sidenav li a.active{
        text-decoration: none;
        background-color: #209E02;
        color: #ffffff !important;
    }
    #user-account-sidenav li.sidenav-item:nth-child(4) a{
        color: #EA4B4B !important;
    }
    #user-account-sidenav li.sidenav-item:nth-child(4) a:hover{
        color: #ffffff !important;
    }
</style>
<ul class="sidenav mb-0" id="user-account-sidenav">
    <li class="sidenav-item">
        <a href="./account/" class="sidenav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php')  echo 'active'; ?>">ACCOUNT SETTINGS</a>
    </li>
    <li class="sidenav-item">
        <a href="./account/purchase-history" class="sidenav-link <?php if(basename($_SERVER['PHP_SELF']) == 'purchase-history.php' || basename($_SERVER['PHP_SELF']) == 'purchase-details.php')  echo 'active'; ?>">PURCHASE HISTORY</a>
    </li>
    <li class="sidenav-item">
        <a href="./account/wishlist" class="sidenav-link <?php if(basename($_SERVER['PHP_SELF']) == 'wishlist.php')  echo 'active'; ?>">WISHLIST</a>
    </li>
    <li class="sidenav-item"><a class="sidenav-link" href="logout">LOGOUT</a></li>
</ul>
