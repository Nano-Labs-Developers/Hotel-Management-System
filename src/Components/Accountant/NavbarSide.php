<?php
    if(empty($user)) {
        $user = "User";
    }
?>

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="../images/lakderana7.png" class="navbar-brand-img" alt="icon">
            </a>
        </div>
        <div class="navbar-inner mt-5">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/accountant/dashboard">
                            <i class="fas fa-tachometer-alt text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-credit-card text-green"></i>
                            <span class="nav-link-text">Payment Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-money-coins text-pink"></i>
                            <span class="nav-link-text">Employee Salaries</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-money-bill-wave text-orange"></i>
                            <span class="nav-link-text">Bar Income Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-dollar-sign text-blue"></i>
                            <span class="nav-link-text">Add Expenditure (Hotel)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>