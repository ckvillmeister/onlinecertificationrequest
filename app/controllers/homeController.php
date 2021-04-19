<?php 

class homeController extends controller{

	private $model;
	
	public function index(){
		if ($this->is_session_empty()){
			$settings_model = new settingsModel();
			$settings = $settings_model->get_settings();
			$checklist = $settings_model->get_symptoms_checklist(1);
			$muncities = $settings_model->retrieve_municipalities('0712');
			$this->view()->render('site_pages/home.php', 
					array('settings' => $settings,
							'checklist' => $checklist,
							'muncities' => $muncities));
		}
		else{
			header('location:'.ROOT.'dashboard');
		}
	}

}

?>