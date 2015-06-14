<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    const actionName="首页";

    function __construct() {
        parent::__construct();
        $this->assign("actionName",self::actionName);
    }
    public function index(){
        $user_type="teacher";

        if($user_type=='admin')
        {
            $this->redirect('Admin/index');
        }
        else if('student'==$user_type||'teacher'==$user_type)
        {
            $this->redirect('Calendar/index');
        }
        else
        {
            $this->redirect('Course/index');
        }
    }
}
