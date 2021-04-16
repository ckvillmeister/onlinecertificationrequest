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

 			if ($accessrole_model->check_access($role, 'dashboard')){
 				$this->view()->render('dashboard/index.php', 
										array('system_name' => $system_name
									));
 			}
 			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}
}
?>