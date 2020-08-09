<?php
namespace app\admin\model;
use think\Model;

class KnowledgeHealthQuestionModel extends Model{
    protected $table = 'tp_knowledge_health_question';

    public static $questionType = [
        1 => '选择',
        2 => '问答',
    ];
}
?>
 