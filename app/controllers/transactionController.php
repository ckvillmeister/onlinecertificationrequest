<?php

class transactionController extends controller{

	public function certification(){
		if ($this->is_session_empty()){
			header('location:'.ROOT);
		}
		else{
			$settings_model = new settingsModel();
			$system_name = $settings_model->get_system_name();

			$accessrole_model = new accessroleModel();
 			$accounts_model = new accountsModel();
 			$userinfo = $accounts_model->get_user_info($_SESSION['user_id']);
   			$role = $userinfo['role'];

 			if ($accessrole_model->check_access($role, 'certification')){
 				$transaction_model = new transactionModel();
 				$transaction_model->toggle_requests(2);

 				$this->view()->render('transaction/certification/index.php', 
										array('system_name' => $system_name));
 			}
 			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function process_request(){
		$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
		$middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
		$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
		$extension = isset($_POST['extension']) ? $_POST['extension'] : '';
		$address = isset($_POST['address']) ? $_POST['address'] : '';
		$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
		$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
		$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
		$pickupdate = isset($_POST['pickupdate']) ? $_POST['pickupdate'] : '';
		$new_date =date("Y-m-d",strtotime($pickupdate));
		$new_dob =date("Y-m-d",strtotime($dob));

		$transaction_model = new transactionModel();
		$result = $transaction_model->process_request($firstname, $middlename, $lastname, $extension, $address, $sex, $new_dob, $contact, $new_date);
		echo $result;
	}

	public function get_request_info(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$transaction_model = new transactionModel();
		$info = $transaction_model->get_request_info($id);
		echo json_encode($info);
	}

	public function get_requests(){
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$transaction_model = new transactionModel();
		$requests = $transaction_model->get_requests($status);
		
		$this->view()->render('transaction/certification/list.php', array('requests' => $requests));
	}

	public function toggle_request(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$transaction_model = new transactionModel();
		$result = $transaction_model->toggle_request($id, $status);
		echo $result;
	}

	public function print_certificate(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$transaction_model = new transactionModel();
		$info = $transaction_model->get_request_info($id);
		$findings = $transaction_model->get_patient_findings($id);
		$note = $transaction_model->get_patient_note($id);

		$settings_model = new settingsModel();
		$settings = $settings_model->get_settings();

		$this->view()->render('transaction/certification/certificate.php', array('info' => $info,
																					'findings' => $findings,
																					'note' => $note,
																					'settings' => $settings));
	}

	public function get_findings(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$transaction_model = new transactionModel();
		$findings = $transaction_model->get_patient_findings($id);
		echo json_encode($findings);
	}

	public function get_note(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$transaction_model = new transactionModel();
		$note = $transaction_model->get_patient_note($id);
		echo json_encode($note);
	}


	public function update_cert_req(){
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
		$middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
		$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
		$extension = isset($_POST['extension']) ? $_POST['extension'] : '';
		$address = isset($_POST['address']) ? $_POST['address'] : '';
		$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
		$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
		$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
		$findings = isset($_POST['findings']) ? $_POST['findings'] : '';
		$note = isset($_POST['note']) ? $_POST['note'] : '';
		$new_dob =date("Y-m-d",strtotime($dob));

		$transaction_model = new transactionModel();
		$res1 = $transaction_model->update_request($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $new_dob, $contact);
		$res2 = $transaction_model->save_findings($id, $findings);
		$res3 = $transaction_model->save_note($id, $note);
		$result = 0;

		if ($res1 == 1 & $res2 == 1 & $res3 == 1){
			$result = 1;
		}
		echo $result;
	}

}
?>