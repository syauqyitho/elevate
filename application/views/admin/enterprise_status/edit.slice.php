@extends('layouts.app.admin')

@section('title', 'Edit Status Badan Usaha')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Status Badan Usaha</h3>
              </div>
              <?= form_open('admin/enterprise_status/edit/'.$enterprise_status['enterprise_status_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise_status">Status Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_status" name="status" placeholder="Status Badan Usaha" value="<?= $enterprise_status['enterprise_status_name'] ?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('admin/enterprise_status/') ?>" class="btn btn-primary">Kembali</a>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection