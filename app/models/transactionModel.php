<?php

class transactionModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function process_request($firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact, $pickupdate, $symptoms){
		$status = 1;
		$result = 0;
		$datetime = date("Y-m-d h:i:s");

		$db = new database();
		$this->con = $db->connection();
		
		//Save Request
		$stmt = $this->con->prepare("INSERT INTO tbl_certification_request (firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, isprinted, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssssss", $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact, $datetime, $pickupdate, $status, $status);
		$stmt->execute();

		if ($symptoms){
			//Retrieve Latest ID
			$stmt = $this->con->prepare("SELECT record_id FROM tbl_certification_request WHERE record_id = (SELECT MAX(record_id) FROM tbl_certification_request)");
			$stmt->execute();
			$data = $stmt->get_result()->fetch_assoc();
			$id = $data['record_id'];

			$this->save_symptoms($id, $symptoms);
		}

		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function save_symptoms($requestid, $symptoms){
		$status = 1;
		$result = 0;
		$db = new database();
		$this->con = $db->connection();
		
		foreach ($symptoms as $key => $symptom) {
			$stmt = $this->con->prepare("INSERT INTO tbl_requesting_patient_symptoms (request_id, symptom_id, status) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $requestid, $symptom, $status);
			$stmt->execute();
		}

		$result = 1;

		$stmt->close();
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

		foreach ($findings as $key => $finding) {
			$stmt = $this->con->prepare("INSERT INTO tbl_findings (request_id, finding, added_by, date_added, status) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sssss", $id, $finding, $userid, $datetime, $status);
			$stmt->execute();
			$result = 1;
		}
		
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
		return $info;
	}

	public function get_requests($status){
		$db = new database();
		$this->con = $db->connection();

		$query = '';

		if ($status == 2){
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status IN (1, 2)";
		}
		else{
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status = ".$status;
		}

		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);
		$requests = array();

		while ($stmt->fetch()) {
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

		$stmt->close();
		return $requests;
	}

	public function get_filtered_requests($date, $printstat, $symptomstat){
		$db = new database();
		$this->con = $db->connection();
		$requests = array();

		if ($printstat){
			$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status = 3";

			if ($printstat == 1 | $printstat == 2){
				$query .= " AND isprinted = ".$printstat;
			}

			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);

			while ($stmt->fetch()) {
				if (!($symptomstat)){
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
				else{
					$qry = "SELECT * FROM tbl_requesting_patient_symptoms WHERE request_id = ".$id;
					$conn = $db->connection();
					$stmt2 = $conn->prepare($qry);
					$stmt2->execute();
					$result = $stmt2->get_result();
		
					if ($symptomstat == 1){
						if ($result->num_rows <= 0){
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
					elseif ($symptomstat == 2){
						if ($result->num_rows >= 1){
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

			$stmt->close();
		}
		else{
			if ($date){
				$query = "SELECT record_id, firstname, middlename, lastname, extension, address, sex, dob, contact_number, request_date, pickup_date, status FROM tbl_certification_request WHERE status = 3";
				$new_date = date('Y-m-d', strtotime($date));

				if ($date){
					$query .= " AND DATE(request_date) = '".$new_date."'";
				}

				$stmt = $this->con->prepare($query);
				$stmt->execute();
				$stmt->bind_result($id, $firstname, $middlename, $lastname, $extension, $address, $sex, $dob, $contact_number, $request_date, $pickup_date, $status);

				while ($stmt->fetch()) {
					if (!($symptomstat)){
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
					else{
						$qry = "SELECT * FROM tbl_requesting_patient_symptoms WHERE request_id = ".$id;
						$conn = $db->connection();
						$stmt2 = $conn->prepare($qry);
						$stmt2->execute();
						$result = $stmt2->get_result();
			
						if ($symptomstat == 1){
							if ($result->num_rows <= 0){
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
						elseif ($symptomstat == 2){
							if ($result->num_rows >= 1){
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

				$stmt->close();
			}
		}

		
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
		return $note;
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
		return $exist;
	}

	public function updatePrintedStatus($requestid){
		$db = new database();
		$this->con = $db->connection();

		$stmt = $this->con->prepare("UPDATE tbl_certification_request SET isprinted = 2 WHERE record_id = ?");
		$stmt->bind_param("s", $requestid);
		$stmt->execute();

		$stmt->close();
		return 1;
	}
}