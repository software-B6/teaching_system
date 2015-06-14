<?php

class CreditAction extends Action
{
	 const actionName="学分统计";
	
    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }

    public function _initialize()
    {
        if(get_user_type() != 'student')
        {
            cookie('uid', null);
            $this->redirect('/user/index');
        }
    }

    public function index()
    {
        $this->display("credit");
    }

    public function getCreditInfo()
    {
	 	// echo '<pre />';
	 	$User = A('B3/Plan');
	 	$creditListData = $User->getPlan();

	 	$data = array();

	 	// to change ,will get the by student id
	 	$student_id = get_id();

	 	$DataBase = new Model();
	 	$myCourseList = $DataBase->select();
	 	$myCourseList = $DataBase->query("SELECT student_course.*,course_class.course_id FROM student_course, course_class".
                " WHERE student_course.course_class_id = course_class.id and student_course.student_id=".$student_id);

	 	$i = 0;
	 	foreach($creditListData as $x=>$x_value)
	 	{
	 		// var_dump($x);
	 		// var_dump($x_value);
	 		$creditClass = array();
	 		$standard = $x_value['credit'];
	 		$creditClassCourseList = $x_value['course'];
	 		$creditClass["name"] = $x;
	 		$creditClass["standard"] = $standard;
	 		$creditClass["actualCredits"] = 0;

	 		$j=0;
	 		foreach ($myCourseList as $myCourse) 
	 		{
	 			// deal if student can get the score
	 			if($myCourse["grade"] < 60) continue;

	 			// echo $creditClass["name"].":".$j."  test my course id:".$myCourse["course_id"]."\n";
 				foreach ($creditClassCourseList as $classCourse) 
		 		{
		 			// echo "\t培养计划中的课程".$classCourse["id"]."  ".$classCourse["name"]."\n";
		 			if($classCourse["id"] == $myCourse["course_id"])
		 			{
	 					$creditClass["actualCredits"] += $classCourse["credit"];
	 					// echo "\t\t"."yes:".$classCourse["credit"]."\n";
	 					break;
		 			}
		 		}
	 			$j++;
	 		}

	 		$data[$i] = $creditClass;
	 		$i++;
		}
		echo json_encode($data);
    }
}