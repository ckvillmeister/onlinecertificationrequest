<?php

class reportController extends controller{

	public function requests(){
		if ($this->is_session_empty()){
			header('location:'.ROOT);
		}
		else{
			$settingsObj = new settingsModel();
			$system_name = $settingsObj->get_system_name();

			$accessrole_model = new accessroleModel();
			$accessroles = $accessrole_model->get_access_roles(1);
			$accounts_model = new accountsModel();
 			$userinfo = $accounts_model->get_user_info($_SESSION['user_id']);
   			$role = $userinfo['role'];
			
			if ($accessrole_model->check_access($role, 'reprequest')){
				$this->view()->render('report/request/index.php', array('system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function get_ward_list(){
		$barangay = $_POST['barangay'];
		$reportObj = new reportModel();
		$wardlist = $reportObj->get_ward_list(array('barangay' => $barangay));
		$this->view()->render('report/ward_list/wardlist.php', array('wardlist' => $wardlist));
	}

}
?>