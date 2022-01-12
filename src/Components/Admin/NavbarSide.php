<?php
    if(empty($user)) {
        $user = "User";
    }
?>

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" style="background-color: #f7f3f2;" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="/Assets/image/lakderana_logo.png" class="navbar-brand-img" alt="icon">
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">
                            <i class="fas fa-user-plus text-green"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/hotels">
                            <i class="fas fa-hotel text-orange"></i>
                            <span class="nav-link-text ">Hotels</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/rooms">
                            <i class="fas fa-warehouse text-primary"></i>
                            <span class="nav-link-text ">Rooms</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-single-copy-04 text-blue"></i>
        <span class="nav-link-text">Generate Reports</span>
    </a>
</li> -->