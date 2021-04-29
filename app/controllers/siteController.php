<?php

class siteController extends controller{

	public function faqs(){
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

   			if ($accessrole_model->check_access($role, 'faqs')){
				$this->view()->render('faqs/index.php', array('system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function services(){
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

   			if ($accessrole_model->check_access($role, 'services')){
				$this->view()->render('services/index.php', array('system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function gallery(){
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

   			if ($accessrole_model->check_access($role, 'gallery')){
				$this->view()->render('gallery/index.php', array('system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function process_faq(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$question = isset($_POST['question']) ? $_POST['question'] : 0;
		$answer = isset($_POST['answer']) ? $_POST['answer'] : 0;

		$site_model = new siteModel();
		$result = $site_model->process_faq($id, $question, $answer);
		echo $result;
	}

	public function get_faqs(){
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$site_model = new siteModel();
		$faqs = $site_model->get_faqs($status);
		
		$this->view()->render('faqs/list.php', array('faqs' => $faqs));
	}

	public function get_faq_info(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$site_model = new siteModel();
		$faqinfo = $site_model->get_faq_info($id);

		echo json_encode($faqinfo);
	}

	public function toggle_faq(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$status = isset($_POST['status']) ? $_POST['status'] : 0;
		
		$site_model = new siteModel();
		$result = $site_model->toggle_faq($id, $status);
		echo $result;
	}

	public function process_photo(){
		$caption = isset($_GET['caption']) ? $_GET['caption'] : "";
		$file = $_FILES['file']['tmp_name'];
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
		$path = 'public/bootstrap/medilab_temp/assets/img/gallery/'.$_FILES['file']['name'];
		$dist = $_SERVER['DOCUMENT_ROOT'].ROOT.'public/bootstrap/medilab_temp/assets/img/gallery/'.$_FILES['file']['name'];
		move_uploaded_file($file, $dist);

		$site_model = new siteModel();
		$result = $site_model->process_photo($caption, $path);
		echo $result;
	}

	public function get_photos(){
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$site_model = new siteModel();
		$photos = $site_model->get_photos($status);
		
		$this->view()->render('gallery/list.php', array('photos' => $photos));
	}

	public function get_photo_info(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$site_model = new siteModel();
		$photoinfo = $site_model->get_photo_info($id);

		echo json_encode($photoinfo);
	}

	public function toggle_photo(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$status = isset($_POST['status']) ? $_POST['status'] : 0;
		
		$site_model = new siteModel();
		$result = $site_model->toggle_photo($id, $status);
		echo $result;
	}

	public function process_service(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$service_name = isset($_POST['service_name']) ? $_POST['service_name'] : 0;
		$desc = isset($_POST['desc']) ? $_POST['desc'] : 0;

		$site_model = new siteModel();
		$result = $site_model->process_service($id, $service_name, $desc);
		echo $result;
	}

	public function get_services(){
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$site_model = new siteModel();
		$services = $site_model->get_services($status);
		
		$this->view()->render('services/list.php', array('services' => $services));
	}

	public function get_service_info(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$site_model = new siteModel();
		$serviceinfo = $site_model->get_service_info($id);

		echo json_encode($serviceinfo);
	}

	public function toggle_service(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$status = isset($_POST['status']) ? $_POST['status'] : 0;
		
		$site_model = new siteModel();
		$result = $site_model->toggle_service($id, $status);
		echo $result;
	}
}