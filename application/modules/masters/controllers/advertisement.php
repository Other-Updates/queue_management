<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertisement extends MX_Controller {

    function __construct() {
        parent::__construct();
        if ($this->user_auth->is_logged_in()) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                redirect($this->config->item('base_url') . 'counter/employee/' . $user_details['user_id']);
            }
        }
        if (!$this->user_auth->is_logged_in())
            redirect($this->config->item('base_url') . 'users/login');
        $main_module = 'masters';
        $access_arr = array(
            'advertisement/index' => array('add', 'edit', 'delete', 'view'),
            'advertisement/add' => array('add'),
            'advertisement/edit' => array('edit'),
            'advertisement/delete' => array('delete'),
            'advertisement/view' => array('view'),
            'advertisement/is_add_name_exists' => 'no_restriction',
            'advertisement/get_multiple_time_sum' => 'no_restriction'
        );
        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('masters/advertisement_model');
        $this->load->model('masters/token_increment_model');
        $this->load->library('session');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Category - Manage Category';
        $client_id = $this->user_auth->get_user_id();
        $data['add_data'] = $this->advertisement_model->get_all_add($client_id);
        $this->template->write_view('content', 'masters/add_list', $data);
        $this->template->render();
    }

    public function add() {
        $data = array();
        $data['title'] = 'Advertisement- Create Advertisement';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post()) {
            $advertisement = $this->input->post();

            //insert advertisement
            $add['name'] = $advertisement['add_name'];
            $add['position '] = $advertisement['add_position'];
            $add['type '] = $advertisement['add_type'];
            $add['total_duration'] = $advertisement['overall_total_duration'];
            $add['total_sort_order'] = $advertisement['total_sort_order'];
            $add['created_date'] = date('Y-m-d');
            $add['client_id'] = $client_id;
            $insert_id = $this->advertisement_model->insert_add_data($add);

            for ($i = 0; $i < count($advertisement['add_duration']); $i++) {
                $add_details['add_id'] = $insert_id;

                if ($advertisement['add_type'] == 1 || $advertisement['add_type'] == 2) {

                    if ($advertisement['add_type'] == 1) {
                        $config['upload_path'] = './attachments/advertisements/images/';
                        $allowed_types = array('jpg', 'jpeg', 'png');
                    } else {
                        $config['upload_path'] = './attachments/advertisements/videos/';
                        $allowed_types = array('mp4');
                    }


                    $config['allowed_types'] = implode('|', $allowed_types);
                    //$config['max_size'] = '10000';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    $_FILES['data'] = array(
                        'name' => $_FILES['add_data']['name'][$i],
                        'type' => $_FILES['add_data']['type'][$i],
                        'tmp_name' => $_FILES['add_data']['tmp_name'][$i],
                        'error' => $_FILES['add_data']['error'][$i],
                        'size' => $_FILES['add_data']['size'][$i]
                    );

                    $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                    $extension = pathinfo($_FILES['data']['name'], PATHINFO_EXTENSION);
                    $config['file_name'] = 'ADD_' . $random_hash . '.' . $extension;
                    $this->upload->initialize($config);
                    $this->upload->do_upload('data');
                    $upload_data = $this->upload->data();

                    $add_details['add_data'] = $upload_data['file_name'];
                    $add_details['add_direction'] = $advertisement['add_direction'][$i];
                } else {
                    $add_details['add_data'] = $advertisement['add_data'][$i];
                }
                $add_details['sort_order'] = $advertisement['add_sort_order'][$i];
                $add_details['time_duration'] = $advertisement['add_duration'][$i];
                $add_details['sort_order'] = $advertisement['add_sort_order'][$i];
                $add_details['created_date'] = date('Y-m-d');

                $this->advertisement_model->insert_add_details($add_details);
            }


            $this->session->set_flashdata('flashSuccess', 'Advertisement Added Successfully');
            redirect($this->config->item('base_url') . 'masters/advertisement');
        }

        $this->template->write_view('content', 'masters/add_advertisement', $data);
        $this->template->render();
    }

    public function edit($id) {
        $data = array();
        $data['title'] = 'Advertisement- Update Advertisement';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post()) {
            $advertisement = $this->input->post();
            //insert advertisement
            $add['name'] = $advertisement['add_name'];
            $add['position '] = $advertisement['add_position'];
            $add['type '] = $advertisement['add_type'];
            $add['total_duration'] = $advertisement['overall_total_duration'];
            $add['total_sort_order'] = $advertisement['total_sort_order'];
            $add['updated_at'] = date('Y-m-d H:i:s');
            $add['client_id'] = $client_id;
            $update_id = $this->advertisement_model->update_add_data($add, $id);
            $this->advertisement_model->delete_add_details($id);
            for ($i = 0; $i < count($advertisement['add_duration']); $i++) {

                $add_details['add_id'] = $id;

                if ($advertisement['add_type'] == 1 || $advertisement['add_type'] == 2) {



                    if ($_FILES['add_data']['name'][$i] != "") {

                        if ($advertisement['add_type'] == 1) {
                            $config['upload_path'] = './attachments/advertisements/images/';
                            $allowed_types = array('jpg', 'jpeg', 'png');
                        } else {
                            $config['upload_path'] = './attachments/advertisements/videos/';
                            $allowed_types = array('mp4');
                        }


                        $config['allowed_types'] = implode('|', $allowed_types);
                        //$config['max_size'] = '10000';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        $_FILES['data'] = array(
                            'name' => $_FILES['add_data']['name'][$i],
                            'type' => $_FILES['add_data']['type'][$i],
                            'tmp_name' => $_FILES['add_data']['tmp_name'][$i],
                            'error' => $_FILES['add_data']['error'][$i],
                            'size' => $_FILES['add_data']['size'][$i]
                        );

                        $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                        $extension = pathinfo($_FILES['data']['name'], PATHINFO_EXTENSION);
                        $config['file_name'] = 'ADD_' . $random_hash . '.' . $extension;
                        $this->upload->initialize($config);
                        $this->upload->do_upload('data');
                        $upload_data = $this->upload->data();

                        $image_data = $upload_data['file_name'];

                        if (!empty($image_data)) {
                            $add_details['add_data'] = $image_data;
                        }
                        // }
                    } else {
                        $add_details['add_data'] = $advertisement['add_data_value'][$i];
                    }


                    $add_details['add_direction'] = $advertisement['add_direction'][$i];
                } else {
                    $add_details['add_data'] = $advertisement['add_data'][$i];
                }
                $add_details['sort_order'] = $advertisement['add_sort_order'][$i];
                $add_details['time_duration'] = $advertisement['add_duration'][$i];
                $add_details['sort_order'] = $advertisement['add_sort_order'][$i];
                $add_details['created_date'] = date('Y-m-d');


                $this->advertisement_model->insert_add_details($add_details);
            }

            $this->session->set_flashdata('flashSuccess', 'Advertisement Updated Successfully');
            redirect($this->config->item('base_url') . 'masters/advertisement');
        }
        $data['add'] = $this->advertisement_model->get_add_by_id($id);
        $data['add_details'] = $this->advertisement_model->get_add_details_by_id($id, $data['add'][0]['type']);
        // echo "<pre>";print_r($data);exit;
        $this->template->write_view('content', 'masters/edit_advertisement', $data);
        $this->template->render();
    }

    public function view($id) {
        $data = array();
        $data['title'] = 'Advertisement - View Advertisement Details';
        $data['add'] = $this->advertisement_model->get_add_by_id($id);
        $data['add_details'] = $this->advertisement_model->get_add_details_by_id($id);
        $this->template->write_view('content', 'masters/view_advertisement', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->advertisement_model->delete_add($id);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Category successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_add_name_exists() {
        $client_id = $this->user_auth->get_user_id();
        $add_name = $this->input->post('add_name');

        $data = $this->advertisement_model->is_add_name_exists($add_name, $client_id);

        if (!empty($data[0]['id'])) {
            echo 'yes';
        } else {

            echo 'no';
        }
    }

    function get_multiple_time_sum() {
        $duration = $this->input->post('duration');
        $seconds = 0;
        if ($duration) {
            foreach ($duration as $time) {

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
        echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

}

?>