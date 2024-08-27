@extends('layouts.login')
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?=  base_url('auth/login/') ?>" class="h1 fst-italic"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?= $this->session->set_flashdata('message'); ?>
      <?= form_open('auth/login/') ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" value="<?= set_value('password') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection