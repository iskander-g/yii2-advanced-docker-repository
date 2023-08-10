<?php
/**
 * Created by PhpStorm.
 * User: samilsalahiev
 * Date: 22.06.16
 * Time: 15:12
 */

namespace console\controllers;


use common\helpers\ArrayHelper;
use common\helpers\OpenaiHelper;
use common\models\Frequencies;
use common\models\Websites;
use common\models\WebsitesGoogleIndexHistory;
use common\models\WebsitesPingsHistory;
use common\models\WebsitesWhoisHistory;
use common\models\WebsitesYandexIndexHistory;
use common\models\YachtsDatabase;
use DeepL\TranslateTextOptions;
use Iodev\Whois\Factory;
use yii\console\Controller;
use yii\db\Exception;
use yii\db\Query;
use yii\helpers\VarDumper;

class TranslationsController extends Controller
{
    public function actionTranslateStrings()
    {
        ini_set('memory_limit', '-1');
        $target_languages = ['ru-RU'];
        foreach ($target_languages as $language) {
            $files = ArrayHelper::getFileNamesFromDir(__DIR__ . "/../../common/i18n/$language/", false);
            foreach ($files as $file) {
                if($language == 'ru-RU') {
                    $language = 'ru';
                }
                $strings = self::getStrings($file);
                $authKey = "123cc14f-c481-3624-461c-aa2538667d92"; // Replace with your key
                $translator = new \DeepL\Translator($authKey);
                foreach ($strings as $key => $value) {
                    if (empty($value)) {
                        echo  $key . PHP_EOL;
                        $key = preg_replace('/\{[A-Za-z0-9_]+\}/', '<xnone>$0</xnone>', $key);
                        $value = (string)$translator->translateText($key, 'en', $language, [
                            TranslateTextOptions::TAG_HANDLING => 'xml',
                            TranslateTextOptions::IGNORE_TAGS => 'xnone'
                        ]);
                        $value = str_replace(['<xnone>', '</xnone>'], ['', ''], $value);
                        $key = str_replace(['<xnone>', '</xnone>'], ['', ''], $key);
                        echo $value . PHP_EOL;
                        $strings[$key] = $value;
                    }
                }
                $array = VarDumper::export($strings);
                $content = <<<EOD
<?php
return $array;

EOD;

                if (file_put_contents($file, $content, LOCK_EX) === false) {
                    echo "can not save" . PHP_EOL;
                }
            }
        }
    }

    public static function getStrings($filename)
    {
        return require $filename;
    }

}