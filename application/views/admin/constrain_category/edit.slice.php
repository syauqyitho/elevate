@extends('layouts.app.admin')

@section('title', 'Edit kategori Kendala')

@section('content')
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <?= form_open('admin/constrain_category/edit/'.$constrain_categories['constrain_category_id']) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="constrain_category_name">Kategori Kendala</label>
                    <input type="text" class="form-control" id="constrain_category_name" name="constrain_category_name" placeholder="Kategori Kendala" value="<?= $constrain_categories['constrain_category_name'] ?>">
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