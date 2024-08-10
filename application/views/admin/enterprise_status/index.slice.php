@extends('layouts.app.admin')
@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('admin/enterprise/add') ?>" class="card-tools btn btn-primary"><i class="fas fa-plus mx-1"></i>Badan Usaha</a>

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
                    <?php $no=1; foreach ($enterprise_status as $ent) : ?>
                      <tr>
                        <td class="d-flex flex-column">
                          <p><?= $ent->enterprise_name ?></p>
                          <p><?= $ent->enterprise_status_name ?></p>
                        </td>
                        <td class="align-middle">
                            <?= anchor('admin/enterprise/edit/'.$ent->enterprise_id, 'Edit', array('class' => 'btn btn-warning btn-sm'))?>
                            <?= anchor('admin/enterprise/delete/'.$ent->enterprise_id, 'Hapus', array('class' => 'btn btn-danger btn-sm'))?>
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