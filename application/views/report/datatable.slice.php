@extends('layouts.app.user')

@section('title', 'Laporan Transaksi Jasa')

@section('addon-style')
<style>
  .constrain-description {
      width: 33rem; /* Maximum width for column */
      word-wrap: break-word; /* Allow long words to break and wrap onto the next line */
  }
</style>
@endsection

@section('content')
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-hover display nowrap" width="100%">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection

@section('addon-script')
<!-- DataTable -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>

<!-- Page specific script -->
<script>
        $(document).ready(function() {
            var dataSet = <?php echo json_encode($activity_grouped); ?>;

            var table = $('#example').DataTable({
                data: dataSet,
                scrollX: true, // Enable horizontal scrolling
                columns: [
                    { data: 'created_at', title: 'Created At' },
                    { data: 'user_name', title: 'User Name' },
                    { data: 'status', title: 'Status' },
                    // { data: 'activity_category', title: 'Activity Category' },
                    // { data: 'constrain_category', title: 'Constrain Category' },
                    { data: 'urgency', title: 'Urgency' },
                    { data: 'constrain', title: 'Constrain' },
                    {
                        data: 'constrain_description',
                        title: 'Constrain Description',
                        className: 'constrain-description', // Apply the class for styling
                    }
                ],
                columnDefs: [
                    {
                        targets: -1, // Last column for details
                        orderable: false, // Disable ordering for details column
                        className: 'dt-body-nowrap'
                    }
                ],
                 drawCallback: function(settings) {
                    // Create and show details rows for each main row
                    var api = this.api();
                    api.rows().every(function() {
                        var row = this.node();
                        var rowData = this.data();

                        // Check if a details row already exists for this main row
                        var detailsRow = $(row).next('.details-row');
                        if (!detailsRow.length) {
                            // Create a new details row and append it
                            var details = JSON.parse(rowData.details);
                            var detailsHtml = '<tr class="details-row table">';
                            // detailsHtml += '<td colspan="9">'; // Adjust colspan to match the number of columns
                            // detailsHtml += '<table style="width: 100%;">'; // Inner table for details
                            detailsHtml += '<table>'; // Inner table for details
                            detailsHtml += '<tr><th>Tech Name</th><th>Action Description</th><th>Level</th><th>Analyze</th><th>Troubleshooting</th><th>Reason</th></tr>';

                            for (var i = 0; i < details.length; i++) {
                                detailsHtml += '<tr>' +
                                                '<td>' + details[i].tech_name + '</td>' +
                                                '<td><div class="d-flex text-wrap" style="width:33rem;max-width:55rem"><p class="m-0">' + details[i].action_description + '</p></div></td>' +
                                                '<td>' + details[i].level + '</td>' +
                                                '<td><div class="d-flex text-wrap" style="width:33rem;max-width:55rem"><p class="m-0">' + details[i].analyze + '</p></div></td>' +
                                                '<td><div class="d-flex text-wrap" style="width:33rem;max-width:55rem"><p class="m-0">' + details[i].troubleshooting + '</p></div></td>' +
                                                '<td><div class="d-flex text-wrap" style="width:33rem;max-width:55rem"><p class="m-0">' + details[i].reason + '</p></div></td>' +
                                                '<td style="width:33rem">' + details[i].analyze + '</td>' +
                                                '<td style="width:33rem">' + details[i].troubleshooting + '</td>' +
                                                '<td style="width:33rem">' + details[i].reason + '</td>' +
                                                '</tr>';
                            }

                            detailsHtml += '</table></td></tr>';
                            // detailsHtml += '</td></tr>';
                            $(row).after(detailsHtml);
                        }
                    });
                }

                // drawCallback: function(settings) {
                //     // Create and show details rows for each main row
                //     var api = this.api();
                //     api.rows().every(function() {
                //         var row = this.node();
                //         var rowData = this.data();

                //         // Check if a details row already exists for this main row
                //         var detailsRow = $(row).next('.details-row');
                //         if (!detailsRow.length) {
                //             // Create a new details row and append it
                //             var details = JSON.parse(rowData.details);
                //             var detailsHtml = '<tr class="details-row"><td colspan="9">'; // Adjust colspan to match the number of columns
                //             detailsHtml += '<div class="details-content">';
                //             for (var i = 0; i < details.length; i++) {
                //                 detailsHtml += '<p>' +
                //                                 'Tech Name: ' + details[i].tech_name + '<br>' +
                //                                 'Action Description: ' + details[i].action_description + '<br>' +
                //                                 // Add other fields as needed
                //                                 '</p>';
                //             }
                //             detailsHtml += '</div></td></tr>';
                //             $(row).after(detailsHtml);
                //         }
                //     });
                // }
            });
        });
    </script>
    
<script>
// $(document).ready(function() {
//     // Define your dataset here
//     var dataSet = <?php echo json_encode($activity_grouped); ?>;
    
//     // console.log(dataSet);

//     $('#example').DataTable({
//         data: dataSet,
//         columns: [
//             { data: 'user_name', title: 'User Name' },
//             { data: 'status', title: 'Status' },
//             { data: 'activity_category', title: 'Activity Category' },
//             { data: 'constrain_category', title: 'Constrain Category' },
//             { data: 'urgency', title: 'Urgency' },
//             { data: 'constrain', title: 'Constrain' },
//             { data: 'constrain_description', title: 'Constrain Description' },
//             { data: 'created_at', title: 'Created At' },
//             {
//                 data: 'details',
//                 title: 'Details',
//                 render: function(data, type, row) {
//                     // Parse JSON and render in a way that's appropriate for your view
//                     var details = JSON.parse(data);
//                     var detailsHtml = '<ul>';
//                     for (var i = 0; i < details.length; i++) {
//                         detailsHtml += '<li>' +
//                                         'Tech Name: ' + details[i].tech_name + '<br>' +
//                                         'Action Description: ' + details[i].action_description + '<br>' +
//                                         // Add other fields as needed
//                                         '</li>';
//                     }
//                     detailsHtml += '</ul>';
//                     return detailsHtml;
//                 },
//                 className: 'details-control'
//             }
//         ],
//         columnDefs: [
//             {
//                 targets: -1, // Last column for details
//                 orderable: false, // Disable ordering for details column
//                 className: 'dt-body-nowrap'
//             }
//         ]
//     });
// });
// $(document).ready(function() {
//     var table = $('#example').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "ajax": {
//             // "url": "<?php echo site_url('your_controller/datatable'); ?>",
//             "url": "<?php echo site_url('user/report/datatable/'); ?>",
//             "type": "POST"
//         },
//         "columns": [
//             { "data": "user_name" },
//             { "data": "status" },
//             { "data": "activity_category" },
//             { "data": "constrain_category" },
//             { "data": "urgency" },
//             { "data": "constrain" },
//             { "data": "constrain_description" },
//             { "data": "created_at" }
//         ],
//         "rowCallback": function(row, data, index) {
//             var details = JSON.parse(data.details);
//             var detailRows = [];
            
//             details.forEach(function(detail) {
//                 detailRows.push('<tr><td colspan="8">'); // Adjust colspan based on number of columns
//                 detailRows.push('Tech Name: ' + detail.tech_name + '<br>');
//                 detailRows.push('Activity Tech ID: ' + detail.activity_tech_id + '<br>');
//                 detailRows.push('Action Description: ' + detail.action_description + '<br>');
//                 detailRows.push('Level: ' + detail.level + '<br>');
//                 detailRows.push('Analyze: ' + detail.analyze + '<br>');
//                 detailRows.push('Troubleshooting: ' + detail.troubleshooting + '<br>');
//                 detailRows.push('Reason: ' + detail.reason + '<br>');
//                 detailRows.push('</td></tr>');
//             });
            
//             $(row).after(detailRows.join(''));
//         }
//     });
// });

    // $(document).ready(function() {
    //     var table = $('#example').DataTable({
    //         "ajax": {
    //             "url": "<?php echo site_url('your_controller/datatable'); ?>",
    //             "type": "POST"
    //         },
    //         "columns": [
    //             { "data": "no" },
    //             { "data": "created_at" },
    //             { "data": "user_name" },
    //             { "data": "status" },
    //             { "data": "urgency" },
    //             { "data": "constrain" },
    //             { "data": "constrain_description" },
    //             { "data": "details", "render": function(data, type, row) {
    //                 return '<button class="btn btn-info">View Details</button>';
    //             }}
    //         ]
    //     });

    //     // Add event listener for opening and closing details
    //     $('#example tbody').on('click', 'button', function () {
    //         var tr = $(this).closest('tr');
    //         var row = table.row(tr);

    //         if (row.child.isShown()) {
    //             // This row is already open - close it
    //             row.child.hide();
    //             tr.removeClass('shown');
    //         }
    //         else {
    //             // Open this row
    //             row.child(format(row.data())).show();
    //             tr.addClass('shown');
    //         }
    //     });

    //     // Format function for row details
    //     function format(d) {
    //         // `d` is the original data object for the row
    //         var details = JSON.parse(d.details);
    //         var detailsHtml = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    //         detailsHtml += '<thead><tr>'+
    //             '<th>No</th>'+
    //             '<th>Nama Teknisi</th>'+
    //             '<th>Level</th>'+
    //             '<th>Analisa</th>'+
    //             '<th>Deskripsi Tindakan</th>'+
    //             '<th>Troubleshooting</th>'+
    //             '<th>Alasan</th>'+
    //             '</tr></thead><tbody>';
    //         $.each(details, function(index, detail) {
    //             detailsHtml += '<tr>'+
    //                 '<td>' + (index + 1) + '</td>'+
    //                 '<td>' + detail.tech_name + '</td>'+
    //                 '<td>' + detail.level + '</td>'+
    //                 '<td>' + detail.analyze + '</td>'+
    //                 '<td>' + detail.action_description + '</td>'+
    //                 '<td>' + detail.troubleshooting + '</td>'+
    //                 '<td>' + detail.reason + '</td>'+
    //                 '</tr>';
    //         });
    //         detailsHtml += '</tbody></table>';
    //         return detailsHtml;
    //     }
    // });
</script>
@endsection