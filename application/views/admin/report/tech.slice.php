@extends('layouts.app.admin')

@section('title', 'laporan Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary" style="height:67vh">
              <div class="card-header align-middle">
                <h2 class="card-title">Teknisi Transaksi Jasa</h2>

                <div class="card-tools col-md-8">
                  <?= form_open('admin/report/tech/') ?>
                    <div class="d-flex flex-wrap flex-md-nowrap">
                      <select class="custom-select rounded-0 col" name="name">
                        <?php foreach($users as $user) : ?>
                        <option value="<?= $user->user_id ?>"><?= $user->name ?></option>
                        <?php endforeach ?>
                      </select>
                      <input type="date" class="form-control col mx-1" name="start_date" value="<?= date('Y-m-d') ?>">
                      <input type="date" class="form-control col" name="end_date" value="<?= date('Y-m-d') ?>">
                      <div class="btn-group mx-1">
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="<?= base_url('admin/report/tech_pdf') ?>">PDF</a>
                          <!-- <a class="dropdown-item" href="<?= base_url('user/report/excel/') ?>">Another action</a> -->
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-hover table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Laporan</th>
                      <th>Nama Pelapor</th>
                      <th>Status</th>
                      <th>Urgency</th>
                      <th>kendala</th>
                      <th>Deskripsi Kendala</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- List Activity -->
                    <?php $no=1; foreach ($activity_grouped as $activity_id => $activity) : ?>
                      <tr class="bg-olive">
                        <td>
                          <span><?= $no++ ?></span>
                        </td>
                        <td>
                          <span><?= $activity['created_at'] ?></span>
                        </td>
                        <td>
                          <span><?= $activity['user_name'] ?></span>
                        </td>
                        <td>
                          <span><?= $activity['status'] ?></span>
                        </td>
                        <td>
                          <span><?= $activity['urgency'] ?></span>
                        </td>
                        <td>
                          <span><?= $activity['constrain'] ?></span>
                        </td>
                        <td>
                          <div class="d-flex text-wrap" style="width:33rem; max-width:55rem55rem;">
                            <p class="mb-0"><?= $activity['constrain_description'] ?></p>
                          </div>
                        </td>
                      </tr>
                      <tr class="table">
                        <tr>
                          <th></th>
                          <th>Detail Jasa</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>No</th>
                          <th>Nama Teknisi</th>
                          <th>Level</th>
                          <th>Analisa</th>
                          <th>Deskripsi Tindakan</th>
                          <th>Troubleshooting</th>
                          <th>Alasan</th>
                        </tr>
                        @php
                          $sec = 1;
                        @endphp
                        @foreach ($activity['details'] as $detail)
                          <tr>
                            <td>
                             <span>{{ $sec++ }}</span>
                            </td>
                            <td>
                             <span>{{ $detail['tech_name'] }}</span>
                            </td>
                            <td>
                             <span>{{ $detail['level'] }}</span>
                            </td>
                            <td>
                              <div class="d-flex text-wrap" style="width:33rem; max-width:55rem">
                                <p class="mb-0">{{ $detail['analyze'] }}</p>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex text-wrap" style="width:33rem; max-width:55rem">
                                <p class="mb-0">{{ $detail['action_description'] }}</p>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex text-wrap" style="width:33rem; max-width:55rem">
                                <p class="mb-0">{{ $detail['troubleshooting'] }}</p>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex text-wrap" style="max-width:55rem">
                                <p class="mb-0">{{ $detail['reason'] }}</p>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tr>
                    <?php  endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection