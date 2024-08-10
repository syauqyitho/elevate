@extends('layouts.app.admin')

@section('title', 'Tambah Badan Usaha')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- <div class="card-header">
                <h3 class="card-title">Tambah Badan Usaha</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('admin/group_of_entity/edit/'.$group_of_entities['group_of_entity_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise">Nama Badan Usaha</label>
                    <select class="custom-select rounded-0" id="enterprise" name="enterprise">
                      <?php foreach($enterprises as $ent) : ?>
                      <option value="<?= $ent->enterprise_id ?>" <?= $group_of_entities['enterprise_id'] == $ent->enterprise_id ? 'selected' : '' ?> ><?= $ent->enterprise_name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Kelompok Badan Usaha</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kelompok Badan Usaha" value="<?= $group_of_entities['group_of_entity_name'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="npwp_number">Nomor NPWP</label>
                    <input type="text" class="form-control" id="npwp_number" name="npwp_number" placeholder="npwp_number" value="<?= $group_of_entities['npwp_number'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="npwp_img">Lampiran Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <label class="custom-file-label" for="npwp_img">Pilih Berkdas</label>
                        <input type="file" class="custom-file-input" id="npwp_img" name="img">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection