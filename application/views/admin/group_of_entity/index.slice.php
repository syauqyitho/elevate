@extends('layouts.app.admin')

@section('title', 'List Kelompok Badan Usaha')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('admin/group_of_entity/add') ?>" class="card-tools btn btn-primary"><i class="fas fa-plus mx-1"></i>Kelompok Badan Usaha</a>

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
                    <?php $no=1; foreach ($group_of_entities as $goe) : ?>
                      <tr>
                        <td class="col">
                          <div class="d-flex flex-column">
                            <p><?= $goe->group_of_entity_name ?></p>
                            <p><?= $goe->npwp_number ?></p>
                          </div>
                        </td>
                        <td class="align-middle">
                          <a href="<?= base_url('admin/group_of_entity/edit/'.$goe->group_of_entity_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="<?= base_url('admin/group_of_entity/delete/'.$goe->group_of_entity_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
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