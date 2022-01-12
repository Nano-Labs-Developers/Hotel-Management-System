<?php
    if(empty($user)) {
        $user = "User";
    }
?>

<nav class="sidenav navbar navbar-vertical fixed-left  navbar-expand-xs navbar-light bg-white" style="background-color: #f7f3f2;" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="/Assets/image/lakderana_logo.png" class="navbar-brand-img" alt="icon">
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/hotelbar/dashboard">
                            <i class="fas fa-tachometer-alt text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hotelbar/liquor">
                            <i class="fas fa-glass-martini-alt text-green"></i>
                            <span class="nav-link-text">Manage Liquor Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hotelbar/itemsold">
                            <i class="fas fa-glass-cheers text-pink"></i>
                            <span class="nav-link-text">Manage Sold Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hotelbar/salesdaily">
                            <i class="fas fa-piggy-bank text-orange"></i>
                            <span class="nav-link-text">Daily Sales</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hotelbar/expenditure">
                            <i class="fas fa-dollar-sign text-blue"></i>
                            <span class="nav-link-text">Expenditure Details</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>