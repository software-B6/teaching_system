<?php
class teacherAction extends userAction
{
    public function _initialize()
    {
        if(get_user_type() != 'teacher')
        {
            cookie('uid', null);
            $this->redirect('/user/index');
        }
    }
    public function index()
    {
        $user = D('teacher');
        $info = $user->find(get_id());
        $this->info = $info;
        $this->display();
    }
    public function update()
    {
        $teacher = D('teacher');
        if($teacher->create())
        {
            $result = $teacher->save();
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

    public function course()
    {
        
    }
}
