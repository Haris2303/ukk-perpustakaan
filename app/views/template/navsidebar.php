<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block"><?= APP_NAME ?></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['NamaLengkap'] ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= $_SESSION['NamaLengkap'] ?></h6>
            <span><?= ucwords($_SESSION['Role']) ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= BASEURL ?>/setting">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= BASEURL ?>/web/do_logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Jika role bukan peminjam -->
    <?php if ($_SESSION['Role'] !== 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
    <?php endif ?>

    <!-- Jika role adalah admin -->
    <?php if ($_SESSION['Role'] === 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= BASEURL ?>/petugas">
              <i class="bi bi-circle"></i><span>Petugas</span>
            </a>
          </li>
          <li>
            <a href="<?= BASEURL ?>/peminjam">
              <i class="bi bi-circle"></i><span>Peminjam</span>
            </a>
          </li>
        </ul>
      </li>
    <?php endif ?>

    <!-- Jika role bukan peminjam -->
    <?php if ($_SESSION['Role'] !== 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/buku">
          <i class="bi bi-journal-text"></i>
          <span>Buku</span>
        </a>
      </li>
    <?php endif ?>

    <!-- Jika role adalah admin -->
    <?php if ($_SESSION['Role'] === 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/kategori">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Kategori</span>
        </a>
      </li>
    <?php endif ?>

    <!-- Jika role bukan peminjam -->
    <?php if ($_SESSION['Role'] !== 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/peminjaman">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Peminjaman</span>
        </a>
      </li>
    <?php endif ?>

    <!-- Jika role adalah peminjam -->
    <?php if ($_SESSION['Role'] === 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/lists/buku">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>List Buku</span>
        </a>
      </li>
    <?php endif ?>

    <!-- Jika role adalah peminjam -->
    <?php if ($_SESSION['Role'] === 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/lists/koleksi">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Koleksi</span>
        </a>
      </li>
    <?php endif ?>

    <!-- Jika role adalah peminjam -->
    <?php if ($_SESSION['Role'] === 'peminjam') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= BASEURL ?>/lists/peminjaman/<?= $_SESSION['user_id'] ?>">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Peminjaman Saya</span>
        </a>
      </li>
    <?php endif ?>

  </ul>

</aside><!-- End Sidebar-->