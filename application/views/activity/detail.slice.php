@extends('layouts.app.user')

@section('title', 'Detail Teknisi')

@section('content')
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Transaksi Jasa</h3>
              </div>
              <div class="card-body">
                <?= form_open_multipart('user/activity/edit/'.$activity_details['activity_id']) ?>
                <div class="form-group">
                  <label for="name">Nama Teknisi</label>
                  <select class="custom-select rounded-0" id="name" name="name" disabled>
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>" <?= $activity_details['user_id'] == $usr->user_id ? 'selected' : '' ?> ><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="analyze">Analisa</label>
                  <input type="text" class="form-control rounded-0" id="analyze" placeholder="Analisa" value="<?= $activity_details['analyze'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="action_description">Deskripsi Tindakan</label>
                  <textarea class="form-control" rows="3" id="action_description" name="action_description" placeholder="Enter ..." disabled><?= $activity_details['action_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <input type="text" class="form-control rounded-0" id="level" name="level" value="<?= $activity_details['level'] ?>" placeholder="Level" disabled>
                </div>
                <div class="form-group">
                  <label for="urgency">Urgency</label>
                  <input type="text" class="form-control rounded-0" id="urgency" name="urgency" value="<?= $activity_details['level'] ?>" placeholder="urgency" disabled>
                </div>
                <div class="form-group">
                  <label for="troubelshooting">Troubleshooting</label>
                  <textarea class="form-control" rows="3" id="troubleshooting" name="troubleshooting" placeholder="Enter ..." disabled><?= $activity_details['troubleshooting'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activity_details['img'] ?>" alt="Tech Photo">
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