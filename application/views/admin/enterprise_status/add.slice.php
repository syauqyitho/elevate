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
              <?= form_open('admin/enterprise_status/add') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise_status">Status Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_status" name="status" placeholder="Status Badan Usaha">
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