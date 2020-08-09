<?php
namespace app\admin\model;
use think\Model;

class KnowledgeHealthRecordModel extends Model{
    protected $table = 'tp_knowledge_health_record';

    public function user(){
        return $this->hasMany('app\admin\model\UserModel', 'user_id');
    }

    public function health()
    {
        return $this->hasMany('app\admin\model\KnowledgeHealthModel', 'health_id');
    }

}
?>
 