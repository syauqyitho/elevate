<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_user');
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
    }

    public function user() {
        if (isset($_POST['submit'])) {
            $id = $this->input->post('name');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->admin_user_role_report($id, $start_date, $end_date);
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
            
            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_user_role_list();
            // $data['tech_roles'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.user', $data);
        } else {
            // Fetch the data from the model 
            $raw_data = $this->model_activity->admin_user_role_report();
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
            $data['users'] = $this->model_user->fetch_user_role_list();
            // $data['tech_roles'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.user', $data);
        }
    }

    public function tech() {
        if (isset($_POST['submit'])) {
            $id = $this->input->post('name');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->admin_tech_role_report($id, $start_date, $end_date);
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
            
            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.tech', $data);
        } else {
            // Fetch the data from the model 
            $raw_data = $this->model_activity->admin_tech_role_report();
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
            $data['users'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.tech', $data);
        }
    }

    public function excel() {
        header("Content-Type=application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=filename.xls");
        $data['reports'] = $this->model_transaction->report()->result();
        $this->load->view('transaction/excel', $data);
    }

    public function pdf() {
        $this->load->library('Pdf');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        // $pdf->SetFontSize(14);
        $pdf->Text(10, 10, 'LAPORAN TRANSAKSI');
        $pdf->SetFont('Arial', '', 10);
        // $pdf->SetFontSize(10);
        $pdf->Cell(10, 20, '', '', 1);
        $pdf->Cell(10, 7, 'No', 1, 0);
        $pdf->Cell(27, 7, 'Tanggal', 1, 0);
        $pdf->Cell(30, 7, 'Operator', 1, 0);
        $pdf->Cell(30, 7, 'Total Transaksi', 1, 1);
        // // Get from database
        // $pdf->SetFont('Arial', '', 'L');
        $data = $this->model_transaction->report()->result();
        $no = 1;
        $total = 0;

        foreach ($data as $dt) {
            $pdf->Cell(10, 7, $no, 1, 0);
            $pdf->Cell(27, 7, $dt->tanggal_transaksi, 1, 0);
            $pdf->Cell(30, 7, $dt->nama, 1, 0);
            $pdf->Cell(30, 7, $dt->total, 1, 1);
            $no++;
            $total = $total+$dt->total;
        }

        $pdf->Cell(67, 7, 'Total', 1, 0, 'R');
        $pdf->Cell(30, 7, $total, 1, 0);
        $pdf->Output();
    }
}
