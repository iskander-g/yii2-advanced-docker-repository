<?php

namespace common\helpers;

use App\Modules\PageManagement\Models\LinkedSite;
use Orhanerday\OpenAi\OpenAi;

class OpenaiHelper
{
    const OPENAI_KEY = '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';

    public static function complete($text, $try = 0): bool|string
    {
        $open_ai = new OpenAi(self::OPENAI_KEY);
        $complete = $open_ai->complete([
            'engine' => 'text-davinci-003',
            'prompt' => $text,
            'temperature' => 0.7,
            'max_tokens' => 1300,
            'best_of' => 1,
            'frequency_penalty' => 0.3,
            'presence_penalty' => 0.6,
        ]);

        $complete = json_decode($complete, true);
        $result = "";
        if(!isset($complete['choices'])) {
            if($try > 10) {
                return false;
            }
            sleep($try);
            return self::complete($text, $try+1);
        }
        if(sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if(!empty($result))
        {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }

    public static function completeCurie($text, $try =0): bool|string
    {
        $open_ai = new OpenAi(self::OPENAI_KEY);
        $complete = $open_ai->complete([
            'engine' => 'text-curie-001',
            'prompt' => $text,
            'temperature' => 0.7,
            'max_tokens' => 1300,
            'best_of' => 2,
            'frequency_penalty' => 0.1,
            'presence_penalty' => 0.4,
        ]);

        $complete = json_decode($complete, true);
        $result = "";
        if(!isset($complete['choices'])) {
            if($try > 10) {
                return false;
            }
            sleep($try);
            return self::completeCurie($text, $try+1);
        }
        if(sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if(!empty($result))
        {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }

    public static function completeBabbage($text, $try =0): bool|string
    {
        $open_ai = new OpenAi(self::OPENAI_KEY);
        $complete = $open_ai->complete([
            'engine' => 'text-babbage-001',
            'prompt' => $text,
            'temperature' => 0.7,
            'max_tokens' => 350,
            'best_of' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        $complete = json_decode($complete, true);
        $result = "";
        if(!isset($complete['choices'])) {
            if($try > 10) {
                return false;
            }
            sleep($try);
            return self::completeBabbage($text, $try+1);
        }
        if(sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if(!empty($result))
        {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }
}
