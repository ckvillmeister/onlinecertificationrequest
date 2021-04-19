<?php

class checklistModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function process_checklist($id, $description){
		$status = 1;
		$result = 0;

		if ($id == 0){
			$stmt = $this->con->prepare("INSERT INTO tbl_symptoms_checklist (symptoms_description, status) VALUES (?, ?)");
			$stmt->bind_param("ss", $description, $status);
			$stmt->execute();
			$result = 1;
		}
		else{
			$query_item = "SELECT * FROM tbl_symptoms_checklist WHERE record_id = ".$id;

			if (mysqli_num_rows(mysqli_query($this->con, $query_item)) >= 1){
				$stmt = $this->con->prepare("UPDATE tbl_symptoms_checklist SET symptoms_description = ? WHERE record_id = ?");
				$stmt->bind_param("ss", $description, $id);
				$stmt->execute();
				$result = 2;
			}
		}

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_checklist($status){
		$stmt = $this->con->prepare("SELECT record_id, symptoms_description, status FROM tbl_symptoms_checklist WHERE status = ".$status);
		$stmt->execute();
		$stmt->bind_result($id, $description, $status);
		$items = array();

		while ($stmt->fetch()) {
			$items[] = array('id' => $id, 
							'description' => $description,
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $items;
	}

	public function get_checklistitem_info($id){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, symptoms_description, status FROM tbl_symptoms_checklist WHERE record_id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $description, $status);
		$item_info = array();

		while ($stmt->fetch()) {
			$item_info = array('id' => $id, 
							'description' => $description,
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $item_info;
	}

	public function toggle_checklist_item($id, $status){
		
		$stmt = $this->con->prepare("UPDATE tbl_symptoms_checklist SET status = ? WHERE record_id = ?");
		$stmt->bind_param("ss", $status, $id);
		$stmt->execute();
		$result = 1;		

		$stmt->close();
		$this->con->close();
		return $result;
	}


}