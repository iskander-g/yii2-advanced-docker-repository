<?php

namespace frontend\models;

use easedevs\yii2\turnstile\TurnstileInputValidator;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $phone;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone', 'body'], 'required'],
            // verifyCode needs to be entered correctly
            ['verifyCode', TurnstileInputValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app','Your name'),
            'phone' => Yii::t('app','Your phone number'),
            'body' => Yii::t('app', 'Your message'),
            'verifyCode' => Yii::t('app', 'Verification code'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['senderEmail'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject(Yii::t('app','New contact form request'))
            ->setTextBody($this->body)
            ->send();
    }
}
