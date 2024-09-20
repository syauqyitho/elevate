@extends('layouts.app.admin')

@section('title', 'Tambah Pengguna')

@section('content')
          <div class="col">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?= form_open_multipart('user/store/admin') ?>
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control rounded-0" id="name" name="name" placeholder="name">
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="custom-select rounded-0" id="role" name="role">
                    <?php foreach($roles as $rl) : ?>
                    <option value="<?= $rl->role_id ?>"><?= $rl->role_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="phone_number">No. Telepon</label>
                  <input type="text" class="form-control rounded-0" id="phone_number" name="phone_number" placeholder="No. Telepon">
                </div>
                <div class="form-group">
                  <label for="company_branch">Cabang</label>
                  <select class="custom-select rounded-0" id="company_branch" name="company_branch">
                    <?php foreach($company_branchs as $cb) : ?>
                    <option value="<?= $cb->company_branch_id ?>"><?= $cb->branch_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <input type="text" class="form-control rounded-0" id="address" name="address" placeholder="Alamat">
                </div>
                <div class="form-group">
                  <label for="department">Department</label>
                  <input type="text" class="form-control rounded-0" id="department" name="department" placeholder="Departemen">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control rounded-0" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Foto Pengguna</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="img">Pilih Berkas</label>
                      <input type="file" class="custom-file-input" id="img" name="img">
                    </div>
                  </div>
                </div>
                <a href="<?= base_url('user/admin') ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
@endsection