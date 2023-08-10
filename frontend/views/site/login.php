<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app.login','Log in');

?>
<div class="site-login">
    <h1 class="mt-5"><?= Html::encode($this->title) ?></h1>

    <p> <?=Yii::t('app.login', 'Please log in, or <a href="{url}">sign up</a>, if you don\'t have account yet:', ['url' => \yii\helpers\Url::to(['/site/signup'])]);?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <?= $form->field($model, 'verifyCode')->widget(\easedevs\yii2\turnstile\TurnstileInput::class, [
                    'size' => \easedevs\yii2\turnstile\TurnstileInput::SIZE_NORMAL,
                ]); ?>


                <div class="my-2 mx-0" style="color:#999;">
                    <?=Yii::t('app.login', 'If you forgot your password, you can')?> <?= Html::a(Yii::t('app','reset it'), ['site/request-password-reset']) ?>.
                    <br>
                    <?=Yii::t('app.login', 'Are you missed you verification e-mail?')?> <?= Html::a(Yii::t('app','Send it again'), ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app.login','Log in'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
