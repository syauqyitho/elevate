@extends('layouts.app.tech')

@section('title', 'Detail Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Transaksi Jasa</a></li>
                  <li class="nav-item"><a class="nav-link" href="#list-tech" data-toggle="tab">List Teknisi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tech-detail" data-toggle="tab">Teknisi Detail</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="form-group">
                      <label for="created_at">Waktu Laporan</label>
                      <input type="text" class="form-control rounded-0" id="created_at" placeholder="Waktu Keluhan" value="<?= $activities['created_at'] ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="custom-select rounded-0" id="status" name="status" disabled>
                        <?php foreach($activity_status as $ast) : ?>
                        <option value="<?= $ast->activity_status_id ?>" <?= $activities['activity_status_id'] == $ast->activity_status_id ? 'selected' : '' ?> ><?= $ast->activity_status_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="name">Nama Pengorder</label>
                      <select class="custom-select rounded-0" id="name" name="name" disabled>
                        <?php foreach($users as $usr) : ?>
                        <option value="<?= $usr->user_id ?>" <?= $activities['user_id'] == $usr->user_id ? 'selected' : '' ?> ><?= $usr->name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="branch_name">Cabang</label>
                      <input type="text" class="form-control rounded-0" id="branch_name" placeholder="Cabang" value="<?= $activities['branch_name'] ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <input type="text" class="form-control rounded-0" id="address" placeholder="Alamat" value="<?= $activities['address'] ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="department">Departemen</label>
                      <input type="text" class="form-control rounded-0" id="department" placeholder="Departemen" value="<?= $activities['department'] ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="urgency">Urgency</label>
                      <select class="custom-select rounded-0" id="urgency" name="urgency" disabled>
                        <?php foreach($urgencies as $urg) : ?>
                        <option value="<?= $urg->urgency_id ?>" <?= $activities['urgency_id'] == $urg->urgency_id ? 'selected' : '' ?> ><?= $urg->urgency_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="activity_category">Kategori Jasa</label>
                      <select class="custom-select rounded-0" id="activity_category" name="activity_category" disabled>
                        <?php foreach($activity_categories as $ac) : ?>
                        <option value="<?= $ac->activity_category_id ?>" <?= $activities['activity_category_id'] == $ac->activity_category_id ? 'selected' : '' ?> ><?= $ac->activity_category_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="constrain_category">Kategori Kendala</label>
                      <select class="custom-select rounded-0" id="constrain_category" name="constrain_category" disabled>
                        <?php foreach($constrain_categories as $cc) : ?>
                        <option value="<?= $cc->constrain_category_id ?>" <?= $activities['constrain_category_id'] == $cc->constrain_category_id ? 'selected' : '' ?> ><?= $cc->constrain_category_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="constrain">Kendala</label>
                      <input type="text" class="form-control rounded-0" id="constrain" name="constrain" value="<?= $activities['constrain'] ?>" placeholder="Kendala" disabled>
                    </div>
                    <div class="form-group">
                      <label for="constrain_description">Deskripsi Kendala</label>
                      <textarea class="form-control" rows="3" id="constrain_description" name="constrain_description" placeholder="Enter ..." disabled><?= $activities['constrain_description'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Lampiran Foto</label>
                      <div class="row">
                        <div class="col">
                          <img class="img-fluid" src="<?= base_url('uploads/').$activities['img'] ?>" alt="User Photo">
                        </div>
                      </div>
                    </div>
                    <a href="<?= base_url('tech/activity/') ?>" class="btn btn-primary">Kembali</a>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="list-tech">
                    <div class="card" style="height: 65vh">
                      <div class="card-header">
                        <a href="<?= base_url('tech/activity_tech/add/'.$activities['activity_id']) ?>" class="card-tools btn btn-success"><i class="fas fa-plus mx-1"></i>Tambah Teknisi</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" >
                        <table class="table table-head-fixed text-nowrap">
                          <tbody>
                            <?php $no=1; foreach ($list_tech as $lt) : ?>
                              <tr>
                                <td class="col">
                                  <p><?= $lt->name ?></p>
                                </td>
                                <td class="align-middle">
                                  <div>
                                    <a href="<?= base_url('tech/activity_tech/delete/'.$lt->activity_tech_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                  </div>
                                </td>
                              </tr>
                            <?php  endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tech-detail">
                    <div class="card" style="height: 65vh">
                      <div class="card-header">
                        <a href="<?= base_url('tech/activity_detail/add/'.$activities['activity_id']) ?>" class="card-tools btn btn-success"><i class="fas fa-plus mx-1"></i>Teknisi Detail</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" >
                        <table class="table table-head-fixed text-nowrap">
                          <tbody>
                            <?php $no=1; foreach ($activity_details as $ad) : ?>
                              <tr>
                                <td class="col">
                                  <div class="d-flex flex-column">
                                    <p><?= $ad->action_description ?></p>
                                    <p><?= $ad->created_at ?></p>
                                  </div>
                                </td>
                                <td class="align-middle"><?= $ad->level_name ?></td>
                                <td class="align-middle"><p class="btn btn-sm btn-success"><?= $ad->name ?></p></td>
                                <td class="align-middle">
                                    <a href="<?= base_url('tech/activity_detail/edit/'.$ad->activity_detail_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="<?= base_url('tech/activity_detail/delete/'.$ad->activity_detail_id) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                              </tr>
                            <?php  endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection