@extends('layouts.app.admin')

@section('title', 'Tambah Cabang')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- <div class="card-header">
                <h3 class="card-title">Tambah Badan Usaha</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open_multipart('admin/company_branch/add') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="group_of_entities">Kelompok Badan Usaha</label>
                    <select class="custom-select rounded-0" id="group_of_entities" name="group_of_entity">
                      <?php foreach($group_of_entities as $goe) : ?>
                      <option value="<?= $goe->group_of_entity_id ?>"><?= $goe->group_of_entity_name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="branch_name">Nama Cabang</label>
                    <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Nama Cabang">
                  </div>
                  <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor Telepon">
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat Cabang</label>
                    <textarea class="form-control" rows="3" id="address" name="address" placeholder="Enter ..."></textarea>
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