<?php
namespace app\admin\model;
use think\Model;

class KnowledgeHealthModel extends Model{
    protected $table = 'tp_knowledge_health';

    public function question(){
        return $this->hasMany('app\admin\model\KnowledgeHealthQuestionModel', 'health_id');
    }

}
?>
 