@extends('layouts.app.user')
@section('title', 'Detail Pembayaran')

@section('content')
            <div class="row mb-2">
              <div class="col">
               <div class="d-flex pb-0">
                <p class="mb-0">Transaksi Id :</p>
                <!-- <p class="mx-1 mb-0"><?= $activities['activity_id'] ?></p> -->
                <p class="mx-1 mb-0">5</p>
               </div> 
               <!-- <p class="mb-2"><?= $activities['status'] ?></p> -->
               <p class="mb-2">on qeueu</p>
              </div>
              <div class="col">
                <div class="d-flex justify-content-end">
                  <!-- <p class="text-end"><?= $activities['email'] ?></p> -->
                   <div>
                    <p class="text-end mb-0">username</p>
                    <p class="text-end mb-0">user@email.com</p>
                   </div>
                </div>
              </div>
            </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="col-8">Deskripsi</th>
                      <th class="col-4">Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <!-- <td>982</td>
                      <td>Rocky Doe</td>
                      <td>11-7-2014</td> -->
                      <td class="col-8">Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      <td class="col-4">Rp. 8000</td>
                    </tr>
                  </tbody>
                </table>
                <tfoot>
                  <div class="d-flex flex-row mt-3">
                    <div class="col-7">
                      <p style="font-size:11px;">Keterangan: Harga Sudah Termasuk Pajak</p>
                    </div>
                    <div class="col-5">
                      <div>
                        <p style="font-size:11px">Total :</p>
                        <p></p>
                      </div>
                      <div>
                        <p style="font-size:11px">Diskon :</p>
                        <p></p>
                      </div>
                      <div>
                        <p style="font-size:11px">PPh :</p>
                        <p></p>
                      </div>
                      <div>
                        <p style="font-size:11px">Total Keseluruhan :</p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </tfoot>
              </div>
              <!-- /.card-body -->
            </div>
            <a href="<?= base_url('user/dashboard/index') ?>" class="btn btn btn-primary">Kembali</a> 
            <!-- /.card -->
          </div>
        </div>
@endsection