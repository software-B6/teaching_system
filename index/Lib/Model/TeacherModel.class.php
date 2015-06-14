<?php
class teacherModel extends userModel
{
    protected $_auto = array (
        array('create_time','timestamp',2,'function'), // 对create_time字段在更新的时候写入当前时间戳
        array('password','md5',3,'function'),
        );
	protected $_validate = array(
        array('id','', 'id已经存在', Model::MUST_VALIDATE, 'unique', Model::MODEL_INSERT),
        array('id','require','id必须！'),
        array('name','require','姓名必须！'),
        array('password','require','密码必须！'),
        );
}
