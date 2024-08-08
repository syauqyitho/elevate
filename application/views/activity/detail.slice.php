@extends('layouts.app')

@section('title', 'Detail Transaksi Jasa')

@section('content')
            <div class="row mb-2">
              <div class="col">
               <div class="d-flex pb-0">
                <p class="mb-0">Transaksi Id :</p>
                <p class="mx-1 mb-0"><?= $activities['activity_id'] ?></p>
               </div> 
               <p class="mb-2"><?= $activities['status'] ?></p>
              </div>
              <div class="col">
                <div class="d-flex justify-content-end">
                  <p class="text-end"><?= $activities['email'] ?></p>
                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Transaksi Jasa</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label for="created_at">Waktu Keluhan</label>
                  <input type="text" class="form-control rounded-0" id="created_at" value="<?= $activities['created_at'] ?>" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="activity_category">Kategori Jasa</label>
                  <input type="text" class="form-control rounded-0" id="activity_category" value="<?= $activities['activity_category'] ?>" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="constrain_category">Kategori Kendala</label>
                  <input type="text" class="form-control rounded-0" id="constrain_category" value="<?= $activities['constrain_category'] ?>" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="constrain">Kendala</label>
                  <input type="text" class="form-control rounded-0" id="constrain" value="<?= $activities['constrain'] ?>" placeholder="Kendala">
                </div>
                <div class="form-group">
                  <label for="constrain_description">Deskripsi Kendala</label>
                  <textarea class="form-control" rows="3" id="constrain_description" placeholder="Deskripsi Kendala"><?= $activities['constrain_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="action_description">Deskripsi Tindakan</label>
                  <textarea class="form-control" rows="3" id="action_description" placeholder="Deskripsi Tindakan"><?= $activities['action_description'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" class="form-control rounded-0" id="status" value="<?= $activities['status'] ?>" placeholder="Status">
                </div>
                <div class="form-group">
                  <label for="tech_name">Nama Teknisi</label>
                  <input type="text" class="form-control rounded-0" id="tech_name" value="<?= $activities['tech_name'] ?>" placeholder="Nama Teknisi">
                </div>
                <div class="form-group">
                  <label for="analyze">Analisa</label>
                  <textarea class="form-control" rows="3" id="analyze" placeholder="Analisa"><?= $activities['analyze'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="troubleshooting">Troubleshooting</label>
                  <textarea class="form-control" rows="3" id="troubleshooting" placeholder="Troubleshooting"><?= $activities['troubleshooting'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="updated_at">Waktu Selesai</label>
                  <input type="text" class="form-control rounded-0" id="updated_at" value="<?= $activities['updated_at'] ?>" placeholder="Waktu Selesai">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Lampiran Foto</label>
                  <div class="row">
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['user_img'] ?>" alt="User Photo">
                    </div>
                    <div class="col">
                      <img class="img-fluid" src="<?= base_url('uploads/').$activities['tech_img'] ?>" alt="Technician Photo">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection