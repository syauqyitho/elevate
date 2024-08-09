@extends('layouts.app.admin')
@section('content')
<p>Add data</p>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Badan Usaha</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('admin/enterprise/save') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_name" name="enterprise_name" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="Password">
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