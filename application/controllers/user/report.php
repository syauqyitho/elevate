<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->helper('generate_pdf');
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
    }

    public function index() {
        if (isset($_POST['submit'])) {
            $id = $this->session->user_id;
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->user_report($id, $start_date, $end_date);
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }
            
            // var_dump($data);
            // exit();
            $data['activity_grouped'] = $activities;
            $this->slice->view('report.index', $data);
        } else {
            $id = $this->session->user_id;
            // Fetch the data from the model 
            $raw_data = $this->model_activity->user_report($id);
            // Prepare an array to group details by activity_id
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }

            $data['activity_grouped'] = $activities;

            // var_dump($data);
            // exit();
            $this->slice->view('report.index', $data);
        }
    }

    public function check() {
        if (isset($_POST['submit'])) {
            $id = $this->session->user_id;
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->user_report($id, $start_date, $end_date);
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }
            
            // var_dump($data);
            // exit();
            $data['activity_grouped'] = $activities;
            $this->slice->view('report.check', $data);
        } else {
            $id = $this->session->user_id;
            // Fetch the data from the model 
            $raw_data = $this->model_activity->user_report($id);
            // Prepare an array to group details by activity_id
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }

            $data['activity_grouped'] = $activities;

            // var_dump($data);
            // exit();
            $this->slice->view('report.check', $data);
        }
    }

    public function pdf() {
        $id = $this->session->user_id;
        // Fetch the data from the model 
        $raw_data = $this->model_activity->user_report($id);
        // Prepare an array to group details by activity_id
        $activities = [];

        // Group details by jasa_id
        foreach ($raw_data as $row) {
            $activity_id = $row['activity_id'];

            // Initialize activity if not already present
            if (!isset($activities[$activity_id])) {
                $activities[$activity_id] = [
                    'user_name' => $row['user_name'],
                    'status' => $row['status'],
                    'activity_category' => $row['activity_category'],
                    'constrain_category' => $row['constrain_category'],
                    'urgency' => $row['urgency'],
                    'constrain' => $row['constrain'],
                    'constrain_description' => $row['constrain_description'],
                    'created_at' => $row['created_at'],
                    'details' => [] // Initialize details array
                ];
            }
            
            // Check if detail already exists before adding
            $detail_exists = false;
            foreach ($activities[$activity_id]['details'] as $existing_detail) {
                if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                    $detail_exists = true;
                    break;
                }
            }

            // Add the detail to the activity if it doesn't already exist
            if (!$detail_exists) {
                $activities[$activity_id]['details'][] = [
                    'activity_detail_id' => $row['activity_detail_id'],
                    'tech_name' => $row['tech_name'],
                    'activity_tech_id' => $row['activity_tech_id'],
                    'action_description' => $row['action_description'],
                    'level' => $row['level'],
                    'analyze' => $row['analyze'],
                    'troubleshooting' => $row['troubleshooting'],
                    'reason' => $row['reason']
                ];
            }
        }

        $data['activity_grouped'] = $activities;

        // var_dump($data);
        // exit();
        $html = $this->load->view('report/pdf', $data, true);
        generate_pdf($html, 'laporan_jasa_user', 'A4', 'landscape');
        // $this->load->view('report/pdf', $data);
        
        // $paper_size = 'A4';
        // $orientation = 'landscape';
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);
        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        //     $this->dompdf->stream("laporan_jasa_user", array('Attachment' => 0));
    }

    // public function datatable() {
    //     if (isset($_POST['submit'])) {
    //         $id = $this->session->user_id;
    //         $start_date = $this->input->post('start_date');
    //         $end_date = $this->input->post('end_date');
    //         $raw_data = $this->model_activity->user_report($id, $start_date, $end_date);
    //         $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
    //         $activities = [];

    //         // Group details by jasa_id
    //         foreach ($raw_data as $row) {
    //             $activity_id = $row['activity_id'];

    //             // Initialize activity if not already present
    //             if (!isset($activities[$activity_id])) {
    //                 $activities[$activity_id] = [
    //                     'user_name' => $row['user_name'],
    //                     'status' => $row['status'],
    //                     'activity_category' => $row['activity_category'],
    //                     'constrain_category' => $row['constrain_category'],
    //                     'urgency' => $row['urgency'],
    //                     'constrain' => $row['constrain'],
    //                     'constrain_description' => $row['constrain_description'],
    //                     'created_at' => $row['created_at'],
    //                     'details' => [] // Initialize details array
    //                 ];
    //             }
                
    //             // Check if detail already exists before adding
    //             $detail_exists = false;
    //             foreach ($activities[$activity_id]['details'] as $existing_detail) {
    //                 if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
    //                     $detail_exists = true;
    //                     break;
    //                 }
    //             }

    //             // Add the detail to the activity if it doesn't already exist
    //             if (!$detail_exists) {
    //                 $activities[$activity_id]['details'][] = [
    //                     'activity_detail_id' => $row['activity_detail_id'],
    //                     'tech_name' => $row['tech_name'],
    //                     'activity_tech_id' => $row['activity_tech_id'],
    //                     'action_description' => $row['action_description'],
    //                     'level' => $row['level'],
    //                     'analyze' => $row['analyze'],
    //                     'troubleshooting' => $row['troubleshooting'],
    //                     'reason' => $row['reason']
    //                 ];
    //             }
    //         }
            
    //         // var_dump($data);
    //         // exit();
    //         $data['activity_grouped'] = $activities;
    //         $this->slice->view('report.datatable', $data);
    //     } else {
    //         $id = $this->session->user_id;
    //         // Fetch the data from the model 
    //         $raw_data = $this->model_activity->user_report($id);
    //         // Prepare an array to group details by activity_id
    //         $activities = [];

    //         // Group details by jasa_id
    //         foreach ($raw_data as $row) {
    //             $activity_id = $row['activity_id'];

    //             // Initialize activity if not already present
    //             if (!isset($activities[$activity_id])) {
    //                 $activities[$activity_id] = [
    //                     'user_name' => $row['user_name'],
    //                     'status' => $row['status'],
    //                     'activity_category' => $row['activity_category'],
    //                     'constrain_category' => $row['constrain_category'],
    //                     'urgency' => $row['urgency'],
    //                     'constrain' => $row['constrain'],
    //                     'constrain_description' => $row['constrain_description'],
    //                     'created_at' => $row['created_at'],
    //                     'details' => [] // Initialize details array
    //                 ];
    //             }
                
    //             // Check if detail already exists before adding
    //             $detail_exists = false;
    //             foreach ($activities[$activity_id]['details'] as $existing_detail) {
    //                 if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
    //                     $detail_exists = true;
    //                     break;
    //                 }
    //             }

    //             // Add the detail to the activity if it doesn't already exist
    //             if (!$detail_exists) {
    //                 $activities[$activity_id]['details'][] = [
    //                     'activity_detail_id' => $row['activity_detail_id'],
    //                     'tech_name' => $row['tech_name'],
    //                     'activity_tech_id' => $row['activity_tech_id'],
    //                     'action_description' => $row['action_description'],
    //                     'level' => $row['level'],
    //                     'analyze' => $row['analyze'],
    //                     'troubleshooting' => $row['troubleshooting'],
    //                     'reason' => $row['reason']
    //                 ];
    //             }
    //         }

    //         // // Convert data to format suitable for DataTables
    //         $view_data = [];
    //         foreach ($activities as $activity) {
    //             $view_data[] = [
    //                 'user_name' => $activity['user_name'],
    //                 'status' => $activity['status'],
    //                 'activity_category' => $activity['activity_category'],
    //                 'constrain_category' => $activity['constrain_category'],
    //                 'urgency' => $activity['urgency'],
    //                 'constrain' => $activity['constrain'],
    //                 'constrain_description' => $activity['constrain_description'],
    //                 'created_at' => $activity['created_at'],
    //                 'details' => json_encode($activity['details']) // JSON encode details for use in child rows
    //             ];
    //         }

    //         $data['activity_grouped'] = $view_data;
    //         // $data['activity_grouped'] = $activities;

    //         // var_dump($data);
    //         // exit();
    //         $this->load->model('model_user');
    //         $data['users'] = $this->model_user->index()->result_array();
    //         $this->slice->view('report.datatable', $data);
    //         // $this->slice->view('report.datatable');
    //     }
    // }

    public function excel() {
        header("Content-Type=application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=filename.xls");
        $id = $this->session->user_id;
        // Fetch the data from the model 
        $raw_data = $this->model_activity->user_report($id);
        // Prepare an array to group details by activity_id
        $activities = [];

        // Group details by jasa_id
        foreach ($raw_data as $row) {
            $activity_id = $row['activity_id'];

            // Initialize activity if not already present
            if (!isset($activities[$activity_id])) {
                $activities[$activity_id] = [
                    'user_name' => $row['user_name'],
                    'status' => $row['status'],
                    'activity_category' => $row['activity_category'],
                    'constrain_category' => $row['constrain_category'],
                    'urgency' => $row['urgency'],
                    'constrain' => $row['constrain'],
                    'constrain_description' => $row['constrain_description'],
                    'created_at' => $row['created_at'],
                    'details' => [] // Initialize details array
                ];
            }
            
            // Check if detail already exists before adding
            $detail_exists = false;
            foreach ($activities[$activity_id]['details'] as $existing_detail) {
                if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                    $detail_exists = true;
                    break;
                }
            }

            // Add the detail to the activity if it doesn't already exist
            if (!$detail_exists) {
                $activities[$activity_id]['details'][] = [
                    'activity_detail_id' => $row['activity_detail_id'],
                    'tech_name' => $row['tech_name'],
                    'activity_tech_id' => $row['activity_tech_id'],
                    'action_description' => $row['action_description'],
                    'level' => $row['level'],
                    'analyze' => $row['analyze'],
                    'troubleshooting' => $row['troubleshooting'],
                    'reason' => $row['reason']
                ];
            }
        }

        $data['activity_grouped'] = $activities;
        // $data['reports'] = $this->model_transaction->report()->result();

        $this->load->view('report/pdf', $data);
    }

    // public function pdf() {
    //     $this->load->library('pdf'); // Load the FPDF library

    //     $pdf = new FPDF('L', 'mm', 'A4');
    //     $pdf->AddPage();
    //     // Table Header
    //     $pdf->SetFont('Arial', 'B', 20);
    //     $pdf->Text(10, 10, 'LAPORAN TRANSAKSI JASA');
    //     $pdf->ln(7);

    //     // PDF Headers
    //     $pdf->SetFont('Arial', 'B', 8);
    //     $pdf->Cell(10, 7, 'No', 1);
    //     $pdf->Cell(45, 7, 'Tanggal Laporan', 1);
    //     $pdf->Cell(45, 7, 'Nama Pelapor', 1);
    //     $pdf->Cell(30, 7, 'Status', 1);
    //     $pdf->Cell(40, 7, 'Urgency', 1);
    //     $pdf->Cell(40, 7, 'Kendala', 1);
    //     $pdf->Cell(60, 7, 'Deskripsi Kendala', 1);
    //     $pdf->Ln();
    //     $id = $this->session->user_id;
    //     // Fetch the data from the model 
    //     $raw_data = $this->model_activity->user_report($id);
    //     // Prepare an array to group details by activity_id
    //     $activities = [];

    //     // Group details by jasa_id
    //     foreach ($raw_data as $row) {
    //         $activity_id = $row['activity_id'];

    //         // Initialize activity if not already present
    //         if (!isset($activities[$activity_id])) {
    //             $activities[$activity_id] = [
    //                 'user_name' => $row['user_name'],
    //                 'status' => $row['status'],
    //                 'activity_category' => $row['activity_category'],
    //                 'constrain_category' => $row['constrain_category'],
    //                 'urgency' => $row['urgency'],
    //                 'constrain' => $row['constrain'],
    //                 'constrain_description' => $row['constrain_description'],
    //                 'created_at' => $row['created_at'],
    //                 'details' => [] // Initialize details array
    //             ];
    //         }
            
    //         // Check if detail already exists before adding
    //         $detail_exists = false;
    //         foreach ($activities[$activity_id]['details'] as $existing_detail) {
    //             if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
    //                 $detail_exists = true;
    //                 break;
    //             }
    //         }
            
    //         // Add the detail to the activity if it doesn't already exist
    //         if (!$detail_exists) {
    //             $activities[$activity_id]['details'][] = [
    //                 'activity_detail_id' => $row['activity_detail_id'],
    //                 'tech_name' => $row['tech_name'],
    //                 'activity_tech_id' => $row['activity_tech_id'],
    //                 'action_description' => $row['action_description'],
    //                 'level' => $row['level'],
    //                 'analyze' => $row['analyze'],
    //                 'troubleshooting' => $row['troubleshooting'],
    //                 'reason' => $row['reason']
    //             ];
    //         }
    //     }
        
    //     // var_dump($activities);
    //     // exit();

    //     $no = 1;

    //     // SetFont for row details
    //     $pdf->SetFont('Arial', '', 8);

    //     foreach ($activities as $activity_id => $activity) {
    //         // // Print activity data
    //         // $pdf->Cell(10, 7, $no, 1);
    //         // $pdf->Cell(45, 7, $activity['created_at'], 1);
    //         // $pdf->Cell(45, 7, $activity['user_name'], 1);
    //         // $pdf->Cell(30, 7, $activity['status'], 1);
    //         // $pdf->Cell(40, 7, $activity['urgency'], 1);
    //         // $pdf->Cell(40, 7, $activity['constrain'], 1);
    //         // $pdf->MultiCell(60, 7, $activity['constrain_description'], 1);
    //         // $pdf->SetXY($pdf->GetX() + 60, $pdf->GetY() - 7); // Adjust position for next cell
    //         // $pdf->Ln();

    //         // Cell wrapper
    //         $cell_width = 60;
    //         $cell_height = 5;

    //         // Text overflow cheking
    //         if ($pdf->GetStringWidth($activity['constrain_description']) < $cell_width) {
    //             $line = 1;
    //         } else {
    //             $text_length = strlen($activity['constrain_description']); // calculate text lenght
    //             $err_margin = 10; // cell width error margin, just in case
    //             $start_char = 0; // character start positition for each line
    //             $max_char = 0;
    //             $text_array = array(); // to hold the string each line
    //             $tmp_string = ""; // to hold the string for a line (temporary)
                
    //             // Loop until the end of the text
    //             while ($start_char < $text_length) {
    //                 // Loop until reach max_char
    //                 while ($pdf->GetStringWidth($tmp_string) < ($cell_width - $err_margin) && ($start_char + $max_char) < $text_length) {
    //                     $max_char++;
    //                     $tmp_string = substr($activity['constrain_description'], $start_char, $max_char);
    //                 }
                    
    //                 // Start new line
    //                 $start_char = $start_char + $max_char;

    //                 // add into the array then we know how many line we need it.
    //                 array_push($text_array, $tmp_string);
                    
    //                 // reset $max_char & %tmp_string
    //                 $max_char = 0;
    //                 $tmp_string = '';
    //             }
    //             // Get number of the line
    //             $line = count($text_array);
    //         }

    //         // Print activity data
    //         $pdf->Cell(10, ($line * $cell_height), $no, 1);
    //         $pdf->Cell(45, ($line * $cell_height), $activity['created_at'], 1, 0);
    //         $pdf->Cell(45, ($line * $cell_height), $activity['user_name'], 1, 0);
    //         $pdf->Cell(30, ($line * $cell_height), $activity['status'], 1);
    //         $pdf->Cell(40, ($line * $cell_height), $activity['urgency'], 1);
    //         $pdf->Cell(40, ($line * $cell_height), $activity['constrain'], 1);
    //         // $pdf->MultiCell(60, 7, $activity['constrain_description'], 1);
    //         /**
    //          * MultiCell always treated as end of the line
    //          * We need to set X,Y position manually
    //          * for the next Cell to next to it.
    //          */
    //         $x_pos = $pdf->GetX();
    //         $y_pos = $pdf->GetY();
    //         $pdf->MultiCell($cell_width, $cell_height, $activity['constrain_description'], 1);
            
    //         /**
    //          * Return the position of next Cell next to MultiCell
    //          * And offset the X with MultiCell width
    //          */
    //         $pdf->SetXY($x_pos + $cell_width, $y_pos);
    //         $pdf->Ln();
            

    //         // $pdf->Cell(10, 7, '', 1);
    //         // $pdf->Cell(260, 7, 'Detail Jasa', 1);
    //         // $pdf->ln();
    //         // // PDF details header
    //         // $pdf->SetFont('Arial', 'B', 8);
    //         // // $pdf->Cell(10, 7, 'No', 1);
    //         // $pdf->Cell(10, 7, '', 1);
    //         // $pdf->Cell(35, 7, 'Nama Teknisi', 1);
    //         // $pdf->Cell(45, 7, 'Analisa', 1);
    //         // $pdf->Cell(50, 7, 'Deskripsi Tindakan', 1);
    //         // $pdf->Cell(30, 7, 'Level', 1);
    //         // $pdf->Cell(50, 7, 'Troubleshooting', 1);
    //         // $pdf->Cell(50, 7, 'Alasan', 1);
    //         // $pdf->Ln();

    //         // Print details for the activity
    //         // foreach ($activity['details'] as $detail) {
                
    //         //     // SetFont for main row
    //         //     $pdf->SetFont('Arial', '', 8);

    //         //     $pdf->Cell(10, 7, '', 1); // Empty cell for alignment
    //         //     $pdf->Cell(35, 7, $detail['tech_name'], 1);
    //         //     $pdf->MultiCell(45, 7, $detail['analyze'], 1);
    //         //     $pdf->SetXY($pdf->GetX() + 90, $pdf->GetY() - 7); // Adjust position for next cell
    //         //     $pdf->Cell(50, 7, $detail['action_description'], 1);
    //         //     $pdf->Cell(30, 7, $detail['level'], 1);
    //         //     $pdf->Cell(50, 7, $detail['troubleshooting'], 1);
    //         //     $pdf->Cell(50, 7, $detail['reason'], 1);
    //         //     // $pdf->SetXY($pdf->GetX() + 30, $pdf->GetY() - 7); // Adjust position for next cell
    //         //     $pdf->Ln();
    //         // }

    //         $no++;
    //     }

    //     // Output the PDF
    //     $pdf->Output();
    // }
    
    // // Colored table
    // private function table_pdf($header, $data) {
    //     // Colors, line width and bold font
    //     $this->SetFillColor(255,0,0);
    //     $this->SetTextColor(255);
    //     $this->SetDrawColor(128,0,0);
    //     $this->SetLineWidth(.3);
    //     $this->SetFont('','B');
    //     // Header
    //     $w = array(40, 35, 40, 45);
    //     for($i=0;$i<count($header);$i++)
    //         $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    //     $this->Ln();
    //     // Color and font restoration
    //     $this->SetFillColor(224,235,255);
    //     $this->SetTextColor(0);
    //     $this->SetFont('');
    //     // Data
    //     $fill = false;
    //     foreach($data as $row) {
    //         $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
    //         $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
    //         $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
    //         $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
    //         $this->Ln();
    //         $fill = !$fill;
    //     }
    
    //     // Closing line
    //     $this->Cell(array_sum($w),0,'','T');
    // }


    // public function ppp() {
    //     $this->load->library('Pdf');
    //     $pdf = new FPDF('P', 'mm', 'A4');
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 14);

    //     // $pdf->SetFontSize(14);
    //     $pdf->Text(10, 10, 'LAPORAN TRANSAKSI JASA');
    //     $pdf->SetFont('Arial', '', 10);

    //     // $pdf->SetFontSize(10);
    //     $pdf->Cell(10, 20, '', '', 1);
    //     $pdf->Cell(10, 7, 'No', 1, 0);
    //     $pdf->Cell(27, 7, 'Tanggal', 1, 0);
    //     $pdf->Cell(30, 7, 'Operator', 1, 0);
    //     $pdf->Cell(30, 7, 'Total Transaksi', 1, 1);

    //     // // Get from database
    //     // $pdf->SetFont('Arial', '', 'L');
    //     // $data = $this->model_transaction->report()->result();
    //     $id = $this->session->user_id;
    //     // Fetch the data from the model 
    //     $raw_data = $this->model_activity->user_report($id);
    //     // Prepare an array to group details by activity_id
    //     $activities = [];

    //     // Group details by jasa_id
    //     foreach ($raw_data as $row) {
    //         $activity_id = $row['activity_id'];

    //         // Initialize activity if not already present
    //         if (!isset($activities[$activity_id])) {
    //             $activities[$activity_id] = [
    //                 'user_name' => $row['user_name'],
    //                 'status' => $row['status'],
    //                 'activity_category' => $row['activity_category'],
    //                 'constrain_category' => $row['constrain_category'],
    //                 'urgency' => $row['urgency'],
    //                 'constrain' => $row['constrain'],
    //                 'constrain_description' => $row['constrain_description'],
    //                 'created_at' => $row['created_at'],
    //                 'details' => [] // Initialize details array
    //             ];
    //         }
            
    //         // Check if detail already exists before adding
    //         $detail_exists = false;
    //         foreach ($activities[$activity_id]['details'] as $existing_detail) {
    //             if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
    //                 $detail_exists = true;
    //                 break;
    //             }
    //         }

    //         // Add the detail to the activity if it doesn't already exist
    //         if (!$detail_exists) {
    //             $activities[$activity_id]['details'][] = [
    //                 'activity_detail_id' => $row['activity_detail_id'],
    //                 'tech_name' => $row['tech_name'],
    //                 'activity_tech_id' => $row['activity_tech_id'],
    //                 'action_description' => $row['action_description'],
    //                 'level' => $row['level'],
    //                 'analyze' => $row['analyze'],
    //                 'troubleshooting' => $row['troubleshooting'],
    //                 'reason' => $row['reason']
    //             ];
    //         }
    //     }

    //     // $data['activity_grouped'] = $activities;

    //     // var_dump($data);
    //     // exit();
    //     // $this->slice->view('report.datatable', $data);
    //     $no = 1;
    //     $total = 0;

    //     // foreach ($data as $dt) {
    //     //     $pdf->Cell(10, 7, $no, 1, 0);
    //     //     $pdf->Cell(27, 7, $dt->tanggal_transaksi, 1, 0);
    //     //     $pdf->Cell(30, 7, $dt->nama, 1, 0);
    //     //     $pdf->Cell(30, 7, $dt->total, 1, 1);
    //     //     $no++;
    //     //     $total = $total+$dt->total;
    //     // }

    //     foreach ($activities as $activity_id => $activity) {
    //         $pdf->Cell(10, 7, $no, 1, 0);
    //         $pdf->Cell(27, 7, $activity['created_at'], 1, 0);
    //         $pdf->Cell(30, 7, $activity['user_name'], 1, 0);
    //         $pdf->Cell(30, 7, $actiivty['status'], 1, 1);
            
    //         $sec = 1;
    //         foreach ($activity['details'] as $detail) {
    //             $pdf->Cell(10, 7, $sec++, 1, 0);
    //             $pdf->Cell(27, 7, $activity['created_at'], 1, 0);
    //             $pdf->Cell(30, 7, $activity['user_name'], 1, 0);
    //             $pdf->Cell(30, 7, $actiivty['status'], 1, 1);
    //         }
    //         $no++;
    //     }

    //     $pdf->Output();
    // }
}
