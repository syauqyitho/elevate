@extends('layouts.app.tech')

@section('title', 'Detail Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Teknisi Detail</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <a href="<?= base_url('tech/activity_detail/add/'.$activities['activity_id']) ?>" class="btn btn-success"><i class="fas fa-plus mx-1"></i>Teknisi Detail</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height:300px;">
                <table class="table table-head-fixed text-nowrap">
                  <tbody>
                    <?php $no=1; foreach ($activity_details as $ad) : ?>
                      <tr>
                        <td class="col">
                          <div class="d-flex flex-column">
                            <p><?= $ad->name ?></p>
                            <p><?= $ad->created_at ?></p>
                          </div>
                        </td>
                        <td class="align-middle">
                            <a href="<?= base_url('tech/activity_detail/edit/'.$ad->activity_detail_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="<?= base_url('tech/activity_detail/delete/'.$ad->activity_detail_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
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

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Jasa</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="created_at">Waktu Laporan</label>
                  <input type="text" class="form-control rounded-0" id="created_at" placeholder="Waktu Keluhan" value="<?= $activities['created_at'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="custom-select rounded-0" id="status" name="status" disabled>
                    <?php foreach($activity_status as $ast) : ?>
                    <option value="<?= $ast->activity_status_id ?>" <?= $activities['activity_status_id'] == $ast->activity_status_id ? 'selected' : '' ?> ><?= $ast->activity_status_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Nama Pengorder</label>
                  <select class="custom-select rounded-0" id="name" name="name" disabled>
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>" <?= $activities['user_id'] == $usr->user_id ? 'selected' : '' ?> ><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="branch_name">Cabang</label>
                  <input type="text" class="form-control rounded-0" id="branch_name" placeholder="Cabang" value="<?= $activities['branch_name'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <input type="text" class="form-control rounded-0" id="address" placeholder="Alamat" value="<?= $activities['address'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="department">Departemen</label>
                  <input type="text" class="form-control rounded-0" id="department" placeholder="Departemen" value="<?= $activities['department'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="activity_category">Kategori Jasa</label>
                  <select class="custom-select rounded-0" id="activity_category" name="activity_category" disabled>
                    <?php foreach($activity_categories as $ac) : ?>
                    <option value="<?= $ac->activity_category_id ?>" <?= $activities['activity_category_id'] == $ac->activity_category_id ? 'selected' : '' ?> ><?= $ac->activity_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain_category">Kategori Kendala</label>
                  <select class="custom-select rounded-0" id="constrain_category" name="constrain_category" disabled>
                    <?php foreach($constrain_categories as $cc) : ?>
                    <option value="<?= $cc->constrain_category_id ?>" <?= $activities['constrain_category_id'] == $cc->constrain_category_id ? 'selected' : '' ?> ><?= $cc->constrain_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain">Kendala</label>
                  <input type="text" class="form-control rounded-0" id="constrain" name="constrain" value="<?= $activities['constrain'] ?>" placeholder="Kendala" disabled>
                </div>
                <div class="form-group">
                  <label for="constrain_description">Deskripsi Kendala</label>
                  <textarea class="form-control" rows="3" id="constrain_description" name="constrain_description" placeholder="Enter ..." disabled><?= $activities['constrain_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['img'] ?>" alt="User Photo">
                    </div>
                  </div>
                </div>
                <a href="<?= base_url('tech/activity/history') ?>" class="btn btn-primary">Kembali</a>
              </div>
              <!-- /.card-body -->
            </div>
@endsection