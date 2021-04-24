<?php

class siteModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function process_faq($id, $question, $answer){
		$status = 1;
		$result = 0;

		if ($id == 0){
			$stmt = $this->con->prepare("INSERT INTO tbl_faqs (question, answer, status) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $question, $answer, $status);
			$stmt->execute();
			$result = 1;
		}
		else{
			$query = "SELECT * FROM tbl_faqs WHERE record_id = ".$id;

			if (mysqli_num_rows(mysqli_query($this->con, $query)) >= 1){
				$stmt = $this->con->prepare("UPDATE tbl_faqs SET question = ?, answer = ? WHERE record_id = ?");
				$stmt->bind_param("sss", $question, $answer, $id);
				$stmt->execute();
				$result = 2;
			}
		}

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_faqs($status){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, question, answer, status FROM tbl_faqs WHERE status = ".$status);
		$stmt->execute();
		$stmt->bind_result($id, $question, $answer, $status);
		$faqs = array();

		while ($stmt->fetch()) {
			$faqs[] = array('id' => $id, 
							'question' => $question,
							'answer' => $answer,
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $faqs;
	}

	public function get_faq_info($id){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, question, answer, status FROM tbl_faqs WHERE record_id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $question, $answer, $status);
		$faq_info = array();

		while ($stmt->fetch()) {
			$faq_info = array('id' => $id, 
								'question' => $question,
								'answer' => $answer,
								'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $faq_info;
	}

	public function toggle_faq($id, $status){
		
		$stmt = $this->con->prepare("UPDATE tbl_faqs SET status = ? WHERE record_id = ?");
		$stmt->bind_param("ss", $status, $id);
		$stmt->execute();
		$result = 1;		

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function process_photo($caption, $url){
		$status = 1;
		$result = 0;

		$stmt = $this->con->prepare("INSERT INTO tbl_gallery (caption, url, status) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $caption, $url, $status);
		$stmt->execute();
		$result = 1;

		$stmt->close();
		$this->con->close();
		return $result;
	}

	public function get_photos($status){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, caption, url, status FROM tbl_gallery WHERE status = ".$status);
		$stmt->execute();
		$stmt->bind_result($id, $caption, $url, $status);
		$photos = array();

		while ($stmt->fetch()) {
			$photos[] = array('id' => $id, 
								'caption' => $caption,
								'url' => $url,
								'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $photos;
	}

	public function get_photo_info($id){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT record_id, caption, url, status FROM tbl_gallery WHERE record_id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->bind_result($id, $caption, $url, $status);
		$photo_info = array();

		while ($stmt->fetch()) {
			$photo_info = array('id' => $id, 
									'caption' => $caption,
									'url' => $url,
									'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $photo_info;
	}

	public function toggle_photo($id, $status){
		
		$stmt = $this->con->prepare("UPDATE tbl_gallery SET status = ? WHERE record_id = ?");
		$stmt->bind_param("ss", $status, $id);
		$stmt->execute();
		$result = 1;		

		$stmt->close();
		$this->con->close();
		return $result;
	}


}