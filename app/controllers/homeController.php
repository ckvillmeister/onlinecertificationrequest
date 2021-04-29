<?php 

class homeController extends controller{

	private $model;
	
	public function index(){
		if ($this->is_session_empty()){
			$settings_model = new settingsModel();
			$settings = $settings_model->get_settings();
			$checklist = $settings_model->get_symptoms_checklist(1);
			$muncities = $settings_model->retrieve_municipalities('0712');

			$site_model = new siteModel();
			$faqs = $site_model->get_faqs(1);
			$photos = $site_model->get_photos(1);
			$services = $site_model->get_services(1);

			$school_model = new schoolModel();
			$schools = $school_model->get_schools(1);

			$this->view()->render('site_pages/home.php', 
					array('settings' => $settings,
							'checklist' => $checklist,
							'muncities' => $muncities,
							'faqs' => $faqs,
							'photos' => $photos,
							'services' => $services,
							'schools' => $schools));
		}
		else{
			header('location:'.ROOT.'dashboard');
		}
	}

	public function retrieve_barangays(){
		$muncity_code = isset($_POST['muncity_code']) ? $_POST['muncity_code'] : 0;

		$settings_model = new settingsModel();
		$barangays = $settings_model->retrieve_barangays($muncity_code);

		echo json_encode($barangays);
	}

}

?>