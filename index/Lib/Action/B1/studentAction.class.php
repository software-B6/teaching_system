<?php
class studentAction extends userAction
{
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
        $user = D('student');
        $info = $user->find(get_id());
        $this->info = $info;
        $this->display();
    }
    public function update()
    {
        $stu = D('student');
        if($stu->create())
        {
            $result = $stu->save();
            if($result)
            {
                $this->success('修改成功！');
            }
            else
            {
                $this->error('修改失败！');
            }
        }
    }
}
