<?php
class userModel extends Model
{
    public function exist_id($id)
    {
        $user['id'] = $id;
        $info = $this->where($user)->select();
        if($info)
            return true;
        else
            return false;
    }
}
