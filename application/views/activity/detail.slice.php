@extends('layouts.app.user')

@section('title', 'Detail Transaksi Jasa')

@section('content')
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Jasa</h3>
              </div>
              <div class="card-body">
                <?= form_open_multipart('user/activity/edit/'.$activities['activity_id']) ?>
                <div class="form-group">
                  <label for="created_at">Waktu Kendala</label>
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
                  <label for="action_description">Deskripsi Tindakan</label>
                  <textarea class="form-control" rows="3" id="action_description" name="action_description" placeholder="Enter ..."><?= $activities['action_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" class="form-control rounded-0" id="status" placeholder="Status" value="<?= $activities['activity_status_name'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="tech_name">Nama Teknisi</label>
                  <input type="text" class="form-control rounded-0" id="tech_name" placeholder="Nama Teknisi" value="<?= $activities['tech_name'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="analyze">Analisa</label>
                  <textarea class="form-control" rows="3" id="analyze" name="analyze" placeholder="Enter ..." disabled><?= $activities['analyze'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="troubleshooting">Troubleshooting</label>
                  <textarea class="form-control" rows="3" id="troubleshooting" name="troubleshooting" placeholder="Enter ..." disabled><?= $activities['troubleshooting'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['user_img'] ?>" alt="User Photo">
                    </div>
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['tech_img'] ?>" alt="Technician Photo">
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