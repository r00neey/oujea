<!doctype html>
<html lang="cs">

<head>
  <title>Simple Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./bootstrap.css">
  <link rel="stylesheet" href="./bootstrap-icons.css">
</head>

<style>
/* some hacks for responsive sidebar */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  padding: 48px 0 0; /* height of navbar */
}

.sidebar-sticky {
  height: calc(100vh - 48px);
  overflow-x: hidden;
  overflow-y: auto;
}

</style>
<body>


  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <button class="navbar-toggler d-md-none collapsed m-2 b-0" type="button" data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Simple administration</a>

    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="index.php?page=logout">Logout</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
              <a href="index.php?page=dashboard" class="nav-link <?php echo (basename($_SERVER['REQUEST_URI']) == 'dashboard') ? 'active' : 'link-dark'; ?>" aria-current="page">
                <span class="icon">
                  <i class="bi bi-easel"></i>
                </span>
                Dashboard
              </a>
            </li>
            <li>
              <a href="index.php?page=items" class="nav-link <?php echo (basename($_SERVER['REQUEST_URI']) == 'items') ? 'active' : 'link-dark'; ?>">
                <span class="icon">
                  <i class="bi bi-card-list"></i>
                </span>
                Items
              </a>
            </li>
            <li>
              <a href="index.php?page=others" class="nav-link <?php echo (basename($_SERVER['REQUEST_URI']) == 'others') ? 'active' : 'link-dark'; ?>">
                <span class="icon">
                  <i class="bi bi-box"></i>
                </span>
                Others
              </a>
            </li>
            <li>
              <a href="index.php?page=users" class="nav-link <?php echo (basename($_SERVER['REQUEST_URI']) == 'users') ? 'active' : 'link-dark'; ?>">
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

  <script src="./bootstrap.js"></script>
</body>

</html>
