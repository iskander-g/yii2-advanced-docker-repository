<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app.contact', 'Contact us - {sitename}', ['sitename' => Yii::$app->name]);
?>
<div class="site-contact">
    <h1 class="mt-5"><?=Yii::t('app.contact', 'Contact us')?></h1>
    <?php echo $this->render('_partial/_contact_form', ['contact_form' => $model]) ?>

</div>
