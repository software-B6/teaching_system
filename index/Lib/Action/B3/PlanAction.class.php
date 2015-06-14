<?php

class PlanAction extends Action {
    const actionName="培养方案查看";

    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }

    public function index() {
        $this->display("index");
    }

    public function getPlanJson($major = '') {
        //if ($major == "计算机") {
            $json = json_encode($this->get_all_category());
            echo '<pre />';
            print_r($json);
            echo "\n\n";
            return $json;
        //}
    }

    public function getPlan($major = '') {
        //if ($major == "计算机") {
            $result = $this->get_all_category();
            return $result;
        //}
    }

    // 大类必修
    public function category01() {
        $courseArray = array();
        $courseArray[] = $this->get_course(1);
        $courseArray[] = $this->get_course(12);
        $courseArray[] = $this->get_course(15);
        $courseArray[] = $this->get_course(7);
        return $courseArray;
    }

    // 大类选修
    public function category02() {
        $courseArray = array();
        $courseArray[] = $this->get_course(3);
        $courseArray[] = $this->get_course(9);
        $courseArray[] = $this->get_course(10);
        $courseArray[] = $this->get_course(11);
        return $courseArray;
    }

    // 专业必修
    public function category03() {
        $courseArray = array();
        $courseArray[] = $this->get_course(2);
        $courseArray[] = $this->get_course(13);
        $courseArray[] = $this->get_course(14);
        return $courseArray;
    }

    // 专业选修
    public function category04() {
        $courseArray = array();
        $courseArray[] = $this->get_course(4);
        $courseArray[] = $this->get_course(16);
        $courseArray[] = $this->get_course(17);
        return $courseArray;
    }

    public function get_all_category() {
        $data = array();

        $category['course'] = $this->category01();
        $category['credit'] = 10;
        $data['大类必修'] = $category;

        $category['course'] = $this->category02();
        $category['credit'] = 15;
        $data['大类选修'] = $category;

        $category['course'] = $this->category03();
        $category['credit'] = 10;
        $data['专业必修'] = $category;

        $category['course'] = $this->category04();
        $category['credit'] = 12;
        $data['专业选修'] = $category;

        return $data;
    }

    public function view() {
        $data = $this->get_all_category();
        //print_r($data);
        $this->assign("data", $data);
        $this->display("plan_result");
    }

    private function get_course($id) {
        $Course = M("Course");
        return $Course->find($id);
    }
}
