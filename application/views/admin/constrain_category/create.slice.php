@extends('layouts.app.admin')

@section('title', 'Tambah Kategori Kendala')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kategori Kendala</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= form_open('constrain/store/admin') ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="constrain_category_name">Kategori Kendala</label>
                    <input type="text" class="form-control" id="constrain_category_name" name="constrain_category_name" placeholder="Kategori Kendala">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('constrain/admin') ?>" class="btn btn-primary">Kembali</a>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
@endsection