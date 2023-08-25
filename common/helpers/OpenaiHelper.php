<?php

namespace common\helpers;

use Orhanerday\OpenAi\OpenAi;

class OpenaiHelper
{

    public static function getOpenAiKey()
    {
        $key = '';

        return $key;
    }

    public static function complete($text, $try = 0)
    {
        $open_ai = new OpenAi(self::getOpenAiKey());
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
        var_dump($text, $complete);
        $result = "";
        if (!isset($complete['choices'])) {
            if ($try > 10) {
                return false;
            }
            sleep($try);
            return self::complete($text, $try + 1);
        }
        if (sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if (!empty($result)) {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }

    public static function completeCurie($text, $try = 0)
    {
        $open_ai = new OpenAi(self::getOpenAiKey());
        $complete = $open_ai->complete([
            'engine' => 'text-curie-001',
            'prompt' => $text,
            'temperature' => 0.7,
            'max_tokens' => 1000,
            'best_of' => 2,
            'frequency_penalty' => 0.1,
            'presence_penalty' => 0.4,
        ]);

        $complete = json_decode($complete, true);
        $result = "";
        if (!isset($complete['choices'])) {
            if ($try > 10) {
                return false;
            }
            sleep($try);
            return self::completeCurie($text, $try + 1);
        }
        if (sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if (!empty($result)) {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }


    }

    public static function completeChatGPT($messages, $try = 0)
    {
        $open_ai = new OpenAi(self::getOpenAiKey());
        $complete = $open_ai->chat([
            'model' => 'gpt-3.5-turbo-16k',
            'messages' => $messages,
            'temperature' => 0.8,
            'max_tokens' => 5000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);


        $complete = json_decode($complete, true);

        $result = "";
        if (!isset($complete['choices'])) {
            if ($try > 5) {
                return false;
            }
            usleep($try * 100);
            return self::completeChatGPT($messages, $try + 1);
        }

        if (sizeof($complete['choices']) && isset($complete['choices'][0]['message']['content'])) {
            $result = $complete['choices'][0]['message']['content'];
        }
        if (!empty($result)) {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }

    public static function completeChatGPT4($text, $try = 0)
    {
        $open_ai = new OpenAi(self::getOpenAiKey());
        $complete = $open_ai->chat([
            'model' => 'gpt-4',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "ТЫ - популярный детский писатель, который пишет замечательные детские книги и рассазы для детей"
                ],
                [
                    "role" => "user",
                    "content" => $text
                ],
            ],
            'temperature' => 0.8,
            'max_tokens' => 2000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        $complete = json_decode($complete, true);
        $result = "";
        if (!isset($complete['choices'])) {
            if ($try > 5) {
                return false;
            }
            usleep($try * 100);
            return self::completeChatGPT4($text, $try + 1);
        }

        if (sizeof($complete['choices']) && isset($complete['choices'][0]['message']['content'])) {
            $result = $complete['choices'][0]['message']['content'];
        }
        if (!empty($result)) {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }

    public static function completeBabbage($text, $try = 0)
    {
        $open_ai = new OpenAi(self::getOpenAiKey());
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
        if (!isset($complete['choices'])) {
            if ($try > 10) {
                return false;
            }
            sleep($try);
            return self::completeBabbage($text, $try + 1);
        }
        if (sizeof($complete['choices']) && isset($complete['choices'][0]['text'])) {
            $result = $complete['choices'][0]['text'];
        }
        if (!empty($result)) {
            $result = trim($result);
            return $result;
        } else {
            return false;
        }

    }
}
