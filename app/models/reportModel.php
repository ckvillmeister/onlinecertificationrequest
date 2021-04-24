<?php

class reportModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function get_year(){
		$settingsObj = new settingsModel();
		$settings = $settingsObj->get_settings();

		foreach ($settings as $key => $value) {
			$data = (object) $value;
			if ($data->name == 'Active Election Year'){
				return $data->desc;
			}
		}
	}

	public function total_request_per_month($month){
		$query = 'SELECT COUNT(*) AS total FROM tbl_certification_request WHERE MONTH(request_date) = ? AND YEAR(request_date) = ?';
		$year = date('Y');

		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare($query);
		$stmt->bind_param('ss', $month, $year);
		$stmt->execute();
		$data = $stmt->get_result()->fetch_assoc();
		$total = ($data['total']) ? $data['total'] : 0 ;
		
		$stmt->close();
		return $total;
	}
	
}

?>