@extends('layouts.app.tech')

@section('title', 'Transaksi Jasa')

@section('content')
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaksi Jasa</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <?= form_open('tech/activity_tech/add/'.$activities['activity_id']) ?>
                <div class="form-group">
                  <label for="name">Nama Teknisi</label>
                  <select class="custom-select rounded-0" id="name" name="name">
                    <?php foreach($users as $usr) : ?>
                    <option value="<?= $usr->user_id ?>"><?= $usr->name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <a href="<?= base_url('tech/activity/edit/'.$activities['activity_id']) ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection