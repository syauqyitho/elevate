  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('user/dashboard') ?>" class="brand-link">
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
            <a href="<?= base_url('user/dashboard/index"') ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('user/activity/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Jasa
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?= base_url('badanusaha/index') ?>" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Badan Usaha
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>