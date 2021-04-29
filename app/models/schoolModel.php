<?php

class schoolModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function get_schools($status){
		$stmt = $this->con->prepare("SELECT record_id, abbreviation, school_name, status FROM tbl_schools WHERE status = ".$status);
		$stmt->execute();
		$stmt->bind_result($id, $abbreviation, $school_name, $status);
		$schools = array();

		while ($stmt->fetch()) {
			$schools[] = array('id' => $id, 
							'abbr' => $abbreviation, 
							'school' => $school_name,
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $schools;
	}
}