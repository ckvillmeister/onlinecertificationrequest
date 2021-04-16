<?php 

class homeController extends controller{

	private $model;
	
	public function index(){
		if ($this->is_session_empty()){
			$settings_model = new settingsModel();
			$settings = $settings_model->get_settings();
			
			$this->view()->render('site_pages/home.php', 
					array('settings' => $settings));
		}
		else{
			header('location:'.ROOT.'dashboard');
		}
	}

}

?>