<?php
/**
 * Created by PhpStorm.
 * User: Li Shunan
 * Date: 2015/6/1
 * Time: 8:59
 */

class SelectionAction extends Action{
    const actionName="选课模块";

    function __construct() {
        parent::__construct();
        include_once("index/Common/common.php");
        $this->assign("actionName",self::actionName);

        if("student"!=get_user_type())
        {
            die("您不是学生！");
        }
    }

    public function index()
    {
        $this->display();
        echo get_id();
        echo get_user_type();
    }

    public function drop($id=null)
    {
        if(!$this->can_xk())
        {
            $this->assign("message","非选课时段！");
            $this->display("index");
            return;
        }

        $student_id=get_id();
        if($id==null)
        {
            $this->assign("message","缺少课程代码参数！");
            $this->display("index");
            return;
        }

        if(!$this->is_class_exist($id))
        {
            $this->assign("message", "无此课程代码");
            $this->display("index");
            return;
        }

        $model=M();
        $result=$model->query("
            select * from student_course
            WHERE course_class_id='%d'
             AND student_id='%d'
        ",$id,$student_id);

        if(sizeof($result)==0)
        {
            $this->assign("message", "您并未选上此课程");
            $this->display("index");
            return;
        }
        else
        {
            $class=$result[0];
            if($class['finished'])
            {
                $this->assign("message", "此课程已结束");
                $this->display("index");
                return;
            }
            else
            {
                $model=M();
                $model->query("
                    DELETE FROM student_course WHERE student_id='%d'
                ",$student_id);
                $this->assign("message", "退课成功");
                $this->display("index");
                return;
            }
        }

    }

    public function replenish($id=null)
    {
        if(!$this->can_bx())
        {
            $this->assign("message","非补选时段！");
            $this->display("index");
            return;
        }

        $student_id=get_id();
        if($id==null)
        {
            $this->assign("message","缺少课程代码参数！");
            $this->display("index");
            return;
        }

        if(!$this->is_class_exist($id))
        {
            $this->assign("message", "无此课程代码");
            $this->display("index");
            return;
        }

        $conflict = $this->has_conflict($id, $student_id);

        if(!$conflict)
        {
            $model=M();
            $model->query("
            INSERT INTO student_course_add VALUE (DEFAULT ,'%d','%d',FALSE)
              ",$student_id,$id);
            $this->assign("message","补选请求已提交！");

        }
        else if($conflict==$id)
        {
            $this->assign("message","您已选上该课程！");
        }
        else
        {
            $model=M();
            $name=$model->query("
                select *,course_class.id as class_id
                from course_class JOIN course
                WHERE course_class.course_id=course.id
                and course_class.id='%d'
            ",$id)[0]['name'];

            $this->assign("message","补选与<a href='__APP__/B3/Course/view/id/".$conflict."'>".$name."</a>冲突！");
        }
        $this->display("index");

    }

    public function add($id=null)
    {
        if(!$this->can_xk())
        {
            $this->assign("message","非选课时段！");
            $this->display("index");
            return;
        }

        $student_id=get_id();
        if($id==null)
        {
            $this->assign("message","缺少课程代码参数！");
            $this->display("index");
            return;
        }

        if(!$this->is_class_exist($id))
        {
            die("课程不存在");
        }

        $model=M();
        $result=$model->query("
            select * from course_class
            WHERE id='%d'
        ",$id);

        if($result[0]['capacity']<=$result[0]['certainty'])
        {
            $this->assign("message","选课人数已满！");
            $this->display("index");
            return;
        }

        $conflict = $this->has_conflict($id, $student_id);

        if(!$conflict)
        {
            $model=M();
            $model->query("
            INSERT INTO student_course VALUE (DEFAULT ,'%d','%d',FALSE ,FALSE ,0)
              ",$student_id,$id);
            $this->assign("message","选课成功！");

        }
        else if($conflict==$id)
        {
            $this->assign("message","您已选上该课程！");
        }
        else
        {
            $model=M();
            $name=$model->query("
                select *,course_class.id as class_id
                from course_class JOIN course
                WHERE course_class.course_id=course.id
                and course_class.id='%d'
            ",$id)[0]['name'];

            $this->assign("message","选课与<a href='__APP__/B3/Course/view/id/".$conflict."'>".$name."</a>冲突！");

        }
        $this->display("index");


    }

    /**
     * @param $id
     * @param $student_id
     * @return bool
     */
    private function has_conflict($id, $student_id)
    {
        $model = M();

        $class_time = $model->query("
            SELECT class_info,course.name as course_name, course_class_id
            from student_course INNER JOIN course_class INNER JOIN course
            WHERE student_course.course_class_id=course_class.id
            and course.id=course_class.course_id
            AND student_id='%d'", $student_id
        );

        $calendar = array();

        if(sizeof($class_time)==0)
        {
            return false;
        }

        foreach ($class_time as $class) {
            $json = json_decode($class['class_info'], true);
            //var_dump($class);
            //echo json_last_error_msg();
            foreach ($json['class_info'] as $class_info) {
                //    print_r($class_info);
                foreach ($class_info['time'] as $time) {
                    if (!isset($calendar[$class_info['day']][$time])) {
                        $calendar[$class_info['day']][$time] = $class['course_class_id'];
                    } else if ($calendar[$class_info['day']][$time] == false) {
                        $calendar[$class_info['day']][$time] = $class['course_class_id'];
                    }
                }
            }
        }

       // print_r($calendar);

        $class_info_to_add = $model->query("
            SELECT class_info
            from course_class
            WHERE  course_class.id='%d'", $id
        );

        $json = json_decode($class_info_to_add[0]['class_info'], true);
       // var_dump($class_info_to_add);
        //echo json_last_error_msg();

        $conflict = false;
        foreach ($json['class_info'] as $class_info) {
           // print_r($class_info);
            foreach ($class_info['time'] as $time) {
                if (!isset($calendar[$class_info['day']][$time])) {
                    $calendar[$class_info['day']][$time] = $class['course_class_id'];
                } else {
                    $conflict = $calendar[$class_info['day']][$time];
                }
            }
        }
        return $conflict;
    }

    /**
     * @param $id
     * @return bool
     */
    private function is_class_exist($id)
    {
        $model = M();
        $course_class = $model->query("
            select * from course_class WHERE id='%d'", $id
        );
        if (sizeof($course_class) == 0) {

            return false;
        } else
            return true;
    }

    /**
     * @return bool
     */
    private function can_xk()
    {
        $model = M();
        $result = $model->query("
          SELECT  * FROM timeset LIMIT 1;
        ");
        $today = date("Y-m-d");
        $result = $result[0];
        if (
            ($today >= $result['xk1_s'] && $today <= $result['xk1_e'])
            || ($today >= $result['xk2_s'] && $today <= $result['xk2_e'])
            || ($today >= $result['xk3_s'] && $today <= $result['xk3_e'])
        )
            return true;
        else
            return false;
    }

    private function can_bx()
    {
        $model = M();
        $result = $model->query("
          SELECT  * FROM timeset LIMIT 1;
        ");
        $today = date("Y-m-d");
        $result = $result[0];
        if (
            ($today >= $result['bx1_s'] && $today <= $result['bx1_e'])
            || ($today >= $result['bx2_s'] && $today <= $result['bx2_e'])
            || ($today >= $result['bx3_s'] && $today <= $result['bx3_e'])
        )
            return true;
        else
            return false;
    }
}