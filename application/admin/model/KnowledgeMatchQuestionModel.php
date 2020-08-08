<?php
namespace app\admin\model;
use think\Model;

class KnowledgeMatchQuestionModel extends Model{
    protected $table = 'tp_knowledge_match_question';

    public static $questionType = [
        1 => '选择',
        2 => '问答',
    ];
}
?>
 