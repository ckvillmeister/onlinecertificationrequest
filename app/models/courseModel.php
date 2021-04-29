<?php

class courseModel extends model{

	private $con;

	public function __construct(){
		$db = new database();
		$this->con = $db->connection();
	}

	public function get_school_courses($schoolid, $status){
		$db = new database();
		$this->con = $db->connection();
		$stmt = $this->con->prepare("SELECT tsc.record_id, tc.course_code, tc.course_description, tc.status 
										FROM tbl_school_courses tsc
										INNER JOIN tbl_courses tc ON tc.record_id = tsc.course_id
										WHERE tsc.school_id = ".$schoolid." AND tsc.status = ".$status);
		$stmt->execute();
		$stmt->bind_result($id, $course_code, $course_description, $status);
		$courses = array();

		while ($stmt->fetch()) {
			$courses[] = array('id' => $id, 
							'code' => $course_code, 
							'desc' => $course_description,
							'status' => $status);
		}
		$stmt->close();
		$this->con->close();
		return $courses;
	}
}