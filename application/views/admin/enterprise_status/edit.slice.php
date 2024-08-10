@extends('layouts.app.admin')

@section('title', 'Edit Status Badan Usaha')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <?= form_open('admin/enterprise_status/edit/'.$enterprise_status['enterprise_status_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="enterprise_status">Status Badan Usaha</label>
                    <input type="text" class="form-control" id="enterprise_status" name="status" placeholder="Status Badan Usaha" value="<?= $enterprise_status['enterprise_status_name'] ?>">
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