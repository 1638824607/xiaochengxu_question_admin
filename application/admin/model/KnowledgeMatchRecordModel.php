<?php
namespace app\admin\model;
use think\Model;

class KnowledgeMatchRecordModel extends Model{
    protected $table = 'tp_knowledge_match_record';

    public function user(){
        return $this->belongsTo('app\admin\model\UserModel', 'user_id');
    }

    public function match()
    {
        return $this->belongsTo('app\admin\model\KnowledgeMatchModel', 'match_id');
    }

}
?>
 