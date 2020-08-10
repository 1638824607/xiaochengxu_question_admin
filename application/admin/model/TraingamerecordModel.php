<?php
namespace app\admin\model;
use think\Model;

class TraingamerecordModel extends Model{
    protected $table = 'tp_train_game_record';

    public function user(){
        return $this->belongsTo('app\admin\model\UserModel', 'user_id');
    }

    public function game()
    {
        return $this->belongsTo('app\admin\model\TraingameModel', 'game_id');
    }

}
?>
 