<?php

/** @var yii\web\View $this
 * @var \frontend\models\ContactForm $contact_form
 * @var \common\models\Uslugi[] $uslugi
 */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app.index', '{sitename}', ['sitename' => Yii::$app->name]);
$this->registerMetaTag([
        'name' => 'description',
        'value' => Yii::t('app.index', 'Example demo website description')
]);
?>
<div class="site-index">
    <div class="container">
        <h1 class="fw-bold fs-1"><?=Yii::$app->name?></h1>
        <p class="fs-2 fw-bold"><?=Yii::t('app.index', 'Your website is working!')?></p>
    </div>
</div>
