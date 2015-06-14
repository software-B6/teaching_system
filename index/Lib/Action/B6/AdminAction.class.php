<?php

class AdminAction extends Action {
	
    const actionName="成绩修改申请处理";

	/*
    public function _initialize()
    {
        if(get_user_type() != 'admin')
        {
            cookie('uid', null);
            $this->redirect('/user/index');
        }
    }
	*/
	
    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }
	
    public function index(){
		
		// $data = M('modify_request_old') -> where(array('state=false')) -> field('id, course_id, course_name, student_id, student_name, old_grade, new_grade, reason') -> select();
		
		// $data = M('modify_request') -> join('student_course on modify_request.student_course_id = student_course.id') ->
	// 		join('student on student_course.student_id = student.id') -> join('course_class on course_class.id = student_course.course_class.id')
	// 			-> join('course_name')
	
		$Model = new Model();
		
		$sql = 'select modify_request.id, course.id as course_id, course.name as course_name, student.id as student_id, student.name as student_name, student_course.grade as old_grade, new_grade, reason from modify_request join student_course join student join course_class join course  where modify_request.student_course_id = student_course.id and student_course.student_id = student.id and student_course.course_class_id = course_class.id and course_class.course_id = course.id and modify_request.state = "x"';
			
		$data = $Model->query($sql);
		
		//p($data);
		$this -> data = $data;
		$this -> display();
    }
	
	public function handle(){
		// p(I('post.'));
		$this->redirect('B6/Admin/template');
		
		// if(!IS_POST) _404('页面不存在..', U('index'));
		
	}
	
	public function agree(){
		$id = I('post.id');
		$Model = new Model();
		$sql = 'update modify_request set state = "y" where id = ' . I("post.id");
		//p($sql);
		$result = $Model -> execute($sql);
		$this->ajaxReturn($result, 'json');
		//p($result);
	}
	
	public function disagree(){
		$id = I('post.id');
		$Model = new Model();
		$sql = 'update modify_request set state = "n" where id = ' . I("post.id");
		//p($sql);
		$result = $Model -> execute($sql);
		$this->ajaxReturn($result, 'json');
		//p($result);
	}
	
}
?>