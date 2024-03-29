<?php

class transactionModel extends model{

	//Status: 0 = Junked Requests, 1 = New Requests, 2 = New Requests (Indicator), 3 = Approved Requests
	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function get_ip(){
		$ip = '';

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	public function process_request($firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact, $pickupdate, $school_course, $symptoms){
		$status = 1;
		$result = 0;
		$datetime = date("Y-m-d h:i:s");
		$hour = date("H");
		$minute = date("i");
		$month = date("m");
		$year = date("Y");
		$res = 0;
		$current_date = strtotime(date("Y-m-d"));
		$pu_date = strtotime($pickupdate);
		$datediff = $date - $current;
		$difference = floor($datediff/(60*60*24));

		$db = new database();
		$this->con = $db->connection();

		$ip = $this->get_ip();
		$today = date('Y-m-d');

		// $checkClientRequest = "SELECT * FROM tbl_certification_request WHERE DATE(request_date) = ? AND client_ip = ?";
		// $stmt = $this->con->prepare($checkClientRequest);
		// $stmt->bind_param("ss", $today, $ip);
		// $stmt->execute();
		// $result = $stmt->get_result();
		
		// if ($result->num_rows >= 1){
		// 	$result = 2;
		// }
		// else{
			//Save Request

		// $query_month_dup = "SELECT * FROM tbl_certification_request WHERE (MONTH(request_date) = ? AND YEAR(request_date) = ?) AND firstname = ? AND middlename = ? AND lastname = ? AND extension = ?;";
		// $stmt = $this->con->prepare($query_month_dup);
		// $stmt->bind_param("ssssss", $month, $year, $firstname, $middlename, $lastname, $extension);
		// $stmt->execute();
		// $r = $stmt->get_result();
		
		// if ($r->num_rows >= 1){
		// 	$data = $r->fetch_assoc();
		// 	$req_date = $data['request_date'];
		// 	$res = date('F d, Y', strtotime($req_date));
		// }
		// else{
			//Save Request
        // $stmt = $this->con->prepare("UPDATE tbl_certification_request SET status = 0 WHERE firstname = ? AND middlename = ? AND lastname = ? AND extension = ?");
        // $stmt->bind_param("ssss", $firstname, $middlename, $lastname, $extension);
		// $stmt->execute();
		// $result = $stmt->get_result();

		// if (($hour >= 22 && $minute > 0) && $difference == 1){
		// 	$res = 2;
		// }
		// else{
		// 	$res = 1;
		// }
		
        $remove_duplicated_requests = "UPDATE tbl_certification_request SET status = 0 WHERE firstname = ? AND middlename = ? AND lastname = ? AND extension = ? AND status IN (1, 2);";
		$stmt = $this->con->prepare($remove_duplicated_requests);
		$stmt->bind_param("ssss", $firstname, $middlename, $lastname, $extension);
		$stmt->execute();

        $stmt = $this->con->prepare("INSERT INTO tbl_certification_request (firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, school_course, isprinted, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact, $datetime, $pickupdate, $school_course, $status, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($symptoms){
            //Retrieve Latest ID
            $stmt = $this->con->prepare("SELECT record_id FROM tbl_certification_request WHERE record_id = (SELECT MAX(record_id) FROM tbl_certification_request)");
            $stmt->execute();
            $data = $stmt->get_result()->fetch_assoc();
            $id = $data['record_id'];

            $this->save_symptoms($id, $symptoms);
        }

        $res = 1;
        $stmt->close();
		$this->con->close();
		return $res;
	}

	public function save_symptoms($requestid, $symptoms){
		$status = 1;
		$result = 0;
		$db = new database();
		$conn = $db->connection();
		
		foreach ($symptoms as $key => $symptom) {
			$stmt = $conn->prepare("INSERT INTO tbl_requesting_patient_symptoms (request_id, symptom_id, status) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $requestid, $symptom[0], $status);
			$stmt->execute();
		}

		$result = 1;

		$stmt->close();
        $conn->close();
		return $result;
	}

	public function update_request($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact){
		$status = 1;
		$result = 0;

		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("UPDATE tbl_certification_request SET firstname = ?, middlename = ?, lastname = ?, extension = ?, address = ?, sex= ?, dob = ?, contact_number = ? WHERE record_id = ?");
		$stmt->bind_param("sssssssss", $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact, $id);
		$stmt->execute();
		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function save_findings($id, $findings){
		$result = 0;
		$datetime = date("Y-m-d h:i:s");
		$userid = $_SESSION['user_id'];
		$status = 1;

		$db = new database();
		$this->con = $db->connection();

		$stmt = $this->con->prepare("SELECT * FROM tbl_findings WHERE request_id = ? AND status = 1");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows >= 1){
			$stmt = $this->con->prepare("UPDATE tbl_findings SET status = 0 WHERE request_id = ?");
			$stmt->bind_param("s", $id);
			$stmt->execute();
		}

		if ($findings){
			foreach ($findings as $key => $finding) {
				$stmt = $this->con->prepare("INSERT INTO tbl_findings (request_id, finding, added_by, date_added, status) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("sssss", $id, $finding, $userid, $datetime, $status);
				$stmt->execute();
			}
		}
		
		$result = 1;
		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function save_note($id, $note){
		$result = 0;
		$datetime = date("Y-m-d h:i:s");
		$userid = $_SESSION['user_id'];

		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("INSERT INTO tbl_notes (request_id, note, added_by, date_added) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $id, $note, $userid, $datetime);
		$stmt->execute();
		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function toggle_request($id, $status){
		$result = 0;

		$stmt = $this->con->prepare("UPDATE tbl_certification_request SET status = ? WHERE record_id = ?");
		$stmt->bind_param("ss", $status, $id);
		$stmt->execute();
		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function toggle_requests($status, $stat = 1){
		$result = 0;

		$stmt = $this->con->prepare("UPDATE tbl_certification_request SET status = ? WHERE status = ?");
		$stmt->bind_param("ss", $status, $stat);
		$stmt->execute();
		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_request_info($id){
		$db = new database();
		$this->con = $db->connection();

		$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE record_id = ?";

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);
		$info;

		while ($stmt->fetch()) {
			$info = array('id' => $id,
								'firstname' => $firstname, 
								'middlename' => $middlename, 
								'lastname' => $lastname, 
								'extension' => $extension, 
								'address' => $address,
								'sex' => $sex,
								'dob' => $dob, 
								'contact_number' => $contact_number,
								'request_date' => $request_date,
								'pickup_date' => $pickup_date,
								'status' => $status);
		}

		$stmt->close();
        $this->con->close();
		return $info;
	}

	public function get_requests($status){
		$db = new database();
		$this->con = $db->connection();

		$query = '';

		if ($status == 2){
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status IN (1, 2) ORDER BY request_date DESC";
		}
		else{
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status = ".$status. " ORDER BY request_date DESC";
		}

		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);
		$requests = array();

		while ($stmt->fetch()) {
			$exist = 0;

			foreach ($requests as $value) {
				if (
						trim($value['firstname']) == trim($firstname) &&
						trim($value['middlename']) == trim($middlename) &&
						trim($value['lastname']) == trim($lastname) &&
						trim($value['extension']) == trim($extension)
					){
					$exist = 1;
					break;
				}
			}

			if (!($exist)){
				$requests[] = array('id' => $id,
								'firstname' => $firstname, 
								'middlename' => $middlename, 
								'lastname' => $lastname, 
								'extension' => $extension, 
								'address' => $address,
								'sex' => $sex,
								'dob' => $dob,  
								'contact_number' => $contact_number,
								'request_date' => $request_date,
								'pickup_date' => $pickup_date,
								'status' => $status);
			}
		}

		$stmt->close();
        $this->con->close();
		return $requests;
	}

	public function get_filtered_requests($requestdate, $pickupdate, $printstat, $symptomstat, $course){
		$db = new database();
		$this->con = $db->connection();
		$requests = array();
		$query = '';

		if ($course){
			$query = "SELECT tcr.record_id, tcr.firstname, tcr.middlename, tcr.lastname, tcr.extension, tcr.address, tcr.sex, tcr.dob, tcr.contact_number, tcr.request_date, tcr.pickup_date, tcr.status 
						FROM tbl_certification_request tcr
						INNER JOIN tbl_school_courses tsc ON tsc.record_id = tcr.school_course
						INNER JOIN tbl_courses tc ON tc.record_id = tsc.course_id
						WHERE tcr.status = 3
						AND tc.record_id = ".$course;

			$new_requestdate = date('Y-m-d', strtotime($requestdate));
			$new_pickupdate = date('Y-m-d', strtotime($pickupdate));

			if ($printstat == 1 | $printstat == 2){
				$query .= " AND tcr.isprinted = ".$printstat;
			}

			if ($requestdate & $pickupdate){
				$query .= " AND (DATE(tcr.request_date) = '".$new_requestdate."' OR DATE(tcr.pickup_date) = '".$new_pickupdate."')";
			}
			elseif ($requestdate){
				$query .= " AND DATE(tcr.request_date) = '".$new_requestdate."'";
			}
			elseif ($pickupdate){
				$query .= " AND DATE(tcr.pickup_date) = '".$new_pickupdate."'";
			}

			$query .= ' ORDER BY tcr.lastname ASC, tcr.firstname ASC, tcr.middlename ASC';
		}
		else{
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status = 3";

			$new_requestdate = date('Y-m-d', strtotime($requestdate));
			$new_pickupdate = date('Y-m-d', strtotime($pickupdate));

			if ($printstat == 1 | $printstat == 2){
				$query .= " AND isprinted = ".$printstat;
			}

			if ($requestdate & $pickupdate){
				$query .= " AND (DATE(request_date) = '".$new_requestdate."' OR DATE(pickup_date) = '".$new_pickupdate."')";
			}
			elseif ($requestdate){
				$query .= " AND DATE(request_date) = '".$new_requestdate."'";
			}
			elseif ($pickupdate){
				$query .= " AND DATE(pickup_date) = '".$new_pickupdate."'";
			}

			$query .= ' ORDER BY lastname ASC, firstname ASC, middlename ASC';
		}
		
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);

		while ($stmt->fetch()) {
			if (!($symptomstat)){
				$exist = 0;

				foreach ($requests as $value) {
					if (
							trim($value['firstname']) == trim($firstname) &&
							trim($value['middlename']) == trim($middlename) &&
							trim($value['lastname']) == trim($lastname) &&
							trim($value['extension']) == trim($extension)
						){
						$exist = 1;
						break;
					}
				}

				if (!($exist)){
					$requests[] = array('id' => $id,
								'firstname' => $firstname, 
								'middlename' => $middlename, 
								'lastname' => $lastname, 
								'extension' => $extension, 
								'address' => $address,
								'sex' => $sex,
								'dob' => $dob,  
								'contact_number' => $contact_number,
								'request_date' => $request_date,
								'pickup_date' => $pickup_date,
								'status' => $status);
				}
			}
			else{
				$qry = "SELECT * FROM tbl_requesting_patient_symptoms WHERE request_id = ".$id;
				$conn = $db->connection();
				$stmt2 = $conn->prepare($qry);
				$stmt2->execute();
				$result = $stmt2->get_result();
	
				if ($symptomstat == 1){
					if ($result->num_rows <= 0){
						$exist = 0;

						foreach ($requests as $value) {
							if (
									trim($value['firstname']) == trim($firstname) &&
									trim($value['middlename']) == trim($middlename) &&
									trim($value['lastname']) == trim($lastname) &&
									trim($value['extension']) == trim($extension)
								){
								$exist = 1;
								break;
							}
						}

						if (!($exist)){
							$requests[] = array('id' => $id,
									'firstname' => $firstname, 
									'middlename' => $middlename, 
									'lastname' => $lastname, 
									'extension' => $extension, 
									'address' => $address,
									'sex' => $sex,
									'dob' => $dob,  
									'contact_number' => $contact_number,
									'request_date' => $request_date,
									'pickup_date' => $pickup_date,
									'status' => $status);
						}
					}
				}
				elseif ($symptomstat == 2){
					if ($result->num_rows >= 1){
						$exist = 0;

						foreach ($requests as $value) {
							if (
									trim($value['firstname']) == trim($firstname) &&
									trim($value['middlename']) == trim($middlename) &&
									trim($value['lastname']) == trim($lastname) &&
									trim($value['extension']) == trim($extension)
								){
								$exist = 1;
								break;
							}
						}

						if (!($exist)){
							$requests[] = array('id' => $id,
								'firstname' => $firstname, 
								'middlename' => $middlename, 
								'lastname' => $lastname, 
								'extension' => $extension, 
								'address' => $address,
								'sex' => $sex,
								'dob' => $dob,  
								'contact_number' => $contact_number,
								'request_date' => $request_date,
								'pickup_date' => $pickup_date,
								'status' => $status);
						}
					}
				}
				
			}
		}

		$stmt->close();
        $this->con->close();
		return $requests;
	}

	public function get_patient_findings($id, $status = 1){
		$db = new database();
		$this->con = $db->connection();

		$query = "SELECT record_id, request_id, finding, added_by, date_added FROM tbl_findings WHERE request_id = ? AND status = ?";

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("ss", $id, $status);
		$stmt->execute();
		$stmt->bind_result($id, $requestid, $finding, $addedby, $dateadded);
		$findings = array();

		while ($stmt->fetch()) {
			$findings[] = array('id' => $id,
								'requestid' => $requestid, 
								'finding' => $finding, 
								'addedby' => $addedby, 
								'dateadded' => $dateadded);
		}

		$stmt->close();
        $this->con->close();
		return $findings;
	}

	public function get_patient_note($id){
		$db = new database();
		$this->con = $db->connection();

		$query = "SELECT record_id, request_id, note, added_by, date_added FROM tbl_notes WHERE request_id = ?";

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $requestid, $note, $addedby, $dateadded);
		$note;

		while ($stmt->fetch()) {
			$note = array('id' => $id,
								'requestid' => $requestid, 
								'note' => $note, 
								'addedby' => $addedby, 
								'dateadded' => $dateadded);
		}

		$stmt->close();
        $this->con->close();
		return $note;
	}

	public function get_patient_symptoms($id, $status = 1){
		$db = new database();
		$this->con = $db->connection();

		$query = "SELECT trps.record_id, trps.request_id, trps.symptom_id, tsc.symptoms_description
					FROM tbl_requesting_patient_symptoms trps
					INNER JOIN tbl_symptoms_checklist tsc ON tsc.record_id = trps.symptom_id
					WHERE trps.request_id = ? AND trps.status = ?";

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("ss", $id, $status);
		$stmt->execute();
		$stmt->bind_result($id, $requestid, $symp_id, $symp_desc);
		$symptoms = array();

		while ($stmt->fetch()) {
			$symptoms[] = array('id' => $id,
								'requestid' => $requestid, 
								'symp_id' => $symp_id, 
								'symp_desc' => $symp_desc);
		}

		$stmt->close();
        $this->con->close();
		return $symptoms;
	}

	public function checkSymptoms($requestid){
		$exist = 0;

		$db = new database();
		$this->con = $db->connection();

		$stmt = $this->con->prepare("SELECT * FROM tbl_requesting_patient_symptoms WHERE request_id = ? AND status = 1");
		$stmt->bind_param("s", $requestid);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows >= 1){
			$exist = 1;
		}

		$stmt->close();
        $this->con->close();
		return $exist;
	}

	public function updatePrintedStatus($requestid){
		$db = new database();
		$this->con = $db->connection();

		$stmt = $this->con->prepare("UPDATE tbl_certification_request SET isprinted = 2 WHERE record_id = ?");
		$stmt->bind_param("s", $requestid);
		$stmt->execute();

		$stmt->close();
        $this->con->close();
		return 1;
	}

	public function check_pickupdate_limit($pickup_date){
		$db = new database();
		$this->con = $db->connection();

		$pickupdate = date('Y-m-d', strtotime($pickup_date));
		$res = 0;
		$query = "SELECT DISTINCT(CONCAT(TRIM(firstname), ' ', TRIM(middlename), ' ', TRIM(lastname))) FROM tbl_certification_request WHERE pickup_date = ? AND status = 3";

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $pickupdate);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows > 600){
			$res = 1;
		}

		$stmt->close();
        $this->con->close();
		return $res;
	}

	public function print_list($ids){
		$requests = [];

		foreach ($ids as $key => $id) {
			$requests[] = $this->get_request_info($id);
		}

		return $requests;
	}
}