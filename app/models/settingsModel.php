
<?php

class settingsModel extends model{

	private $con;

	public function __construct(){
		//$db = new database();
		//$this->con = $db->connection();
	}

	public function get_system_name(){

		$arr_settings = array();
  		$settings = $this->get_settings();
  		
  		foreach ($settings as $key => $setting) {
    		$arr_settings[$setting['name']] = $setting['desc'];
  		}
		
		return $arr_settings['System Name'];
	}

	public function get_settings(){

		$query = 'SELECT record_id, setting_name, setting_desc FROM tbl_sys_settings';

		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$stmt->bind_result($id, $name, $desc);
		$ctr=0;
		$settings=array();
		while ($stmt->fetch()) {
			$setting[$name] = array('id' => $id, 
							'name' => $name, 
							'desc' => $desc);
		}
		$stmt->close();
		$this->con->close();
		return $setting;
	}

	public function save_settings($name, $title, $bizname, $bizadd, $sched, $email, $number, $doctor, $licenseno, $ptr, $fontcolor){
		$db = new database();
		$this->con = $db->connection();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'System Name'");
		$stmt->bind_param("s", $name);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Title'");
		$stmt->bind_param("s", $title);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Business Name'");
		$stmt->bind_param("s", $bizname);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Business Address'");
		$stmt->bind_param("s", $bizadd);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Clinic Schedule'");
		$stmt->bind_param("s", $sched);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'E-mail Address'");
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Contact Number'");
		$stmt->bind_param("s", $number);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Clinic Doctor'");
		$stmt->bind_param("s", $doctor);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'License Number'");
		$stmt->bind_param("s", $licenseno);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'PTR'");
		$stmt->bind_param("s", $ptr);
		$stmt->execute();

		$stmt = $this->con->prepare("UPDATE tbl_sys_settings SET setting_desc = ? WHERE setting_name = 'Certificate Font Color'");
		$stmt->bind_param("s", $fontcolor);
		$stmt->execute();

		$stmt->close();
		$this->con->close();
		return 1;
	}

	public function process_barangay($id, $barangay){
		$status = 1;
		$result = 0;

		$db = new database();
		$this->con = $db->connection();

		if ($id == 0){
			$stmt = $this->con->prepare("INSERT INTO tbl_barangay (barangay_name, status) VALUES (?, ?)");
			$stmt->bind_param("ss", $barangay, $status);
			$stmt->execute();
			$result = 1;
		}
		else{
			$query_brgy = "SELECT * FROM tbl_barangay WHERE record_id = ".$id;

			if (mysqli_num_rows(mysqli_query($this->con, $query_brgy)) >= 1){
				$stmt = $this->con->prepare("UPDATE tbl_barangay SET barangay_name = ? WHERE record_id = ?");
				$stmt->bind_param("ss", $barangay, $id);
				$stmt->execute();
				$result = 2;
			}
		}

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_barangay_info($id){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, barangay_name, status FROM tbl_barangay WHERE record_id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $name, $status);
		$barangayinfo = array();

		while ($stmt->fetch()) {
			$barangayinfo = array('id' => $id, 
							'name' => $name, 
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $barangayinfo;
	}

	public function toggle_barangay($id, $status){
		
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("UPDATE tbl_barangay SET status = ? WHERE record_id = ?");
		$stmt->bind_param("ss", $status, $id);
		$stmt->execute();
		$result = 1;		

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_sys_info($sys_name){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, setting_name, setting_desc FROM tbl_sys_settings WHERE setting_name = '".$sys_name."'");;
		$stmt->execute();
		$stmt->bind_result($id, $name, $desc);
		$imageinfo = array();

		while ($stmt->fetch()) {
			$imageinfo = array('id' => $id, 
							'name' => $name, 
							'desc' => $desc);
		}
		$stmt->close();
		$this->con->close();
		return $imageinfo;
	}

	public function update_image($path, $sys_name){
		$db = new database();
		$this->con = $db->connection();

		$query = 'SELECT * FROM tbl_sys_settings WHERE setting_name = "'.$sys_name.'"';
		
		if (mysqli_num_rows(mysqli_query($this->con, $query)) >= 1){
			$query = 'UPDATE tbl_sys_settings SET setting_desc = "'.$path.'" WHERE setting_name = "'.$sys_name.'"';
			$stmt = $this->con->prepare($query);
			$stmt->execute();
	
			$stmt->close();
			$this->con->close();
			return 1;
		}
		else{
			$query = 'INSERT INTO tbl_sys_settings (setting_name, setting_desc) VALUES ("'.$sys_name.'", "'.$path.'")';
			$stmt = $this->con->prepare($query);
			$stmt->execute();
	
			$stmt->close();
			$this->con->close();
			return 1;
		}
	}

	public function get_symptoms_checklist($status){

		$query = 'SELECT record_id, symptoms_description, status FROM tbl_symptoms_checklist WHERE status = ?';

		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $status);
		$stmt->execute();
		$stmt->bind_result($id, $desc, $status);
		$ctr=0;
		$checklist=array();
		while ($stmt->fetch()) {
			$checklist[$desc] = array('id' => $id, 
							'desc' => $desc, 
							'status' => $status);
		}
		
		$stmt->close();
		$this->con->close();
		return $checklist;
	}

	public function retrieve_municipalities($province_code){
		$db = new database();
		$this->con = $db->connection();

		$qry = "SELECT id, city_municipality_description, region_code, province_code, city_municipality_code, zipcode FROM tbl_address_citymun WHERE province_code = '".$province_code."' ORDER BY city_municipality_description ASC";
		$stmt = $this->con->prepare($qry);
		$stmt->execute();
		$stmt->bind_result($id, $desc, $rcode, $pcode, $cmcode, $zcode);
		$muncities = array();

		while ($stmt->fetch()) {
			$muncities[] = array('id' => $id, 
							'desc' => $desc, 
							'rcode' => $rcode,
							'pcode' => $pcode,
							'cmcode' => $cmcode,
							'zcode' => $zcode);
		}
		$stmt->close();
		$this->con->close();
		return $muncities;
	}

	public function retrieve_barangays($citymun_code){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT id, barangay_code, barangay_description, region_code, province_code, city_municipality_code FROM tbl_address_barangay WHERE city_municipality_code = ".$citymun_code." ORDER BY barangay_description ASC");;
		$stmt->execute();
		$stmt->bind_result($id, $brgycode, $desc, $rcode, $pcode, $cmcode);
		$brgys = array();

		while ($stmt->fetch()) {
			$brgys[] = array('id' => $id,
							'brgycode' => $brgycode,
							'desc' => $desc, 
							'rcode' => $rcode,
							'pcode' => $pcode,
							'cmcode' => $cmcode);
		}
		$stmt->close();
		$this->con->close();
		return $brgys;
	}

}