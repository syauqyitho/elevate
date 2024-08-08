@extends('layouts.app')
@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('activity/add') ?>" class="card-tools btn btn-primary">+ Transaksi Jasa</a>

                <div class="">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                  <!-- <thead>
                    <tr>
                      <th>No</th>
                      <th>User</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <!-- <tr>
                      <td>982</td>
                      <td>Rocky Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr> -->
                    <?php $no=1; foreach ($activities as $act) : ?>
                      <tr>
                        <td class="d-flex flex-column">
                          <p><?= $act->constrain ?></p>
                          <p><?= $act->created_at ?></p>
                        </td>
                        <td class="align-middle"><?= $act->status ?></td>
                        <td class="align-middle">
                            <?= anchor('activity/detail/'.$act->activity_id, 'Detail', array('class' => 'btn btn-primary btn-sm'))?>
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