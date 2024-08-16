@extends('layouts.app.user')
<!-- @section('title', 'Tambah Transaksi Jasa') -->

@section('content')
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Jasa</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <?= form_open_multipart('user/activity/add') ?>
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
                  <select class="custom-select rounded-0" id="constrain_category" nama="constrain_category">
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
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="img">Pilih Berkdas</label>
                      <input type="file" class="custom-file-input" id="img" name="img">
                    </div>
                    <!-- <div class="input-group-append">
                      <span class="input-group-text">UForopload</span>
                    </div> -->
                  </div>
                </div>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection