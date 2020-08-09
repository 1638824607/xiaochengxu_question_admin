<?php
namespace app\admin\model;
use think\Model;

class KnowledgeHealthRecordModel extends Model{
    protected $table = 'tp_knowledge_health_record';

    public function user(){
        return $this->belongsTo('app\admin\model\UserModel', 'user_id');
    }

    public function health()
    {
        return $this->belongsTo('app\admin\model\KnowledgeHealthModel', 'health_id');
    }

}
?>
 