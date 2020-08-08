<?php
namespace app\admin\model;
use think\Model;

class KnowledgeMatchModel extends Model{
    protected $table = 'tp_knowledge_match';

    public function question(){
        return $this->hasMany('app\admin\model\KnowledgeMatchQuestionModel', 'match_id');
    }

}
?>
 