<?php
//kvuli navigaci
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<head>
    <link rel="stylesheet" href="./bootstrap.css" />
    <link rel="stylesheet" href="./bootstrap-icons.css" />
</head>

<style>
    /* some hacks for responsive sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        /* height of navbar */
    }

    .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
    }

    .nav-link {
        color: black;
    }

    .color--white {
        color: white;
    }

    .nav-link.active {
        color: blue;
    }
</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo $activePage === 'dashboard' ? 'active' : ''; ?>" aria-current="page">
                    <span class="icon">
                        <i class="bi bi-easel"></i>
                    </span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="items.php" class="nav-link <?php echo $activePage === 'items' ? 'active' : ''; ?>">
                    <span class="icon">
                        <i class="bi bi-card-list"></i>
                    </span>
                    Items
                </a>
            </li>
            <li>
                <a href="others.php" class="nav-link <?php echo $activePage === 'others' ? 'active' : ''; ?>">
                    <span class="icon">
                        <i class="bi bi-box"></i>
                    </span>
                    Others
                </a>
            </li>
            <li>
                <a href="users.php" class="nav-link <?php echo $activePage === 'users' ? 'active' : ''; ?>">
                    <span class="icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    Users
                </a>
            </li>
        </ul>
    </div>
</nav>

<header
    class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <button
        class="navbar-toggler d-md-none collapsed m-2 b-0"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">simple administration</a>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 color--white" href="logout.php">logout</a>
        </div>
    </div>
</header>