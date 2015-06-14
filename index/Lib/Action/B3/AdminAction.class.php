<?php

class AdminAction extends Action {
    const actionName="管理操作";

    public function _initialize()
    {
        if(get_user_type() != 'admin')
        {
            cookie('uid', null);
            $this->redirect('/user/index');
        }
    }

    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }

    public function index() {
        $model=M('Timeset');
        $list=$model->where("year_id=1")->select();

        $this->assign("list",$list);
        $this->display("admin");
    }

    //  设置选课时间
    public function settime() {
        $data=I('post.');
        $model=M('Timeset');
        $result=$model->where("year_id=1")->save($data);
        if($result==false)
        {
            echo "<script>alert('Error!');history.back();</script>";
        } else {
            echo "<script>alert('Success!');history.back();</script>";
        }
    }

    public function add()
    {
        // 需要定期清空数据表
        $order=I('get.order',0);
        $model=M('Student_course_add');
        switch ($order) {
            case 1:
                $opt='Student_course_add.student_id desc';
                break;
            case 2:
                $opt='course.name desc';
                break;
            case 3:
                $opt='Student_course_add.course_class_id desc';
                break;
            default:
                $opt='Student_course_add.id asc';
                break;
        }
        $list=$model->where("confirmed=%d",0)->join("course_class ON course_class_id=course_class.id")->join("course ON course_class.course_id=course.id")->order($opt)->field('Student_course_add.id, Student_course_add.student_id, Student_course_add.course_class_id, course.name')->select();
        //echo var_dump($opt);
        //echo var_dump($order);
        //echo var_dump($list);
        echo json_encode($list);
    }

    public function addDB()
    {
        $model=M('Student_course_add');
        $Relation=M('Student_course');
        
        $addstr=I('post.addstr');
        $ids=explode(',',rtrim($addstr,','));
        $data['confirmed']=1;
        $map['id']=array('in',$ids);

        $op1=$model->where($map)->save($data);
        if ($op1==false) exit('Error');
        $op2=$model->where($map)->field('student_id, course_class_id, confirmed')->select();
        if ($op2==false) exit('Error');
        $op3=$Relation->addAll($op2);
        if ($op3==false) exit('Error');
    }

    public function del()
    {
        // 需要定期清空数据表
        $order=I('get.order',0);
        $idnum=I('get.idnum');
        $model=M('Student_course');
        switch ($order) {
            case 1:
                $opt='Student_course.confirmed desc';
                break;
            case 2:
                $opt='course.name desc';
                break;
            case 3:
                $opt='Student_course.course_class_id desc';
                break;
            default:
                $opt='Student_course.id asc';
                break;
        }
        $list=$model->where("student_id=%d",$idnum)->join("course_class ON course_class_id=course_class.id")->join("course ON course_class.course_id=course.id")->order($opt)->field('Student_course.id, Student_course.confirmed, Student_course.course_class_id, course.name')->select();
        //echo var_dump($opt);
        //echo var_dump($order);
        //echo var_dump($list);
        echo json_encode($list);
    }

    public function delDB()
    {
        $Relation=M('Student_course');
        
        $delstr=I('post.delstr');
        $ids=explode(',',rtrim($delstr,','));
        $map['id']=array('in',$ids);

        if ($Relation->where($map)->delete()==false) exit("Error");
    }


    public function filter()
    {
        $Course=M('Course_class');
        $Relation=M('Student_course');

        $account=$Course->count();
        $base=0;
        // 前提：课程只增不减不改，否则新增一个year列
        for ($i=1; $i<=$account; $i++) {
            $real_id=$i+$base;
            $check_array=$Course->where("id=%d",$real_id)->getField('capacity, certainty, uncertainty');
            if ($check_array===false) {
                exit('Error');
            } else if (is_null($check_array)) {
                $base+=1;
                $i-=1;
                continue;
            }
            $total=(int)current($check_array)['certainty']+(int)current($check_array)['uncertainty'];
            $capacity=(int)current($check_array)['capacity'];
            // 如果容量为负数则不能通过常规系统选课，必须通过其它途径，否则会直接选上
            if ((int)$total<$capacity||$capacity<=(int)current($check_array)['certainty']) {
                continue;
            } else {
                $ids=$Relation->where("course_class_id=%d",$real_id)->getField('id',true);
                shuffle($ids);
                $real_ids=array_slice($ids,0,$capacity);
                $map['id']=array('not in',$real_ids);
                $map['course_class_id']=array('eq',$real_id);
                if ($Relation->where($map)->delete()==false) exit("Error");
            }
        }
        $data['confirmed']=1;
        $Relation->where('confirmed=0')->save($data);
    }
}
