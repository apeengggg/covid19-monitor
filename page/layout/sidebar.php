<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?module=dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
        <?php
        if ($_SESSION['level']==='SuperAdmin') {?>
          <li class="nav-item">
            <a class="nav-link" href="?module=master_pasien">
              <span data-feather="file"></span>
              Master Data Pasien
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?module=master_jk">
              <span data-feather="shopping-cart"></span>
              Master Data Jenis Kelamin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?module=master_status_pasien">
              <span data-feather="users"></span>
              Master Data Status Pasien
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?module=master_status_user">
              <span data-feather="bar-chart-2"></span>
              Master Data Status User
            </a>
          </li>
        </ul>
        <?php } ?>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Data</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="?module=pasien">
              <span data-feather="file-text"></span>
              Data Pasien
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?module=user">
              <span data-feather="file-text"></span>
              Data User
            </a>
          </li>
        </ul>
      </div>
    </nav>