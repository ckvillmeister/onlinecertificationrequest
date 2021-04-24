<?php

class dashboardController extends controller{

	public function index(){
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

   			$transaction_model = new transactionModel();
   			$new_requests = $transaction_model->get_requests(1);
   			$pending_requests = $transaction_model->get_requests(2);
   			$printed_requests = $transaction_model->get_filtered_requests(2, 0);
   			$unprinted_requests = $transaction_model->get_filtered_requests(1, 0);

			$request_per_month = array();
			$months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
			$report_model = new reportModel();

			foreach ($months as $key => $month) {
				$total_request = $report_model->total_request_per_month($month);
				array_push($request_per_month, $total_request);
			}

 			if ($accessrole_model->check_access($role, 'dashboard')){
 				$this->view()->render('dashboard/index.php', 
										array('system_name' => $system_name,
												'new' => $new_requests,
												'pending' => $pending_requests,
												'printed' => $printed_requests,
												'unprinted' => $unprinted_requests,
												'request_per_month' => $request_per_month
									));
 			}
 			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}
}
?>