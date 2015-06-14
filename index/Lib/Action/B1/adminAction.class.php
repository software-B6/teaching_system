<?php
class adminAction extends userAction
{

	public function _initialize()
	{
		if(get_user_type() != 'admin')
		{
			cookie('uid', null);
			$this->redirect('/user/index');
		}
	}
	public function index()
	{
		$this->assign("actionName",'管理员账户');
		$user = D('admin');
		$info = $user->find(get_id());
		$this->info = $info;
		$this->display();
	}
	public function add_student()
	{
		$this->display();
	}
	public function add_student_execute()
	{
		if($_POST['submit'])
		{
			$s = D('student');
			
			if($s->create())
			{
				$s->add();
				$this->success("添加成功");
			}
			else
			{
				exit($s->getError());
			}
		}
		else
		{
			$this->error("错误！");
		}
		
	}

	public function add_teacher()
	{
		$this->display();
	}
	public function add_teacher_execute()
	{
		if($_POST['submit'])
		{
			$s = D('teacher');
			if($s->create())
			{
				$s->add();
				$this->success("添加成功");
			}
			else
			{
				exit($s->getError());
			}
		}
		else
		{
			$this->error("错误！");
		}
	}
	
	public function add_course()
	{
		$this->display();
	}
	public function add_course_execute()
	{
		if($_POST['submit'])
		{
			$s = D('course');
			if($s->create())
			{
				$s->add();
				$this->success("添加成功");
			}
			else
			{
				exit($s->getError());
			}
		}
		else
		{
			$this->error("错误！");
		}
	}
	public function search_student()
	{
		$this->display();
	}
	public function search_student_result()
	{
		if($_POST['id'])
			$q['id'] = $_POST['id'];
		if($_POST['name'])
			$q['name'] = $_POST['name'];
		if($_POST['admission_year'])
			$q['admission_year'] = $_POST['admission_year'];
		if($_POST['phone'])
			$q['phone'] = $_POST['phone'];
		$student = D('student');
		import('ORG.Util.Page');
		$count = $student->where($q)->count();
		if($count)
		{

			$page = new Page($count);
			$show = $page->show();
			$list = $student->where($q)->order('id')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板
		}
		else
			$this->error("不存在这样的条件");
	}

	public function delete_data($type, $id)
	{
		$data = D($type);

		if($data->delete($id))
			$this->success('删除成功');
		else
			$this->error('删除失败');
	}
	

	public function search_teacher()
	{
		$this->display();
	}
	public function search_teacher_result()
	{
		if($_POST['id'])
			$q['id'] = $_POST['id'];
		if($_POST['name'])
			$q['name'] = $_POST['name'];
		if($_POST['title'])
			$q['title'] = $_POST['title'];
		if($_POST['phone'])
			$q['phone'] = $_POST['phone'];
		if($_POST['email'])
			$q['email'] = $_POST['email'];
		$user = D('teacher');
		import('ORG.Util.Page');
		$count = $user->where($q)->count();
		if($count)
		{
			$page = new Page($count);
			$show = $page->show();
			$list = $user->where($q)->order('id')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板
		}
		else
			$this->error("不存在这样的条件");
	}


	public function search_course()
	{
		$this->display();
	}
	public function search_course_result()
	{
		if($_POST['id'])
			$q['id'] = $_POST['id'];
		if($_POST['name'])
			$q['name'] = $_POST['name'];
		if($_POST['credit'])
			$q['credit'] = $_POST['credit'];
		if($_POST['class'])
			$q['class'] = $_POST['class'];
		if($_POST['type'])
			$q['type'] = $_POST['type'];
		$course = D('course');
		import('ORG.Util.Page');
		$count = $course->where($q)->count();
		if($count)
		{
			$page = new Page($count);
			$show = $page->show();
			$list = $course->where($q)->order('id')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板
		}
		else
			$this->error("不存在这样的条件");
	}

	public function modify_student($id)
	{
		$user = D('student');
		$data = $user->find($id);

		if($data)
		{
			$this->data = $data;
			$this->display();
		}
		else
			$this->error('错误！');
	}
	public function modify_student_execute()
	{
        $user = D('student');
        if($user->create())
        {
            $result = $user->save();
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


	public function modify_teacher($id)
	{
		$user = D('teacher');
		$data = $user->find($id);

		if($data)
		{
			$this->data = $data;
			$this->display();
		}
		else
			$this->error('错误！');
	}
	public function modify_teacher_execute()
	{
        $user = D('teacher');
        if($user->create())
        {
            $result = $user->save();
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

	public function modify_course($id)
	{
		$course = D('course');
		$data = $course->find($id);

		if($data)
		{
			$this->data = $data;
			$this->display();
		}
		else
			$this->error('错误！');
	}
	public function modify_course_execute()
	{
        $course = D('course');
        if($course->create())
        {
            $result = $course->save();
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
