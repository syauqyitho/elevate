@extends('layouts.app.user')

@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <a href="<?= base_url('user/activity/add') ?>" class="card-tools btn btn-success"><i class="fas fa-plus mx-1"></i>Transaksi Jasa</a>
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
                            <a href="<?= base_url('user/activity/edit/'.$act->activity_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="<?= base_url('user/activity/delete/'.$act->activity_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
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