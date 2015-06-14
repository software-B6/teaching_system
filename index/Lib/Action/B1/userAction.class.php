<?php
class userAction extends Action
{
	public function _initialize()
	{
		if(cookie('uid') || ($_GET["_URL_"][0] == 'user' && $_GET["_URL_"][1] == 'index')
			|| ($_GET["_URL_"][0] == 'user' && $_GET["_URL_"][1] == 'login'))
			;
		else
		{
			$this->redirect('/user/index');
		}
	}
	public function index()
	{
		$this->display();
	}
	public function login()
	{
		$user = D($_POST['user_type']);
		$info['id'] = $_POST['id'];
		if($_POST['user_type'] == 'admin')
			$info['password'] = $_POST['password'];
		else
			$info['password'] = md5($_POST['password']);

		if($user->where($info)->select())
		{
			cookie('uid',authcode($_POST['id'].' '.$_POST['user_type'], 'ENCODE'));
			$this->redirect('/'.$_POST['user_type']);
		}
		else
			$this->error("用户名或者密码不正确！");
	}
    public function logout()
    {
        cookie('uid', null);
        echo "<script>window.location.href='B1/user/index';</script>";
    }
}