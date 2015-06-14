<?php

class CourseAction extends Action {
    const actionName="课程搜索与查看";

    function __construct() {
        parent::__construct();
        include_once("index/Common/common.php");
        $this->assign("actionName",self::actionName);

        if("student"==get_user_type())
        {
            //未选该课程
            //已选
            //已选上
            //正在补选
            //已出成绩
        }
    }

    public function index() {
       $this->display("search");
    }

    public function do_search() {
        $keyword= $this->_param('keyword');

        $model=M();

        $list= $model->query("
            SELECT *,course_class.id as class_id,teacher.name as teacher_name,teacher_id,course.name as course_name
            FROM `course_class` INNER JOIN course ON course_id = course.id INNER JOIN teacher on teacher_id=teacher.id
            WHERE course.name like '%s'",'%'.$keyword . '%');

        $this->assign("list",$list);
        $this->display("search_result");
       // print_r($model->getLastSql());
       // print_r($list);
    }

    public function view($id=null)
    {
        if($id==null)
        {
            echo "id not set";
            return;
        }
        $model=M();
        $result=$model->query("
          SELECT *,
          course_class.id as course_class_id,
          teacher.name as teacher_name,
          course.name as course_name,
          course.description as course_description
          FROM `course_class`
          INNER JOIN course ON course_id = course.id
          INNER JOIN teacher on teacher.id = course_class.teacher_id
          WHERE course_class.id='%d'",$id
        );

        if(sizeof($result)==0)
        {
            echo "bad id";
            return;
        }

        $this->assign("result",$result[0]);
        $this->display("view_course");
    }
}
