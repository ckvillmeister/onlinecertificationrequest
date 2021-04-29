<?php

class settingsController extends controller{
	
	public function index(){
		if ($this->is_session_empty()){
			header('location:'.ROOT);
		}
		else{
			$settings_model = new settingsModel();
			$settings = $settings_model->get_settings();
			$system_name = $settings_model->get_system_name();
			
			$accessrole_model = new accessroleModel();
			$accessroles = $accessrole_model->get_access_roles(1);
			$accounts_model = new accountsModel();
 			$userinfo = $accounts_model->get_user_info($_SESSION['user_id']);
   			$role = $userinfo['role'];
			
			if ($accessrole_model->check_access($role, 'settings')){
				$this->view()->render('maintenance/system_settings/index.php', array('settings' => $settings, 'system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function save_settings(){
		$settings_model = new settingsModel();
		$name = $_POST['name'];
		$title = $_POST['title'];
		$bizname = $_POST['bizname'];
		$bizadd = $_POST['bizadd'];
		$sched = $_POST['sched'];
		$email = $_POST['email'];
		$number = $_POST['number'];
		$doctor = $_POST['doctor'];
		$licenseno = $_POST['licenseno'];
		$ptr = $_POST['ptr'];
		$fontcolor = $_POST['fontcolor'];
		$result = $settings_model->save_settings($name, $title, $bizname, $bizadd, $sched, $email, $number, $doctor, $licenseno, $ptr, $fontcolor);
		echo $result;
	}

	public function back_up_database(){
		$str = exec('start /B '.$_SERVER['DOCUMENT_ROOT'].ROOT.'\app\lib\database-backup.bat'); 
		echo 1;
	}

	public function save_system_image(){
		$set_name = isset($_GET['set_name']) ? $_GET['set_name'] : "";
		$file = $_FILES['file']['tmp_name'];
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
		$path = 'public/image/'.$_FILES['file']['name'];
		$dist = $_SERVER['DOCUMENT_ROOT'].ROOT.'public/image/'.$_FILES['file']['name'];
		move_uploaded_file($file, $dist);

		$settings_model = new settingsModel();
		echo 1;  $settings_model->update_image($path, $set_name);
	}

}

?>