<?php
use yii\widgets\Pjax;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
//use common\models\AnswersPoll;

if (empty($answerPoll)) {
    Pjax::begin();
    echo Html::beginForm(['/site/vote'], 'post', ['data-pjax' => '1', 'class' => '']);
    echo Html::radioList('answer_id', 1, ArrayHelper::map($answersData, 'id', 'answer'), [
        'item' => function ($index, $label, $name, $checked, $value) {
            return Html::tag('div', Html::radio($name, $checked, [
                'value' => $value,
                'label' => Html::encode($label),
            ]),
                ['class' => 'radio']
            );
        },
    ]);
    echo Html::input('hidden', 'question_id', $questions['id']);
    echo Html::submitButton('Голосовать', ['class' => 'btn btn-sm btn-primary', 'name' => 'hash-button']);
    echo Html::endForm();
    Pjax::end();
} else {
    $sumOfVoices = 0;
    foreach($answersData as $item) {
            $sumOfVoices = $sumOfVoices + $item->how_many;
    }
    for($i = 0; $i<count($answersData); $i++) {
        $voicesPer = 0;
        if($sumOfVoices ==0) {
            $voicesPer = 0;
        } else {
            $voicesPer = round($answersData[$i]->how_many/$sumOfVoices, 4)*100;
        }
        ?>
        <div class="poll-option-block">
            <div class="poll-option-name"><?php echo $answersData[$i]->answer . ': ' . $answersData[$i]->how_many ?></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $voicesPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $voicesPer ?>%;">
                    <?php echo $voicesPer ?>%
                </div>
            </div>
        </div>
        <?php
    }
}