@extends('layouts.app.tech')

@section('title', 'List Transaksi Jasa')

@section('content')
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Tiket Dalam Antrian</a></li>
                  <li class="nav-item"><a class="nav-link" href="#list-tech" data-toggle="tab">List Tiket</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="card" style="height: 65vh">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" >
                        <table class="table table-head-fixed text-nowrap">
                          <tbody>
                            <?php $no=1; foreach ($activities as $act) : ?>
                              <tr>
                                <td class="col-4 align-middle"><?= $act->name ?></td>
                                <td class="col-4 align-middle"><?= $act->status ?></td>
                                <td class="col-4">
                                  <div class="d-flex flex-column">
                                    <p><?= $act->constrain ?></p>
                                    <p><?= $act->created_at ?></p>
                                  </div>
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('activity/take/tech/'.$act->activity_id) ?>" class="btn btn-sm btn-success">Ambil</a>
                                </td>
                              </tr>
                            <?php  endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="list-tech">
                    <div class="card" style="height: 65vh">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" >
                        <table class="table table-head-fixed text-nowrap">
                          <tbody>
                            <?php $no=1; foreach ($histories as $hs) : ?>
                              <tr>
                                <td class="col-4 align-middle"><?= $hs->name ?></td>
                                <td class="col-4 align-middle"><?= $hs->status ?></td>
                                <td class="col-4">
                                  <div class="d-flex flex-column">
                                    <p><?= $hs->constrain ?></p>
                                    <p><?= $hs->created_at ?></p>
                                  </div>
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('activity/show/tech/'.$hs->activity_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                              </tr>
                            <?php  endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
@endsection