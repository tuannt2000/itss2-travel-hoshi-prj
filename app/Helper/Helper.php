<?php

namespace App\Helper;

class Helper
{
    public static function customNameAddress($name) {
        if (!is_null(self::nameExplode("Tỉnh ", $name))) {
            return self::nameExplode("Tỉnh ", $name);
        }

        if (!is_null(self::nameExplode("Thành phố ", $name))) {
            return self::nameExplode("Thành phố ", $name);
        }

        return $name;
    }

    public static function nameExplode($nameExplode, $name) {
        $sub_name = explode($nameExplode, $name);
        if (count($sub_name) > 1) {
            $name = $sub_name[1];
            return $name;
        }

        return null;
    }
}
