<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app.signup','Signup - {sitename}', ['sitename' => Yii::$app->name]);

?>
<div class="site-signup">
    <h1 class="mt-5"><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app.signup','Fill this form if you want to register:')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'verifyCode')->widget(\easedevs\yii2\turnstile\TurnstileInput::class, [
                    'size' => \easedevs\yii2\turnstile\TurnstileInput::SIZE_NORMAL,
                ]); ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app.signup','Sign up'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
