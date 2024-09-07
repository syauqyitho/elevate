@extends('layouts.app.user')

@section('title', 'List Transaksi Jasa')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card card-primary" style="height:67vh">
              <div class="card-header align-middle">
                <h2 class="card-title">Riwayat Transaksi Jasa</h2>

                <div class="card-tools">
                  <?= form_open('user/activity/history/') ?>
                    <div class="d-flex flex-wrap flex-md-nowrap">
                      <input type="date" class="form-control" name="start_date" value="<?= date('Y-m-d') ?>">
                      <input type="date" class="form-control mx-2"name="end_date" value="<?= date('Y-m-d') ?>">
                      <button class="btn btn-success" type="submit" name="submit">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-hover table-head-fixed">
                  <tbody>
                    <!-- List Activity -->
                    <?php $no=1; foreach ($activity_grouped as $activity_id => $activity) : ?>
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <div class="d-flex justify-item-center">
                          <td class="align-middle">
                            <p class=""><?= $activity['constrain'] ?></p>
                            <p class="mb-0"><?= $activity['created_at'] ?></p>
                          </td>
                          <td class="align-middle">
                            <span class="mb-0"><?= $activity['user_name'] ?></span>
                          </td>
                          <td class="align-middle">
                            <span class="mb-0"><?= $activity['urgency'] ?></span>
                          </td>
                          <td class="align-middle fs-1">
                            <apsn class="badge bg-info mb-0"><?= $activity['status'] ?></apsn>
                          </td>
                          <!-- <td class="align-middle"><?= $activity['status'] ?></td> -->
                          <td class="align-middle">
                            <div class="d-flex justify-content-end">
                              <a href="<?= base_url('user/activity/edit/'.$activity_id) ?>" class="btn btn-sm btn-primary">Detail</a>
                            </div>
                          </td>
                          
                        </div>
                      </tr>
                      <!-- List Detail Activity -->
                      <tr class="expandable-body">
                        <td colspan="5">
                          <table class="table">
                          <?php foreach ($activity['details'] as $detail) : ?>
                            <tr>
                              <td class="col">
                                <div class="d-flex flex-column">
                                  <p><?= $detail['tech_name'] ?></p>
                                  <p><?= $detail['level'] ?></p>
                                </div>
                              </td>
                              <td class="align-middle"><?= $detail['analyze'] ?></td>
                              <td class="align-middle">
                                  <a href="<?= base_url('user/activity_detail/detail/'.$detail['activity_detail_id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                              </td>
                            </tr>
                          <?php endforeach ?>
                          </table>
                        </td>
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