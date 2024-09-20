@extends('layouts.app.admin')
@section('title', 'Tambah Detail Teknisi')

@section('content')
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Jasa</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <?= form_open_multipart('activity/detail/store/admin/'.$activity_details['activity_id']) ?>
                <div class="form-group">
                  <label for="name">Teknisi</label>
                  <select class="custom-select rounded-0" id="name" name="name">
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>" <?= $activity_details['user_id'] == $usr->user_id ? 'selected' : '' ?> ><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="custom-select rounded-0" id="status" name="activity_status">
                    <?php foreach($activity_status as $st) : ?>
                    <option value="<?= $st->activity_status_id ?>" <?= $activity_details['activity_status_id'] == $st->activity_status_id ? 'selected' : '' ?> ><?= $st->activity_status_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="analyze">Analisa</label>
                  <textarea class="form-control" rows="3" id="analyze" name="analyze" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select class="custom-select rounded-0" id="level" name="level">
                    <?php foreach($levels as $lvl) : ?>
                    <option value="<?= $lvl->level_id ?>"><?= $lvl->level_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="action_description">Deskripsi Tindakan</label>
                  <textarea class="form-control" rows="3" id="action_description" name="action_description" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="troubleshooting">Troubleshooting</label>
                  <textarea class="form-control" rows="3" id="troubleshooting" name="troubleshooting" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="reason">Alasan</label>
                  <textarea class="form-control" rows="3" id="reason" name="reason" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="img">Pilih Berkas</label>
                      <input type="file" class="custom-file-input" id="img" name="img">
                    </div>
                    <!-- <div class="input-group-append">
                      <span class="input-group-text">UForopload</span>
                    </div> -->
                  </div>
                </div>
                <a href="<?= base_url('activity/show/admin/'.$activity_details['activity_id']) ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection