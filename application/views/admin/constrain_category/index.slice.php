@extends('layouts.app.admin')

@section('title', 'List Kategori Kendala')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('admin/constrain_category/add') ?>" class="card-tools btn btn-primary"><i class="fas fa-plus mx-1"></i>kategori Kendala</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap">
                  <tbody>
                    <?php $no=1; foreach ($constrain_categories as $cc) : ?>
                      <tr>
                        <td class="col">
                          <p><?= $cc->constrain_category_name ?></p>
                        </td>
                        <td class="align-middle">
                            <?= anchor('admin/constrain_category/edit/'.$cc->constrain_category_id, 'Edit', array('class' => 'btn btn-warning btn-sm'))?>
                            <?= anchor('admin/constrain_category/delete/'.$cc->constrain_category_id, 'Hapus', array('class' => 'btn btn-danger btn-sm'))?>
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