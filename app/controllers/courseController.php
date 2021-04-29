<?php

class courseController extends controller{

	public function retrieve_courses(){
		$schoolid = isset($_POST['school_id']) ? $_POST['school_id'] : 0;

		$course_model = new courseModel();
		$courses = $course_model->get_school_courses($schoolid, 1);
		
		echo json_encode($courses);
	}

}