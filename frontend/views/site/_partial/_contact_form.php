<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
?>
<div class="card">
    <div class="card-body">
        <h2 class="fs-3"><?=Yii::t('app', 'Send message to us')?></h2>
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

        <?= $form->field($contact_form, 'name') ?>

        <?= $form->field($contact_form, 'phone') ?>

        <?= $form->field($contact_form, 'body')->textarea(['rows' => 3]) ?>

        <?= $form->field($contact_form, 'verifyCode')->widget(\easedevs\yii2\turnstile\TurnstileInput::class, [
            'size' => \easedevs\yii2\turnstile\TurnstileInput::SIZE_NORMAL,
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Send message'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>