@extends('layouts.app.user')

@section('title', 'Edit Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Teknisi Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height:300px;">
                <table class="table table-head-fixed text-nowrap">
                  <tbody>
                    <?php $no=1; foreach ($activity_details as $ad) : ?>
                      <tr>
                        <td class="col">
                          <div class="d-flex flex-column">
                            <p><?= $ad->analyze ?></p>
                            <p><?= $ad->created_at ?></p>
                          </div>
                        </td>
                        <td class="align-middle">
                            <a href="<?= base_url('user/activity_detail/detail/'.$ad->activity_detail_id) ?>" class="btn btn-sm btn-primary">Detail</a>
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
                <?= form_open_multipart('user/activity/edit/'.$activities['activity_id']) ?>
                <div class="form-group">
                  <label for="created_at">Waktu Laporan</label>
                  <input type="text" class="form-control rounded-0" id="created_at" placeholder="Waktu Keluhan" value="<?= $activities['created_at'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="user_name">Nama Pangorder</label>
                  <input type="text" class="form-control rounded-0" id="user_name" placeholder="Nama Pengorder" value="<?= $activities['user_name'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="activity_category">Kategori Jasa</label>
                  <select class="custom-select rounded-0" id="activity_category" name="activity_category">
                    <?php foreach($activity_categories as $ac) : ?>
                    <option value="<?= $ac->activity_category_id ?>" <?= $activities['activity_category_id'] == $ac->activity_category_id ? 'selected' : '' ?> ><?= $ac->activity_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain_category">Kategori Kendala</label>
                  <select class="custom-select rounded-0" id="constrain_category" name="constrain_category">
                    <?php foreach($constrain_categories as $cc) : ?>
                    <option value="<?= $cc->constrain_category_id ?>" <?= $activities['constrain_category_id'] == $cc->constrain_category_id ? 'selected' : '' ?> ><?= $cc->constrain_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain">Kendala</label>
                  <input type="text" class="form-control rounded-0" id="constrain" name="constrain" value="<?= $activities['constrain'] ?>" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="constrain_description">Deskripsi Kendala</label>
                  <textarea class="form-control" rows="3" id="constrain_description" name="constrain_description" placeholder="Enter ..."><?= $activities['constrain_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['user_img'] ?>" alt="User Photo">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Ubah Foto</label>
                  <div class="row">
                    <div class="col">
                      <div class="custom-file">
                        <label class="custom-file-label" for="user_img">Pilih Berkas User</label>
                        <input type="file" class="custom-file-input" id="user_img" name="user_img">
                      </div>
                    </div>
                  </div>
                </div>
                <a href="<?= base_url('user/activity/') ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection