<?php

class mainController extends controller{

	public function index(){
		if ($this->is_session_empty()){
			header('location:'.ROOT);
		}
		else{
			$settings_model = new settingsModel();
			$system_name = $settings_model->get_system_name();

			$this->view()->render('main/index.php', array('system_name' => $system_name));
		}
	}

	public function search_result(){
		if ($this->is_session_empty()){
			header('location:'.ROOT);
		}
		else{
			$settings_model = new settingsModel();
			$system_name = $settings_model->get_system_name();
			
			$supporter = isset($_POST['text_search_supporter']) ? $_POST['text_search_supporter'] : "";
			$ward_obj = new wardModel();
			$search_result = $ward_obj->retrieve_matched_supporter_names($supporter);

			$this->view()->render('main/search_result.php', array('search_result' => $search_result, 'system_name' => $system_name));
		}
	}

	public function logout(){
		$this->view()->render('login/login.php');
		session_destroy();
	}
}
?>