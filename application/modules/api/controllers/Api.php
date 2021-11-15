<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
	}

	// function customer_register()
	// {
	// 	$data_input = $this->_get_customer_post_values();
	// 	if (!empty($data_input)) {
	// 		$customer = array();
	// 		$customer['vCustomerName'] = $data_input['consumer_name'];
	// 		$customer['vEmail'] = $data_input['email_id'];
	// 		$customer['dDob'] = $data_input['dob'];
	// 		$customer['iMobileNumber'] = $data_input['mobile_number'];
	// 		$customer['vPassword'] = $data_input['password'];
	// 		$customer['vAddress'] = $data_input['address'];
	// 		$customer['iAadharNo'] = $data_input['aadhar_number'];
	// 		$customer['iPincode'] = $data_input['pincode'];
	// 		$customer['vProfession'] = $data_input['profession'];
	// 		// $customer['vEmergencyName'] = $data_input['emergency_name'];
	// 		// $customer['iEmergencyNumber'] = $data_input['emergency_number'];
	// 		$customer['tCreatedAt'] = date('Y-m-d h:i:s');
	// 		$customer['tStatus'] = 1;
	// 		$otp = $this->api_model->generateNumericOTP('4');
	// 		$customer['iOtpCode'] = $otp;
	// 		if ($customer['vCustomerName'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Name is required"
	// 			);

	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['iMobileNumber'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Mobile number is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['vEmail'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Email is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['iAadharNo'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Aadhar number is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['vPassword'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Password is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['vAddress'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Address is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		if ($customer['iPincode'] == "") {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'code' => '422',
	// 				'message' => "Pincode number is required"
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}
	// 		$is_mobile_number_exists = $this->api_model->is_mobile_number_exists($customer['iMobileNumber']);
	// 		if ($is_mobile_number_exists) {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'message' => "The given mobile number already exists."
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}

	// 		$is_aadhar_exists = $this->api_model->is_aadhar_exists($customer['iAadharNo']);
	// 		if ($is_aadhar_exists) {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'message' => "The given Aadhar number already exists."
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}

	// 		$is_email_id_exists = $this->api_model->is_email_id_exists($customer['vEmail']);
	// 		if ($is_email_id_exists) {
	// 			$output = array(
	// 				'status' => 'false',
	// 				'message' => "The given email already exists."
	// 			);
	// 			$this->response($output);
	// 			exit;
	// 		}

	// 		$insert = $this->api_model->insert_customer_details($customer);
	// 		if (!empty($insert) && $insert != 0) {
	// 			$customer_details = $this->api_model->get_customer_details_by_insert_id($insert);
	// 			$this->response([
	// 				'status' => "Success",
	// 				'code' => "200",
	// 				'message' => 'The customer has been registered successfully.',
	// 				'customer_data' => $customer_details
	// 			]);
	// 		}
	// 	} else {
	// 		$output = array(
	// 			"status" => "false",
	// 			"code" => "422",
	// 			"message" => "Provide complete customer information to add."
	// 		);
	// 		$this->response($output);
	// 	}
	// }

	public function employee_login()
	{
		$data = $this->_get_customer_post_values();
		// print_r($data);
		if (!empty($data)) {
			$login_result = $this->api_model->check_login_details($data);
			if ($data['emp_name'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Employee name is required"
				);
				$this->response($output);
				exit;
			}
			if ($data['password'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Password is required"
				);
				$this->response($output);
				exit;
			}
			// print_r($login_result);
			// exit;
			if ($login_result) {
				// if ($login_result == 1) {
				// $output = array('status' => 'Error', 'message' => 'OTP not verified');
				// $this->response($output);
				// } else {
				$output = array('status' => 'Success', 'message' => 'Login successfully', 'data' => $login_result);
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Invalid login credentials');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please mobile number and password');
			$this->response($output);
		}
	}

	public function check_customer_otp()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$otp_result = $this->api_model->check_customer_otp($json_input['customer_id']);
			if (!empty($otp_result) && $otp_result['iOtpCode'] == $json_input['otp_code']) {
				$update_data['tOtpVerify'] = 1;
				$this->api_model->update_fields($otp_result['iCustomerId'], $update_data);
				$output = array('status' => 'Success', 'code' => 200, 'message' => 'Otp Verified successfully', 'data' => $otp_result);
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Invalid OTP');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter valid details');
			$this->response($output);
		}
	}

	public function resend_otp()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$otp = $this->api_model->generateNumericOTP('4');
			if ($json_input['type'] == 'forget password') {
				$update_data['iOtpCode'] = $otp;
				$update = $this->api_model->update_fields($json_input['customer_id'], $update_data);
				$details = $this->api_model->get_customer_details($customer['iCustomerId']);
				$output = array('status' => 'Success', 'message' => 'Otp send successfully', 'data' => $details);
				$this->response($output);
			}
			$update_data['iOtpCode'] = $otp;
			$update = $this->api_model->update_fields($json_input['customer_id'], $update_data);
			$details = $this->api_model->get_customer_details($customer['iCustomerId']);
			$output = array('status' => 'Success', 'message' => 'Otp send successfully', 'data' => $details);
			$this->response($output);
		} else {
			$output = array('status' => 'Error', 'message' => 'User not found');
			$this->response($output);
		}
	}

	public function get_locked_home_details()
	{
		$data_input = $this->_get_customer_post_values();
		// print_r($data_input);exit;
		if (!empty($data_input)) {
			// if (!empty($_FILES['image']['name'])) {
			// 	$config['upload_path']   = './uploads/';
			// 	$config['allowed_types'] = 'jpg|jpeg|png';
			// 	$this->load->library('upload', $config);
			// 	$this->upload->initialize($config);
			// 	 if ($this->upload->do_upload('image')) {
			// 		$data      = $this->upload->data();
			// 		$fileNames = $data['file_name'];
			// 	}
			// }
			$customer = array();
			$customer['iCustomerId'] = $data_input['customer_id'];
			$customer['dFromDate'] = $data_input['startdate'];
			$customer['dToDate'] = $data_input['Enddate'];
			$customer['vCustomerName'] = $data_input['customer_name'];
			$customer['vAddress'] = $data_input['address'];
			$customer['iPhoneNumber'] = $data_input['mobile_number'];
			$customer['iPincode'] = $data_input['pincode'];
			$customer['iIdProofNumber'] = $data_input['identification_number'];
			$customer['vIdProoftype'] = $data_input['identification_number_type'];
			$customer['vAttachment'] = $data_input['attachments'];
			$customer['tStatus'] = 1;

			if ($customer['dFromDate'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Start date is required"
				);

				$this->response($output);
				exit;
			}
			if ($customer['dToDate'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "End date is required"
				);
				$this->response($output);
				exit;
			}
			if ($customer['iPincode'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Pincode is required"
				);
				$this->response($output);
				exit;
			}
			if ($customer['vIdProoftype'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Id Prooftype is required"
				);
				$this->response($output);
				exit;
			}
			if ($customer['iIdProofNumber'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Id ProofNumber is required"
				);
				$this->response($output);
				exit;
			}


			$insert = $this->api_model->get_locked_home_details($customer);
			if (!empty($insert) && $insert != 0) {
				$home_details = $this->api_model->get_lockedhome_details_by_insert_id($insert);
				$this->response([
					'status' => "Success",
					'code' => "200",
					'message' => 'The details has been registered successfully.',
					'customer_data' => $home_details
				]);
			}
		} else {
			$output = array(
				"status" => "false",
				"code" => "422",
				"message" => "Provide complete customer information to add."
			);
			$this->response($output);
		}
	}

	public function get_profile_details()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$user_details = $this->api_model->get_customer_details($json_input['counter_id']);
			if ($json_input['counter_id'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "counter_id is required"
				);
				$this->response($output);
				exit;
			}
			if ($user_details) {
				$output = array(
					"status" => "Success",
					"code" => "200",
					"message" => "Customer profile details",
					"data" => $user_details,
				);
				$this->response($output);
			} else {
				$output = array(
					'status' => 'Error',
					'message' => 'Profile details not found'
				);
				$this->response($output);
			}
		} else {
			$output = array(
				"status" => "false",
				"code" => "422",
				"message" => "Please provide valid details"
			);
			$this->response($output);
		}
	}

	public function update_profile_details()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$counter_data['id'] = $json_input['counter_id'];
			$counter_data['counter_name'] = $json_input['counter_name'];

			$emp_data['emp_name'] = $json_input['emp_name'];
			// $customer['dDob'] = $json_input['dob'];
			$emp_data['mobile_number'] = $json_input['mobile_number'];
			$emp_data['email_address'] = $json_input['email_id'];
			$emp_data['password'] = $json_input['password'];

			// $customer['vProfession'] = $json_input['profession'];
			// $check_duplicate_email = $this->api_model->check_field_exists('email_address', $json_input['email_id'], $json_input['counter_id']);
			// if ($check_duplicate_email) {
			// 	$output = array('status' => 'Error', 'message' => 'Email Address Already Exists');
			// 	$this->response($output);
			// 	exit;
			// }
			if ($json_input['counter_id'] == "" || $json_input['counter_name'] == "" || $json_input['emp_name'] == "" || $json_input['mobile_number'] == "" || $json_input['email_id'] == "" || $json_input['password'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Field is required"
				);
				$this->response($output);
				exit;
			}

			$profile = $this->api_model->update_fields($counter_data, $emp_data);
			// echo "<pre>";
			// print_r($profile);
			// exit;
			if ($profile) {
				// $update_data = $this->api_model->check_counter($counter_data);
				$update_data = $this->api_model->check_emp($emp_data, $counter_data);
				$output = array('status' => 'Success', 'message' => 'Profile details updated', 'data' => $update_data);
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Profile details not updated');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function customer_logout()
	{
		$data = $this->_get_customer_post_values();
		if (!empty($data)) {
			$logout = $this->api_model->get_customer_details($data['counter_id']);
			if ($data['counter_id'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "counter_id is required"
				);
				$this->response($output);
				exit;
			}
			// print($logout);
			// exit;
			if ($logout) {
				$update = array();
				$update['status'] = 1;
				$this->api_model->update_fields($logout['counter_id'], $update);
				$output = array(
					// 'code' => '200',
					'type' => 'Success',
					'message' => 'Customer Logged Out Successfully.',
				);
				$this->response($output);
			} else {
				$output = array(
					// 'code' => '402',
					'type' => 'Error',
					'message' => 'Something went wrong',
				);
				$this->response($output);
			}
		} else {
			$output = array(
				'code' => '402',
				'type' => 'Error',
				'message' => 'Provide required information',
			);
			$this->response($output);
		}
	}

	public function generate_otp()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$customer = $this->api_model->forgot_password($json_input);
			if ($customer) {
				$otp = $this->api_model->generateNumericOTP('4');
				$update_data['iOtpCode'] = $otp;
				$this->api_model->update_fields($customer['iCustomerId'], $update_data);
				$details = $this->api_model->get_customer_details($customer['iCustomerId']);
				$output = array(
					'status' => 'success', 'code' => 200, 'message' => 'OTP sent successfully', 'data' => $details
				);
				$this->response($output);
			} else {
				$output = array(
					'status' => 'error', 'code' => 415, 'message' => 'Invalid credentials'
				);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	// public function resend_otp(){
	// 	$json_input = $this->_get_customer_post_values();
	// 	$this->customer_resend_otp($json_input);
	// }

	public function otp_verify()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			if ($json_input['type'] == 'forget password') {
				$otp_result = $this->api_model->check_customer_otp($json_input['customer_id']);
				if (!empty($otp_result) && $otp_result['iOtpCode'] == $json_input['otp_code']) {
					$update_data['tForgotPwdOtpVerify'] = 1;
					$this->api_model->update_fields($otp_result['iCustomerId'], $update_data);
					$output = array('status' => 'Success', 'code' => 200, 'message' => 'Otp Verified successfully');
					$this->response($output);
				} else {
					$output = array('status' => 'Error', 'message' => 'Invalid OTP');
					$this->response($output);
				}
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function change_forgot_password()
	{
		$json_input  = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			if ($json_input['password'] == $json_input['conform_password']) {
				$customer['vPassword'] = md5($json_input['password']);
				$this->api_model->update_fields($json_input['customer_id'], $customer);
				$output = array('status' => 'success', 'code' => 200, 'message' => 'Password changed successfully');
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Password doesnt match');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function get_police_station_details()
	{
		$police_station = $this->api_model->police_station_details();
		if ($police_station) {
			$output = array(
				'code' => '200',
				'type' => 'Success',
				'message' => 'Police station list.',
				'data' => $police_station,
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'police station details not found'
			);
			$this->response($output);
		}
	}

	public function get_queue_category_list()
	{
		$category_list = $this->api_model->get_queue_category_list();
		if ($category_list) {
			$output = array(
				'code' => '200',
				'type' => 'Success',
				'message' => 'Queue category list.',
				'data' => $category_list,
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'Category list not found'
			);
			$this->response($output);
		}
	}
	public function get_tokenlist()
	{
		$token_list = $this->api_model->get_token_list();
		if ($token_list['counter_id'] == "") {
			$output = array(
				'status' => 'false',
				'code' => '422',
				'message' => "counter_id is required"
			);
			$this->response($output);
			exit;
		}
		if ($token_list['counter_name'] == "") {
			$output = array(
				'status' => 'false',
				'code' => '422',
				'message' => "counter_id is required"
			);
			$this->response($output);
			exit;
		}
		if ($token_list) {
			// if ($token_list['counter_id'] == "") {
			// 	$output = array(
			// 		'status' => 'false',
			// 		'code' => '422',
			// 		'message' => "counter_id is required"
			// 	);
			// 	$this->response($output);
			// 	exit;
			// }
			// if ($token_list['Counter_name'] == "") {
			// 	$output = array(
			// 		'status' => 'false',
			// 		'code' => '422',
			// 		'message' => "counter_id is required"
			// 	);
			// 	$this->response($output);
			// 	exit;
			// }

			$output = array(
				'code' => '200',
				'type' => 'Success',
				'message' => 'Token list',
				'data' => $token_list,
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'No token list found'
			);
			$this->response($output);
		}
	}
	public function create_token()
	{
		$token_list = $this->api_model->get_created_token();
		if ($token_list) {
			$output = array(
				'code' => '200',
				'type' => 'Success',
				'message' => 'Token list',
				'data' => $token_list,
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'No token list found'
			);
			$this->response($output);
		}
	}

	public function get_ads_list()
	{
		$ads = $this->api_model->get_ads();
		if ($ads) {
			$output = array(
				'status' => 'Success',
				'message' => 'Ads list',
				'data' => $ads
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'Ads not found'
			);
			$this->response($output);
		}
	}

	public function get_covid_updates()
	{
		$ads = $this->api_model->get_news();
		if ($ads) {
			$output = array(
				'status' => 'Success',
				'message' => 'News list',
				'data' => $ads
			);
			$this->response($output);
		} else {
			$output = array(
				'status' => 'Error',
				'message' => 'News not found'
			);
			$this->response($output);
		}
	}

	public function update_locked_home_details()
	{
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$home['iLockedHomeId'] = $json_input['customer_id'];
			$home['dFromDate'] = $json_input['startdate'];
			$home['dToDate'] = $json_input['Enddate'];
			$home['vCustomerName'] = $json_input['customer_name'];
			$home['iPhoneNumber'] = $json_input['mobile_number'];
			$home['vAddress'] = $json_input['password'];
			$home['iIdProofNumber'] = $json_input['address'];
			$home['iPincode'] = $json_input['pincode'];
			$home['vAttachment'] = $json_input['attachments'];
			$home['vIdProoftype'] = $json_input['identification_number_type'];
			$home['iIdProofNumber'] = $json_input['identification_number'];

			$update = $this->api_model->update_locked_home($json_input['customer_id'], $home);
			if ($update) {
				$home_details = $this->api_model->get_lockedhome_details_by_insert_id($json_input['customer_id']);
				$output = array('status' => 'Success', 'code' => 200, 'message' => 'Details updated', 'data' => $home_details);
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Details not updated');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}
	public function update_queue_status()
	{
		$json_input = $this->_get_customer_post_values();
		$data = array();
		// echo "<pre>";
		// print_r($json_input);
		// exit;
		if (!empty($json_input)) {
			$counter_data['id'] = $json_input['Counter_id'];
			$counter_data['counter_name'] = $json_input['counter_name'];

			$token_data['id'] = $json_input['token_id'];
			$token_data['token_number'] = $json_input['token_number'];
			$token_data['token_status'] = $json_input['Status'];
			$token_data['remarks'] = $json_input['Remarks'];
			$token_data['transfer_counter_id'] = $json_input['Transfer_counter'];
			$token_data['updated_date'] = date('Y-m-d h:i:s');
			// $home['iPincode'] = $json_input['pincode'];
			// $home['vAttachment'] = $json_input['attachments'];
			// $home['vIdProoftype'] = $json_input['identification_number_type'];
			// $home['iIdProofNumber'] = $json_input['identification_number'];

			$update = $this->api_model->update_queue_status($token_data, $counter_data);
			// echo "<pre>";
			// print_r($update);
			// exit;
			if ($update) {
				$home_details = $this->api_model->get_queue_details_by_insert_id($token_data, $counter_data);
				$output = array('status' => 'Success', 'code' => 200, 'message' => 'Details updated', 'data' => $home_details);
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Details not updated');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function change_password()
	{
		$data_input = $this->_get_customer_post_values();
		if (!empty($data_input)) {
			$customer = $this->api_model->get_customer_details($data_input['customer_id']);
			if (md5($data_input['old_password']) == $customer['vPassword']) {
				$customer['vPassword'] = md5($data_input['new_password']);
				$this->api_model->update_fields($data_input['customer_id'], $customer);
				$output = array('status' => 'Success', 'code' => 200, 'message' => 'Password updated successfully');
				$this->response($output);
			} else {
				$output = array('status' => 'Error', 'message' => 'Wrong password entered');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function feedback()
	{
		$terms = $this->_get_customer_post_values();
		if (!empty($terms)) {
			$terms = $this->api_model->get_terms_and_conditions();
			if ($terms) {
				$output = array('status' => 'success', 'message' =>  "Feedback has been updated successfully");
				$this->response($output);
			} else {
				$output = array('status' => 'error', 'message' => 'Something went wrong');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'Something went wrong');
			$this->response($output);
		}
	}
	public function reassign_missed_token()
	{
		$terms = $this->_get_customer_post_values();
		if (!empty($terms)) {
			$terms = $this->api_model->reassign_missed_token();
			if ($terms['token_number'] == "") {
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "counter_id is required"
				);
				$this->response($output);
				exit;
			}
			if ($terms) {
				$output = array('status' => 'success', 'message' =>  "Missed Token Reassigned Successfully");
				$this->response($output);
			} else {
				$output = array('status' => 'error', 'message' => 'Invalid token number');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'no data found');
			$this->response($output);
		}
	}
	public function reassign_hold_token()
	{
		$terms = $this->_get_customer_post_values();
		if (!empty($terms)) {
			$terms = $this->api_model->reassign_hold_token();
			if ($terms) {
				$output = array('status' => 'success', 'message' =>  "Hold Token Reassigned Successfully");
				$this->response($output);
			} else {
				$output = array('status' => 'error', 'message' => 'Invalid token number');
				$this->response($output);
			}
		} else {
			$output = array('status' => 'error', 'message' => 'no data found');
			$this->response($output);
		}
	}
}
