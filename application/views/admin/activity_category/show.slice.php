@extends('layouts.app.admin')

@section('title', 'Edit kategori Jasa')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kategori Jasa</h3>
              </div>
              <?= form_open('activity/category/update/admin/'.$activity_categories['activity_category_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="activity_category_name">Kategori Jasa</label>
                    <input type="text" class="form-control" id="activity_category_name" name="activity_category_name" placeholder="Kategori Jasa" value="<?= $activity_categories['activity_category_name'] ?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('activity/category/admin') ?>" class="btn btn-primary">Kembali</a>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection