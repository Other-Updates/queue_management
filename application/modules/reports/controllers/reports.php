<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends MX_Controller {

    function __construct() {
        parent::__construct();
        if ($this->user_auth->is_logged_in()) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                redirect($this->config->item('base_url') . 'counter/employee/' . $user_details['user_id']);
            }
        }
        if (!in_array($this->router->method, array('login', 'logout'))) {
            if (!$this->user_auth->is_logged_in()) {
                redirect($this->config->item('base_url') . 'users/login');
            }
        }
        $main_module = 'reports';
        $access_arr = array(
            'reports/index' => array('add', 'edit', 'delete', 'view'),
            'reports/feedback' => array('add', 'edit', 'delete', 'view'),
            'reports/token' => 'no_restriction',
            'reports/reports_ajaxList' => 'no_restriction',
            'reports/get_emp_name_by_counter_id' => 'no_restriction',
            'reports/report_pdf' => 'no_restriction'
        );

        $this->load->model('reports_model');
        $this->load->model('masters/counter_model');
        $this->load->model('users/users_model');
    }

    function index() {
        $data = array();

        $data['title'] = 'Queue - Report ';

        $client_id = $this->user_auth->get_user_id();
        $today_tokens = $this->reports_model->get_all_today_token($client_id);
        $edit_token = $this->reports_model->get_all_today_edit_token($client_id);
        if ($edit_token != '') {
            $data['today_token'] = array_merge($today_tokens, $edit_token);
        } else {
            $data['today_token'] = $this->reports_model->get_all_today_token($client_id);
        }
        $data['counter'] = $this->counter_model->get_all_counter($client_id);
        $data['emp'] = $this->employee_model->get_all_employee($client_id);
        $data['tkn_num'] = $this->reports_model->get_all_tkn_number($client_id);
        $this->template->write_view('content', 'reports', $data);
        $this->template->render();
    }

    function createDateRange($startDate, $endDate, $format = "Y-m-d") {
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);

        $interval = new DateInterval('P1D'); // 1 Day
        $dateRange = new DatePeriod($begin, $interval, $end);

        $range = [];
        foreach ($dateRange as $key => $date) {
            $range['date'][$key] = $date->format($format);
            $range['day'][$key] = date('D', strtotime($date->format($format)));
        }

        return $range;
    }

    function analytics_reports() {
        $data = array();

        $data['title'] = 'Analytics Report ';
        $current_date = date('Y-m-d');
        $last_week_date = date('Y-m-d', strtotime('-6 days'));
        $next_date = date('Y-m-d', strtotime('+1 days'));
        $get_last_week_dates = $this->createDateRange($last_week_date, $next_date);
        $client_id = $this->user_auth->get_user_id();
        $data['counter_token_status'] = json_encode($this->reports_model->get_counter_token_status($current_date, $get_last_week_dates, $client_id));
        $data['get_last_week_dates'] = json_encode($get_last_week_dates);

        $this->template->write_view('content', 'analytics_reports', $data);
        $this->template->render();
    }

    function feedback() {

        $data = array();
        $data['title'] = 'Feedback Report ';
        $client_id = $this->user_auth->get_user_id();
        $data['feedback'] = $this->reports_model->get_all_feedback($client_id);
        $this->template->write_view('content', 'feedback', $data);
        $this->template->render();
    }

    function get_tkn_number_bydate() {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $client_id = $this->user_auth->get_user_id();
        $data = $this->reports_model->get_tkn_number_bydate($from_date, $to_date, $client_id);

        if ($data)
            echo json_encode($data);
        else
            echo 1;
    }

    function sum_multi_time($times) {

        $seconds = 0;

        if ($times) {
            foreach ($times as $time) {

                list($hour, $minute, $second) = explode(':', $time);
                $seconds += $hour * 3600;
                $seconds += $minute * 60;
                $seconds += $second;
            }
        }
        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;

        //  return "{$hours}:{$minutes}:{$seconds}";
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
    }

    function get_reports_data($search_data) {
        $client_id = $this->user_auth->get_user_id();
        $list = $this->reports_model->get_datatables($search_data, $client_id);

        $list1['counts'] = count($list);

        $time = '';
        $wait_time = '';
        $processing_time = '00:00:00';
        $q_waiting_time = '00:00:00';
        $success = '';
        $Hold = '';
        $Transfer = '';
        $Missed = '';

        $tkn_number = [];
        foreach ($list as $key => $results) {
            $total_time = $results->processing_time;
            $waitingtime = $results->que_total_waiting_time;
            if (empty($total_time))
                $total_time = "00:00:00";
            if (empty($waitingtime))
                $waitingtime = "00:00:00";

            $time[] = $total_time;
            $wait_time[] = $waitingtime;

            if ($results->token_status == "Success")
                $success[] = 1;
            if ($results->token_status == "Hold")
                $Hold[] = 1;
            if ($results->token_status == "Transfer")
                $Transfer[] = 1;
            if ($results->token_status == "Missed")
                $Missed[] = 1;
            if ($results->token_status == "Hold-Reassign")
                $Hold_reassign[] = 1;
            if ($results->token_status == "Missed-Reassign")
                $Missed_reassign[] = 1;
            if (!in_array($results->token_number, $tkn_number)) {
                $tkn_number[] = $results->token_number;
            }
        }

        $processing_time = $this->sum_multi_time($time);
        $q_waiting_time = $this->sum_multi_time($wait_time);

        $footerheader_data = [
            "processing_time" => $processing_time,
            "q_waiting_time" => $q_waiting_time,
            "success" => (empty($success)) ? 0 : count($success),
            "Hold" => (empty($Hold)) ? 0 : count($Hold) + count($Hold_reassign),
            "Transfer" => (empty($Transfer)) ? 0 : count($Transfer),
            "Missed" => (empty($Missed)) ? 0 : count($Missed) + count($Missed_reassign),
            "Hold_reassign" => (empty($Hold_reassign)) ? 0 : count($Hold_reassign),
            "Missed_reassign" => (empty($Missed_reassign)) ? 0 : count($Missed_reassign),
            "tkn_number" => (empty($tkn_number)) ? 0 : count($tkn_number),
        ];

        $list1['counts_data'] = $footerheader_data;

        $list1['result_data'] = $list;

        return $list1;
    }

    function reports_ajaxList() {
        $search_data = array();
        $search_data = $this->input->post();
        $client_id = $this->user_auth->get_user_id();
        $list = $this->get_reports_data($search_data);



        $data = array();
        $no = $_POST['start'];

        if ($list['counts'] > 0) {
            foreach ($list['result_data'] as $key => $ass) {

                if ($ass->token_status == "Success") {
                    $status = '<span style="color:#4CAF50">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == "Hold") {
                    $status = '<span style="color:skyblue">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == "Transfer") {
                    $status = '<span style="color:#F44336">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == "Missed") {
                    $status = '<span style="color:orange">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == "Hold-Reassign") {
                    $status = '<span style="color:black">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == "Missed-Reassign") {
                    $status = '<span style="color:black">' . $ass->token_status . "</span>";
                } elseif ($ass->token_status == '') {
                    $status = '';
                }

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = ucfirst($ass->counter_name);
                $row[] = ucfirst($ass->emp_name);
                $row[] = $ass->token_number;
                $row[] = date('d-m-Y', strtotime($ass->created_date));
                $row[] = $ass->que_start_time;
                $row[] = $ass->que_total_waiting_time;
                $row[] = $ass->tkn_intime;
                $row[] = $ass->tkn_outtime;
                $row[] = $ass->processing_time;
                $row[] = $status;
                $row[] = $list['counts_data'];



                $data[] = $row;
            }
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->reports_model->count_all($search_data, $client_id),
            'recordsFiltered' => $this->reports_model->count_filtered($search_data, $client_id),
            'data' => $data,
        );

        echo json_encode($output);
        exit;
    }

    function get_emp_name_by_counter_id($counter_id) {
        $emp_name = $this->reports_model->get_emp_by_counter($counter_id);
        if ($emp_name != 0) {
            echo json_encode($emp_name);
        }
    }

    function report_pdf() {
        $this->load->model('users/users_model');
        $data['report_title'] = 'Token Report';
        $search_data = array();
        $search_data = $this->input->get();
        $id = $this->user_auth->get_user_id();
        $client_id = $this->user_auth->get_user_id();
        $logo_img = $this->users_model->get_user_by_id($client_id);
        $data['logo'] = $logo_img[0]['company_logo'];
        $data['user_data'] = $this->users_model->get_user_by_id($id);
        $data['report_data'] = $this->get_reports_data($search_data);
        $html = $this->load->view('reports/pdf/common_pdf_header', $data, TRUE);
        $body = $this->load->view('reports/pdf/token_report_pdf', $data, TRUE);
        $mpdf = new mPDF('', 'A4', '0', '"Roboto", "Noto", sans-serif', '15', '15', '28', '10', '5', '3', 'L');
        $mpdf->setTitle('Token Report');
        $mpdf->SetHTMLHeader($html);
        $mpdf->setFooter('{PAGENO} / {nb}');
        $mpdf->WriteHTML($body);
        $mpdf->Output('Token Report.pdf', 'D');
    }

}
