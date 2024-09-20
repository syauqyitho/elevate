@extends('layouts.app.admin')

@section('title', 'Ubah Cabang')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cabang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('branch/update/admin/'.$company_branches['company_branch_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="group_of_entities">kelompok Badan Usaha</label>
                    <select class="custom-select rounded-0" id="group_of_entities" name="group_of_entity">
                      <?php foreach($group_of_entities as $goe) : ?>
                      <option value="<?= $goe->group_of_entity_id ?>" <?= $company_branches['group_of_entity_id'] == $goe->group_of_entity_id ? 'selected' : '' ?> ><?= $goe->group_of_entity_name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="branch_name">Cabang</label>
                    <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Nama Cabang" value="<?= $company_branches['branch_name'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor Telepon" value="<?= $company_branches['phone_number'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat Cabang</label>
                    <textarea class="form-control" rows="3" id="address" name="address" placeholder="Enter ..."><?= $company_branches['address'] ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('branch/admin') ?>" class="btn btn-primary">Kembali</a>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection