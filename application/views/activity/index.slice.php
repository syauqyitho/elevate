@extends('layouts.app.user')
@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('user/activity/add') ?>" class="card-tools btn btn-primary"><i class="fas fa-plus mx-1"></i>Transaksi Jasa</a>

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
                            <?= anchor('user/activity/detail/'.$act->activity_id, 'Detail', array('class' => 'btn btn-primary btn-sm'))?>
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