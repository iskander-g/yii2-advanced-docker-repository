<?php

namespace common\helpers;

class ArrayHelper
{
    public static function deleteEmptiesFromArray($ar)
    {
        foreach ($ar as $k => $v) {
            if (is_array($v)) {
                $ar[$k] = static::deleteEmptiesFromArray($v);
            } else {
                $ar[$k] = trim($ar[$k]);
            }

            if (empty($ar[$k]) || (is_array($v) && !sizeof($ar[$k])) || !isset($ar[$k])) {
                unset($ar[$k]);
            }
        }

        return $ar;
    }

    public static function getFileNamesFromDir($directory, $get_basename_only = true) {
        $result = [];
        foreach(glob($directory.'/*.*') as $file) {
            if($get_basename_only) {
                $result[basename($file)] = basename($file);
            } else {
                $result[basename($file)] = $file;
            }
        }

        return $result;
    }
}
