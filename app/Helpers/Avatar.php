<?php

namespace App\Helpers;

class Avatar {

    public static function getAvatar($name) {

        return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $name);

    }

}
