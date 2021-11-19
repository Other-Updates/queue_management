<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert_customer_details($data)
    {
        $data['vPassword'] = md5($data['vPassword']);
        if ($this->db->insert('vnr_customer', $data)) {
            $customer_id = $this->db->insert_id();
            return $customer_id;
        }
        return FALSE;
    }

    function is_mobile_number_exists($mobile_number)
    {
        $this->db->where('tab_1.iMobileNumber', $mobile_number);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_aadhar_exists($aadhar)
    {
        $this->db->where('tab_1.iAadharNo', $aadhar);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function is_email_id_exists($email_id)
    {
        $this->db->where('tab_1.vEmail', $email_id);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_customer_details_by_insert_id($customer_id)
    {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.iCustomerId', $customer_id);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function generateNumericOTP($n)
    {
        $generator = "135792468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }

    public function check_login_details($data)
    {
        $this->db->select('que_employee.emp_name,que_employee.password,que_employee.mobile_number,que_assign_counter.counter_id,que_counter.counter_name,que_employee.email_address');
        $this->db->where('emp_name', $data['emp_name']);
        $this->db->where('password', ($data['password']));
        // $this->db->where('status', 1);
        $this->db->from('que_employee');
        $this->db->join('que_assign_counter', 'que_assign_counter.emp_id=que_employee.id');
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');


        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function check_counter($counter_data)
    {
        $this->db->select('que_counter.id as counter_id,que_counter.counter_name');
        // $this->db->where('counter_id', $data);
        $this->db->from('que_counter');
        $query = $this->db->get();
        if (!empty($query)) {
            //$result['customer_id']=$query['id'];
            //$result['customer_details']=$query;
            //$result['settings'] = $this->getSettings();
            return $query;
        }
        return false;
    }
    public function check_emp($counter_data)
    {
        $this->db->select('que_counter.id as counter_id,que_counter.counter_name,que_employee.emp_name,que_employee.mobile_number,que_employee.email_address,que_employee.password');
        $this->db->where('counter_id',  $counter_data['id']);
        $this->db->from('que_employee');
        // $this->db->join('que_token_details', 'que_employee.id = que_token_details.emp_id');
        $this->db->join('que_counter', 'que_employee.counter_id=que_counter.id');
        // $this->db->where('counter_id', $data);

        $query = $this->db->get();
        if (!empty($query)) {
            //$result['customer_id']=$query['id'];
            //$result['customer_details']=$query;
            //$result['settings'] = $this->getSettings();
            return $query;
        }
        return false;
    }
    public function check_customer_id($data)
    {
        // $this->db->select('*');
        $this->db->where('counter_id', $data);
        $query = $this->db->get('que_assign_counter')->row_array();
        if (!empty($query)) {
            //$result['customer_id']=$query['id'];
            //$result['customer_details']=$query;
            //$result['settings'] = $this->getSettings();
            return $query;
        }
        return false;
    }
    public function check_customer_name($data)
    {
        // $this->db->select('*');
        $this->db->where('counter_name', $data);
        $query = $this->db->get('que_counter')->row_array();
        if (!empty($query)) {
            //$result['customer_id']=$query['id'];
            //$result['customer_details']=$query;
            //$result['settings'] = $this->getSettings();
            return $query;
        }
        return false;
    }



    public function update_fields($counter_data, $emp_data)
    {
        // $data['iUpdatedAt'] = date('Y-m-d h:i:s');
        $this->db->where('id', $counter_data['id']);
        $this->db->update('que_counter', $counter_data);
        // $this->db->where('counter_id', $counter_data['id']);
        $this->db->update('que_employee', $emp_data);
        // $this->db->join('que_assign_counter', 'que_assign_counter.counter_id=que_counter.id');
        $this->db->join('que_assign_counter', 'que_assign_counter.emp_id=que_employee.id');
        // $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');


        return true;
    }
    // public function update_fields_counter_name($id, $data)
    // {
    //     // $data['iUpdatedAt'] = date('Y-m-d h:i:s');
    //     $this->db->where('counter_name', $id);
    //     $this->db->update('que_counter', $data);
    //     return true;
    // }
    // public function update_fields_counter_id($id, $data)
    // {
    //     // $data['iUpdatedAt'] = date('Y-m-d h:i:s');
    //     $this->db->where('counter_id', $id);
    //     $this->db->update(' que_assign_counter', $data);
    //     return true;
    // }

    public function check_field_exists($column, $email, $id)
    {
        $this->db->select('*');
        $this->db->where($column, $email);
        $this->db->where('tStatus', 1);
        if ($id != '')
            $this->db->where('counter_id !=', $id);
        $result = $this->db->get('vnr_customer')->row_array();
        if (!empty($result)) {
            if ($result['otp_verify'] == 0) {
                // $this->db->where('id',$result['id']);
                // $this->db->delete($this->customers);
                return false;
            } else {
                return $result;
            }
        }
        return false;
    }

    public function forgot_password($data)
    {
        $this->db->select('*');
        $this->db->where('iMobileNumber', $data['mobile_number']);
        $this->db->where('iAadharNo', $data['aadhar_number']);
        $this->db->from('vnr_customer');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return false;
    }

    public function get_customer_details($data)
    {
        $this->db->select('que_employee.emp_name,que_employee.password,que_employee.mobile_number,que_assign_counter.counter_id,que_counter.counter_name,que_employee.email_address');
        $this->db->where('counter_id', $data['counter_id']);
        $this->db->join('que_assign_counter', 'que_assign_counter.emp_id=que_employee.id');
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');
        $this->db->from('que_employee');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get_locked_home_details($data)
    {
        if ($this->db->insert('vnr_locked_home', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return FALSE;
    }

    public function get_queue_details_by_insert_id($token_data)
    {
        $this->db->select('que_counter.id as counter_id,que_counter.counter_name,que_token_details.token_number,que_token_details.id as token_id,que_token_details.token_status,que_token_details.remarks');
        $this->db->where('que_token_details.id', $token_data['id']);
        $this->db->from('que_token_details');
        $this->db->join('que_counter', 'que_token_details.counter_id=que_counter.id', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return NULL;
    }

    public function get_customer_profile_details($data)
    {
        $this->db->select('*');
        $this->db->where('iMobileNumber', $data['mobile_number']);
        $data =  $this->db->get('vnr_customer')->row_array();

        return $data;
    }

    public function police_station_details()
    {
        $this->db->select('station.*,officer.vOfficerName,officer.iMobileNumber,officer.iEmail,officer.vGender,department.vDepartmentName,group.vGroupName,designation.vDesignationName');
        $this->db->from('vnr_police_station as station');
        $this->db->join('vnr_police_officer as officer', 'station.iPoliceStationId=officer.iPoliceOfficerId', 'left');
        $this->db->join('vnr_police_designation as designation', 'officer.iDesignationId=designation.iDesignationId', 'left');
        $this->db->join('vnr_police_department as department', 'officer.iDepartmentId=department.iDepartmentId', 'left');
        $this->db->join('vnr_police_group as group', 'group.iGroupid=officer.iGroupid', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function police_officers_details()
    {
        $this->db->select('officer.vOfficerName,officer.iMobileNumber,officer.iEmail,officer.vGender,station.vStationName,station.vPrimaryAttender,station.iEmergencyNO,station.iPoliceStationNumber,station.iStationLandNo,station.vEmail,station.vAddress,station.iPincode,station.iLocation,department.vDepartmentName,group.vGroupName,designation.vDesignationName');
        $this->db->from('vnr_police_officer as officer');
        $this->db->join('vnr_police_station as station', 'officer.iPoliceStationId=station.iPoliceStationId', 'left');
        $this->db->join('vnr_police_designation as designation', 'officer.iDesignationId=designation.iDesignationId', 'left');
        $this->db->join('vnr_police_department as department', 'officer.iDepartmentId=department.iDepartmentId', 'left');
        $this->db->join('vnr_police_group as group', 'group.iGroupid=officer.iGroupid', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_queue_category_list()
    {
        $this->db->select('que_category.id as category_id,que_category.sub_category,que_category_type.id as sub_category_id,que_category_type.category_type');
        $this->db->from('que_category');
        $this->db->join('que_category_type', 'que_category.category_id=que_category_type.id', 'right');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function get_token_list($json_input)
    {
        $this->db->select('que_token_details.token_number,que_token_details.id as token_id,que_token_details.counter_id,que_counter.id,que_counter.counter_name,que_token_details.token_status');
        $this->db->where('counter_id', $json_input['counter_id']);
        $this->db->from('que_token_details');
        $this->db->join('que_counter', 'que_token_details.counter_id=que_counter.id', 'right');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function get_created_token()
    {
        $this->db->select('que_category.category_id,que_category_type.category_type,que_category_type.id as sub_category_id,que_category.sub_category,que_token_details.id as token_id,que_token_details.token_number,que_token_details.counter_id,que_token_details.created_date,que_counter.id,que_counter.counter_name,que_counter.status');
        // $this->db->where('que_token_details.category_id');
        $this->db->from('que_token_details');
        $this->db->from('que_category');
        $this->db->join('que_counter', 'que_token_details.counter_id=que_counter.id', 'right');
        $this->db->join('que_category_type', 'que_category.category_id=que_category_type.id', 'right');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function get_ads()
    {
        $base_url = base_url() . 'images/';
        $this->db->select("id,CONCAT('" . $base_url . "',name) AS image,", FALSE);
        $this->db->from('que_advertisement');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // public function get_queue_category_list()
    // {
    //     $this->db->select('*');
    //     $this->db->from('vnr_manage_ads');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     } else {
    //         return false;
    //     }
    // }


    public function get_news()
    {
        $this->db->select('*');
        $this->db->from('vnr_news');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function update_queue_status($token_data, $counter_data)
    {
        $this->db->where('counter_id', $counter_data['id']);
        $this->db->where('id', $token_data['id']);
        $this->db->update('que_token_details', $token_data);
        $this->db->where('id', $counter_data['id']);
        $this->db->update('que_counter', $counter_data);
        return true;
    }

    public function get_terms_and_conditions($data)
    {
        // $this->db->select('*');
        $this->db->where('token_number', $data['token_number']);
        $this->db->from('que_feedback');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return false;
    }
    public function reassign_missed_token($data)
    {
        // $this->db->select('*');
        $this->db->where('token_number', $data['token_number']);
        $this->db->from('que_token_details');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return false;
    }
    public function reassign_hold_token($data)
    {
        $this->db->select('*');
        $this->db->where('token_number', $data['token_number']);
        $this->db->from('que_token_details');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else
            return false;
    }

    // public function get_customer_by_login($mobile_number, $password) {
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iMobileNumber', $mobile_number);
    //     $this->db->where('tab_1.vPassword', md5($password));
    //     $this->db->where('tab_1.tStatus', 1);
    //     $query = $this->db->get($this->customer . ' AS tab_1');
    //     if ($query->num_rows() >= 1) {
    //         return $query->result_array();
    //     }
    //     return false;
    // }


    // function insert_complaint_details($data) {
    //     if ($this->db->insert('file_complaint', $data)) {
    //         $complaint_id = $this->db->insert_id();
    //         return $complaint_id;
    //     }
    //     return FALSE;
    // }

    // function get_complaint_details_by_insert_id($complaint_id) {
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iFileComplaintId', $complaint_id);
    //     $query = $this->db->get('file_complaint' . ' AS tab_1');
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     }
    //     return NULL;
    // }


}
