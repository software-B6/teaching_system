<?php

class ListAction extends Action {
    const actionName="学生名单";

    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }

    public function index() {
        $model=M();
        $name_id_list=array();
        $course_ids=$model->query("
            SELECT id,course_id FROM course_class WHERE teacher_id=2
        ");
        $index=0;
        foreach($course_ids as $course){
            $id=$course["course_id"];
            $course_name=$model->query("
                SELECT name FROM course WHERE id='%d'",$id
            );
            $name=$course_name[0]["name"];
            $name_id_list[$index]=array($name,$course["id"]);
            $index++;
        }
        $this->name_id_list=$name_id_list;
        $this->display();
//        print_r($this->name_id_list);
    }

    public function show_list(){
        $course_id=$this->_param("course");
        $model=M();
        $student_ids=$model->query("
            SELECT student_id FROM student_course WHERE course_class_id='%s'",$course_id
        );
        $student_info_list=array();
        $index=0;
        foreach($student_ids as $student_id){
            $student_info=$model->query("
                SELECT name,major FROM student WHERE id='%d'",$student_id
            );
            $student_info_list[$index]=$student_info[0];
            $index++;
        }
        $this->student_info_list=$student_info_list;
        $this->display("show_list");
//        print_r($this->student_info_list);
    }
}
