@extends('layouts.app.admin')
@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('admin/activity/add') ?>" class="card-tools btn btn-success"><i class="fas fa-plus mx-1"></i>Transaksi Jasa</a>

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
                    <?php $no=1; foreach ($activities as $act) : ?>
                      <tr>
                        <td class="col">
                          <div class="d-flex flex-column">
                            <p><?= $act->constrain ?></p>
                            <p><?= $act->created_at ?></p>
                          </div>
                        </td>
                        <td class="align-middle"><?= $act->status ?></td>
                        <td class="align-middle">
                            <a href="<?= base_url('admin/activity/edit/'.$act->activity_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="<?= base_url('admin/activity/delete/'.$act->activity_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
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