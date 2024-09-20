@extends('layouts.app.admin')

@section('title', 'Tambah Status Badan Usaha')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Status Badan Usaha</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('enterprise/status/store/admin') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise_status">Status Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_status" name="status" placeholder="Status Badan Usaha">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?= base_url('enterprise/status/admin') ?>" class="btn btn-primary">Kembali</a>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection