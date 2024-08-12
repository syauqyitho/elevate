@extends('layouts.app.tech')
@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Transaksi Jasa</h3>
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
                            <?= anchor('tech/activity/detail/'.$act->activity_id, 'Detail', array('class' => 'btn btn-primary btn-sm'))?>
                            <?= anchor('user/activity/detail/'.$act->activity_id, 'Ambil', array('class' => 'btn btn-success btn-sm'))?>
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