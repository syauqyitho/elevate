  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('welcome/welcome') ?>" class="brand-link">
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
            <a href="<?= base_url('admin/activity/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Jasa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/company_branch/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
               Cabang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/group_of_entity/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
               Kelompok Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/enterprise/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/enterprise_status/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                Status Badan Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/constrain_category/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>
                Kategori Kendala
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/activity_category/index') ?>" class="nav-link">
              <i class="nav-icon fas fa-bullseye"></i>
              <p>
                Kategori Jasa
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>