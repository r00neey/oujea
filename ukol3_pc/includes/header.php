<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css" />
    <link rel="stylesheet" href="./bootstrap-icons.css" />
    <title>Admin Panel</title>
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
</style>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <button class="navbar-toggler d-md-none collapsed m-2 b-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">simple administration</a>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Logout</a>

            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">

                    <?php
                    // Zjistíme aktuální URI (např. '/dashboard', '/items', '/others', '/users')
                    $uri = $_SERVER['REQUEST_URI'];
                    ?>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link <?= (strpos($uri, 'dashboard') !== false) ? 'active' : 'link-dark' ?>" aria-current="page">
                                <span class="icon">
                                    <i class="bi bi-easel"></i>
                                </span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="items" class="nav-link <?= (strpos($uri, 'items') !== false) ? 'active' : 'link-dark' ?>">
                                <span class="icon">
                                    <i class="bi bi-card-list"></i>
                                </span>
                                Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="others" class="nav-link <?= (strpos($uri, 'others') !== false) ? 'active' : 'link-dark' ?>">
                                <span class="icon">
                                    <i class="bi bi-box"></i>
                                </span>
                                Others
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users" class="nav-link <?= (strpos($uri, 'users') !== false) ? 'active' : 'link-dark' ?>">
                                <span class="icon">
                                    <i class="bi bi-person-circle"></i>
                                </span>
                                Users
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>