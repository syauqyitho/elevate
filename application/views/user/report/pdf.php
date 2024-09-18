<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      table {
        width: 100%;
        /* border: 1px solid #000; */
        border-spacing: 0;
      }
      table tr:first-child th,
      table tr:first-child td {
        border-top: 1px solid #2A2D34;
      }
      table tr th,
      table tr td {
        border-left: 1px solid #2A2D34;
      }
      table tr th,
      table tr td {
        border-right: 1px solid #2A2D34;
        border-bottom: 1px solid #2A2D34;
      }
    </style>
</head>
<body>
  <h1>Laporan</h1>
    <table class="table table-hover table-head-fixed text-nowrap">
      <thead style="background-color:#2A2D34;color:#FFF">
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
          <tr class="bg-olive" style="background-color:#88A2AA">
            <td>
              <span><?= $no++ ?></span>
            </td>
            <td style="width:10rem">
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
            <td style="max-width:7rem">
              <span><?= $activity['constrain'] ?></span>
            </td>
            <td>
              <div class="d-flex text-wrap" style="width:10rem;">
                <p class="mb-0"><?= $activity['constrain_description'] ?></p>
              </div>
            </td>
          </tr>
          <tr class="table">
            <tr style="background-color:#2A2D34;color:#FFF">
              <th></th>
              <th colspan="2">Detail Jasa</th>
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
            <?php $sec=1; foreach ($activity['details'] as $detail) : ?>
              <tr>
                <td>
                 <span><?= $sec++ ?></span>
                </td>
                <td>
                 <span><?= $detail['tech_name'] ?></span>
                </td>
                <td>
                 <span><?= $detail['level'] ?></span>
                </td>
                <td>
                  <div class="d-flex text-wrap" style="width:10rem; max-width:55rem">
                    <p class="mb-0"><?= $detail['analyze'] ?></p>
                  </div>
                </td>
                <td>
                  <div class="d-flex text-wrap" style="width:10rem; max-width:55rem">
                    <p class="mb-0"><?= $detail['action_description'] ?>
                  </div>
                </td>
                <td>
                  <div class="d-flex text-wrap" style="width:10rem; max-width:55rem">
                    <p class="mb-0"><?= $detail['troubleshooting'] ?></p>
                  </div>
                </td>
                <td>
                  <div class="d-flex text-wrap" style="max-width:10rem">
                    <p class="mb-0"><?= $detail['reason'] ?></p>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tr>
        <?php  endforeach ?>
      </tbody>
    </table>
</body>
</html>