@extends('layouts.app.admin')

@section('title', 'Edit Pengguna')

@section('content')
          <div class="col">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pengguna</h3>
              </div>
              <div class="card-body">
                <?= form_open_multipart('admin/user/edit/'.$users['user_id']) ?>
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control rounded-0" id="name" name="name" value="<?= $users['name'] ?>" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="custom-select rounded-0" id="role" name="role">
                    <?php foreach($roles as $rl) : ?>
                    <option value="<?= $rl->role_id ?>" <?= $users['role_id'] == $rl->role_id ? 'selected' : '' ?> ><?= $rl->role_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="phone_number">No. Telepon</label>
                  <input type="text" class="form-control rounded-0" id="phone_number" name="phone_number" value="<?= $users['phone_number'] ?>" placeholder="No. Telepon">
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea class="form-control" rows="3" id="address" name="address" placeholder="Enter ..."><?= $users['address'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="department">Departement</label>
                  <input type="text" class="form-control rounded-0" id="department" name="department" value="<?= $users['department'] ?>" placeholder="Departement">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control rounded-0" id="email" name="email" value="<?= $users['email'] ?>" placeholder="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$users['img'] ?>" alt="User Photo">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Ubah Foto</label>
                  <div class="row">
                    <div class="col">
                      <div class="custom-file">
                        <label class="custom-file-label" for="img">Pilih Foto</label>
                        <input type="file" class="custom-file-input" id="img" name="img">
                      </div>
                    </div>
                  </div>
                </div>
                <a href="<?= base_url('admin/user/') ?>" class="btn btn-primary">Kembali</a>
                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
@endsection