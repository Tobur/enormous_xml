<?php

namespace EnormousXml\Helper;

class MessageHelper
{
    public static function showMessageHelp()
    {
        $a = <<<HTML
This application parse xml by some criteria and then save result to tmp file.
Parameters which you can use for this app:

--path-to-file=/some/path/file.xml :Specify your file path
age=20                             :Specify age which you need
id=123                             :specify id which you need
email=jon-dou@gmail.com            :Specify email which you need
name=Jon

HTML;
        print_r($a);
    }
}

