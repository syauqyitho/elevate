@extends('layouts.app.user')
@section('content')
        <div class="row">
          <div class="col-sm-6">
            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Buku Manual</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-caret-down"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="d-flex flex-column align-items-center my-4"> 
                  <i class="fas fa-book"></i>
                  <p class="my-2">Buku Manual Jaringan</p>
                  <a href="#" class="btn btn-primary btn-sm">Baca Buku</a>
                </div>
                <div class="d-flex flex-column align-items-center my-4"> 
                  <i class="fas fa-book"></i>
                  <p class="my-2">Buku Manual Jaringan</p>
                  <a href="#" class="btn btn-primary btn-sm">Baca Buku</a>
                </div>
                <div class="d-flex flex-column align-items-center my-4"> 
                  <i class="fas fa-book"></i>
                  <p class="my-2">Buku Manual Jaringan</p>
                  <a href="#" class="btn btn-primary btn-sm">Baca Buku</a>
                </div>
                <div class="d-flex flex-column align-items-center my-4"> 
                  <i class="fas fa-book"></i>
                  <p class="my-2">Buku Manual Jaringan</p>
                  <a href="#" class="btn btn-primary btn-sm">Baca Buku</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-sm-6">
            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Daftar Transksi Jasa</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-caret-down"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php foreach ($activities as $act) : ?>
                <div class="d-flex my-2"> 
                  <div class="col">
                    <p class="my-0 mb-1"><?= $act->constrain ?></p>
                    <p class="my-0"><?= $act->status ?></p>
                  </div>
                  <div class="col align-self-center">
                    <div class="d-flex justify-content-end">
                      <a href="<?= base_url('activity/show/').$act->activity_id ?>" class="btn btn-primary btn-sm">Detail</a>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

@endsection