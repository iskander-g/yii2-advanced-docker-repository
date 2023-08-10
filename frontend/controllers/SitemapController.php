<?php

namespace frontend\controllers;

use common\models\Uslugi;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SitemapController extends Controller
{

    /**
     * Displays sitemap.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        header('Content-Type: application/xml');
        $host = Yii::$app->request->hostName;
        $time = date('Y-m-d', time() - 60*60*24) . 'T15:45:43+01:00';

        echo <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
	<loc>https://{$host}/</loc>
	<lastmod>{$time}</lastmod>
	<priority>1.0</priority>
</url>
</urlset>
XML;
        die();
    }
}
