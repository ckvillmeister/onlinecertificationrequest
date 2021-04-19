<?php

class checklistController extends controller{

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

   			if ($accessrole_model->check_access($role, 'checklist')){
				$this->view()->render('maintenance/checklist/index.php', array('system_name' => $system_name));
			}
			else{
				$this->view()->render('error/forbidden.php', array('system_name' => $system_name));
			}
		}
	}

	public function get_checklist(){
		$status = isset($_POST['status']) ? $_POST['status'] : 0;

		$checklist_model = new checklistModel();
		$checklist = $checklist_model->get_checklist($status);
		
		$this->view()->render('maintenance/checklist/list.php', array('roles' => $checklist));
	}

	public function get_checklistitem_info(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;

		$checklist_model = new checklistModel();
		$checklistiteminfo = $checklist_model->get_checklistitem_info($id);

		echo json_encode($checklistiteminfo);
	}

	public function process_checklist(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$desc = isset($_POST['description']) ? $_POST['description'] : 0;

		$checklist_model = new checklistModel();
		$result = $checklist_model->process_checklist($id, $desc);
		echo $result;
	}

	public function toggle_checklist_item(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$status = isset($_POST['status']) ? $_POST['status'] : 0;
		
		$checklist_model = new checklistModel();
		$result = $checklist_model->toggle_checklist_item($id, $status);
		echo $result;
	}

}
?>