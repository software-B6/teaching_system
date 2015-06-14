<?php

class CalendarAction extends Action {
    const actionName="显示课表";

    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }

    public function index() {
        $model=M();

        $list= $model->query("
            SELECT * FROM student_course WHERE student_id = 2
        ");

        $calendar=array();

        for($x=0;$x<7;$x++){
            $calendar[$x]=array();
            for($y=0;$y<13;$y++){
                $calendar[$x][$y]="";
            }
        }

        foreach ($list as $class){
            $class_id=$class["course_class_id"];
            $course_class=$model->query("
                SELECT * FROM course_class WHERE id ='%d'",$class_id
            );
            $course_id=$course_class[0]["course_id"];
            $course_name=$model->query("
                SELECT name FROM course WHERE id ='%d'",$course_id
            );
            $course_name=$course_name[0]["name"];
//            print_r($course_name);
            $class_info=$course_class[0]["class_info"];
            $class_info=json_decode($class_info,true);
            $class_info=$class_info["class_info"];
            foreach ($class_info as $item){
//                print_r($item["day"]);
//                print_r($item["time"]);
                $col=0;
                if($item["day"]=="monday"){
                    $col=0;
                }elseif($item["day"]=="tuesday"){
                    $col=1;
                }elseif($item["day"]=="wednesday"){
                    $col=2;
                }elseif($item["day"]=="thursday"){
                    $col=3;
                }elseif($item["day"]=="friday"){
                    $col=4;
                }elseif($item["day"]=="saturday"){
                    $col=5;
                }elseif($item["day"]=="sunday"){
                    $col=6;
                }
                foreach ($item["time"] as $time){
                    $row=$time;
//                    print_r($row);
                    $calendar[$col][$row]=$course_name;
                }
            }
        }
        $this->calendar=$calendar;
        $this->display();
//        print_r($this->calendar);
    }

}
