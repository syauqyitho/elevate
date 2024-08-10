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
              <?= form_open('admin/enterprise/add') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise_name">Nama Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_name" name="enterprise_name" placeholder="Nama Badan Usaha">
                  </div>
                  <div class="form-group">
                    <label for="status_name">Status</label>
                    <select class="custom-select rounded-0" id="status_name" name="status">
                      <?php foreach($enterprise_status as $ent) : ?>
                      <option value="<?= $ent->enterprise_status_id ?>"><?= $ent->enterprise_status_name ?></option>
                      <?php endforeach ?>
                    </select>
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