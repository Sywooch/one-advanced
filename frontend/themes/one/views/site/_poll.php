<?php
use yii\widgets\Pjax;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
//use common\models\AnswersPoll;
Pjax::begin(['id' => 'answer-poll', 'timeout' => 5000 ]);

if (isset($alertMessage) && $alertMessage != '') {
    echo $alertMessage;
}
if (empty($answerPoll)) {
    echo Html::beginForm(['/'], 'post', ['data-pjax' => '1', 'class' => '']);
    echo Html::radioList('answer_id', $answersData[0]->id, ArrayHelper::map($answersData, 'id', 'answer'), [
        'item' => function ($index, $label, $name, $checked, $value) {
            return  Html::tag('div',

                Html::tag('label',
                    Html::input('radio', $name, $value, ['class' => 'vote-players-radio', 'checked' => $checked]) .
                    Html::tag('div', false, ['class' => 'radio-appearance']) .

                    $label, ['class' => 'input-helper input-helper--radio']),
                ['class' => 'vote-players']
            );
        },
    ]);
    echo Html::input('hidden', 'question_id', $questions['id']);
    echo Html::submitButton('Голосовать', ['class' => 'btn btn-dark', 'name' => 'hash-button']);
    echo Html::endForm();
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
            <div class="poll-option-name"><?php echo $answersData[$i]->answer ?></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $voicesPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $voicesPer ?>%;">
                </div>
                <div class="progress-bar-result-count"><?php echo $answersData[$i]->how_many ?></div>
                <div class="progress-bar-result"><?php echo $voicesPer ?>%</div>
            </div>
        </div>
        <?php
    }
}
Pjax::end();