<?php
    namespace common\widgets;
    use yii\base\Model;
    
    class VoicesOfPoll extends Model{
    public $voice;
    public $type;
    
   public function attributeLabels()
    {
        return [
            'voice' => '',
            'type' => ''
            
        ];
    }
}

       

?>