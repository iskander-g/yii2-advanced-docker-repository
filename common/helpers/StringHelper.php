<?php

namespace common\helpers;


use common\helpers\ArrayHelper;

class StringHelper
{

    // Shortens a number and attaches K, M, B, etc. accordingly
    public static function numberShorten($number, $precision = 2, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        $formatted = number_format($number / $divisor, $precision);
        $formatted_0 =  number_format($number / $divisor, 0);

        if(floatval($formatted) == floatval($formatted_0)) {
            $formatted = $formatted_0 . $shorthand;
        } else {
            $formatted = $formatted . $shorthand;
        }

        return $formatted;


    }

    public static function explodeByNewline($text, int $limit = PHP_INT_MAX)
    {
        $text = preg_replace('~\R~u', "\n", $text);
        $text = explode("\n", $text, $limit);
        $text = ArrayHelper::deleteEmptiesFromArray($text);
        return $text;
    }

    public static function crop($str, $size)
    {
        return mb_strimwidth(trim($str), 0, $size, "...");
    }

    public static function getLatinForUrl($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        if (is_callable('iconv')) {
            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicated - symbols
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        if (mb_strlen($text) > 40) {
            $text = substr($text, 0, 40);
            $text = trim($text, " -");
        }

        return $text;
    }

    public static function insertToStringAfterEveryOccurrences(string $string, $after = 5, $insert = '<br>'): string
    {
        $parts = explode(' ', $string);
        $result = '';
        foreach ($parts as $key => $part) {
            $result .= $part . ' ';
            if ($key % $after == ($after - 1))
                $result .= $insert;
        }
        return $result;
    }
}
