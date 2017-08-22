<?php

namespace EnormousXml\Helper;

class MessageHelper
{
    public static function showMessageHelp()
    {
        $a = <<<HTML
This application parse xml by some criteria and then save result to tmp file.
Parameters which you can use for this app:

--path-to-file=/some/path/file.xml
age=20
email=jon-dou@gmail.com
etc.
HTML;
        print_r($a);
    }
}

