@extends('layouts.app.admin')

@section('title', 'List Pengguna')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('user/create/admin') ?>" class="card-tools btn btn-success"><i class="fas fa-plus mx-1"></i>Tambah Pengguna</a>

                <!-- <div class="">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap">
                  <tbody>
                    <?php $no=1; foreach ($users as $usr) : ?>
                      <tr>
                        <td class="col">
                          <div class="d-flex flex-column">
                            <p><?= $usr->name ?></p>
                            <p><?= $usr->email ?></p>
                          </div>
                        </td>
                        <td class="align-middle">
                            <a href="<?= base_url('user/show/admin/'.$usr->user_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="<?= base_url('user/delete/admin/'.$usr->user_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                      </tr>
                    <?php  endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection