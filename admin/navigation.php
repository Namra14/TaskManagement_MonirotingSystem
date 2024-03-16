<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
    </button>
    <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold logo-name" href="#">Specialization | Recommendation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </div>
</nav>

<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
    </button>
    <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold logo-name" href="#">Specialization | Recommendation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="topNavBar">
      <form class="d-flex ms-auto my-3 my-lg-0">
        <!--
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          -->
      </form>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill"> <span style="font-style: normal; text-transform: uppercase;"><?php echo $fetch['admin_username']; ?></span></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="admin-edit-accounts.php">
                <span class="me-1"><i class="bi bi-gear-fill"></i></span>
                <span>Edit Account</span>
              </a>
            </li>
            <li>
              <a href="logout.php" class="dropdown-item">
                <span class="me-1"><i class="bi bi-box-arrow-left"></i></span>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>
<!-- top navigation bar -->

<!-- offcanvas -->
<div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3">
            CORE
          </div>
        </li>
        <li>
          <a href="admin-dashboard.php" class="nav-link px-3 active">
            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="my-4">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Content
          </div>
        </li>
        <li>
          <a href="admin-dashboard.php#charts" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-graph-up"></i></span>
            <span>Charts</span>
          </a>
        </li>
        <li>
          <a href="admin-user-tables.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-people"></i></span>
            <span>Students Table</span>
          </a>
        </li>

        <!-- Show Admin Table if the superadmin is logged in -->
        <?php if ($fetch['user_type'] == 'superadmin') { ?>

          <li>
            <a href="admin-view-admin.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-table"></i></span>
              <span>Admin Table</span>
            </a>
          </li>

        <?php } ?>

        <li>
          <a href="admin-grades-data.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-server"></i></span>
            <span>Grades Data</span>
          </a>
        </li>

        <li>
          <a href="admin-manage-blogs.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-journals"></i></span>
            <span>Manage Blogs</span>
          </a>
        </li>

        <li>
          <a href="admin-manage-questions.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-book"></i></span>
            <span>Manage Questions</span>
          </a>
        </li>

        <li>
          <a href="admin-view-messages.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-chat-right-quote"></i></span>
            <span>View Messages</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- offcanvas -->