@extends('layouts.app.admin')

@section('title', 'Edit kategori Jasa')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <?= form_open('admin/activity_category/edit/'.$activity_categories['activity_category_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="activity_category_name">Kategori Jasa</label>
                    <input type="text" class="form-control" id="activity_category_name" name="activity_category_name" placeholder="Kategori Jasa" value="<?= $activity_categories['activity_category_name'] ?>">
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