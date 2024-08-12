@extends('layouts.app.admin')

@section('title', 'List Kategori Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title"></h3> -->
                <a href="<?= base_url('admin/activity_category/add') ?>" class="card-tools btn btn-primary"><i class="fas fa-plus mx-1"></i>kategori Jasa</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap">
                  <tbody>
                    <?php $no=1; foreach ($activity_categories as $ac) : ?>
                      <tr>
                        <td class="col">
                          <p><?= $ac->activity_category_name ?></p>
                        </td>
                        <td class="align-middle">
                            <?= anchor('admin/activity_category/edit/'.$ac->activity_category_id, 'Edit', array('class' => 'btn btn-warning btn-sm'))?>
                            <?= anchor('admin/activity_category/delete/'.$ac->activity_category_id, 'Hapus', array('class' => 'btn btn-danger btn-sm'))?>
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