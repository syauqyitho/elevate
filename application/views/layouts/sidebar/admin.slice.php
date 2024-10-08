  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard/admin') ?>" class="brand-link">
      <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('activity/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Jasa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('constrain/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>
                Kategori Kendala
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('activity/category/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-bullseye"></i>
              <p>
                Kategori Jasa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('branch/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
               Cabang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('entity-group/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
               Kelompok Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('enterprise/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('enterprise/status/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                Status Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('user/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('history/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('report/user/admin') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('report/tech/admin') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Technician</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>