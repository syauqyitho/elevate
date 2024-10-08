@extends('layouts.app.admin')

@section('title', 'Tambah Kategori Jasa')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kategori Jasa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('activity/category/store/admin') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="activity_category_name">Kategori Jasa</label>
                    <input type="text" class="form-control" id="activity_category_name" name="activity_category_name" placeholder="Kategori Jasa">
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