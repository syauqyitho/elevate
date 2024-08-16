@extends('layouts.app.admin')
<!-- @section('title', 'Tambah Transaksi Jasa') -->

@section('content')
            <div class="card card-primary">
              <!-- /.card-header -->
              <div class="card-body">
                <?= form_open_multipart('admin/activity/add') ?>
                <!-- <div class="form-group">
                  <label for="created_at">Waktu Kendala</label>
                  <input type="date" class="form-control rounded-0" id="created_at" name="created_at" placeholder="Waktu Keluhan">
                </div> -->
                <div class="form-group">
                  <label for="activity_category">Nama Pengorder</label>
                  <select class="custom-select rounded-0" id="activity_category" name="user_name">
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>"><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="activity_category">Kategori Jasa</label>
                  <select class="custom-select rounded-0" id="activity_category" name="activity_category">
                    <?php foreach($activities as $act) : ?>
                    <option value="<?= $act->activity_category_id ?>"><?= $act->activity_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain_category">Kategori Kendala</label>
                  <select class="custom-select rounded-0" id="constrain_category" name="constrain_category">
                    <?php foreach($constrains as $cons) : ?>
                    <option value="<?= $cons->constrain_category_id ?>"><?= $cons->constrain_category_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="constrain">Kendala</label>
                  <input type="text" class="form-control rounded-0" id="constrain" name="constrain" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="constrain_description">Deskripsi Kendala</label>
                  <textarea class="form-control" rows="3" id="constrain_description" name="constrain_description" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="action_description">Deskripsi Tindakan</label>
                  <textarea class="form-control" rows="3" id="action_description" name="action_description" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <input type="text" class="form-control rounded-0" id="level" name="level" placeholder="Level">
                </div>
                <div class="form-group">
                  <label for="urgency">Urgency</label>
                  <input type="text" class="form-control rounded-0" id="urgency" name="urgency" placeholder="Urgency">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="custom-select rounded-0" id="status" name="activity_status">
                    <?php foreach($activity_status as $ast) : ?>
                    <option value="<?= $ast->activity_status_id ?>"><?= $ast->activity_status_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tech_user">Teknisi</label>
                  <select class="custom-select rounded-0" id="tech_user" name="tech_name">
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>"><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto User</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="img">Pilih Berkdas</label>
                      <input type="file" class="custom-file-input" id="img" name="img">
                    </div>
                  </div>
                </div>
                <a href="<?= base_url('admin/activity/') ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection