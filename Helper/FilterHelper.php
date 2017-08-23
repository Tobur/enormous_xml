<?php

namespace EnormousXml\Helper;

use EnormousXml\Input\EnumInput;

class FilterHelper
{
    /**
     * @param array $filters
     * @param string $age
     * @return bool
     */
    public static function isAllowFilterPerAge(array $filters, $age)
    {
        return self::isAllowFilterValuePerKey($filters, EnumInput::AGE, $age);
    }

    /**
     * @param array $filters
     * @param string $name
     * @return bool
     */
    public static function isAllowFilterPerName(array $filters, $name)
    {
        return self::isAllowFilterValuePerKey($filters, EnumInput::NAME, $name);
    }

    /**
     * @param array $filters
     * @param string $email
     * @return bool
     */
    public static function isAllowFilterPerEmail(array $filters, $email)
    {
        return self::isAllowFilterValuePerKey($filters, EnumInput::EMAIL, $email);
    }

    /**
     * @param array $filters
     * @param string $id
     * @return bool
     */
    public static function isAllowFilterPerId(array $filters, $id)
    {
        return self::isAllowFilterValuePerKey($filters, EnumInput::ID, $id);
    }

    /**
     * @param array $filters
     * @param string $keyName
     * @param string $value
     * @return bool
     */
    public static function isAllowFilterValuePerKey(array $filters, $keyName, $value)
    {
        if (!array_key_exists($keyName, $filters)) {
            return true;
        }

        if (trim($value) === trim($filters[$keyName])) {
            return true;
        }

        return false;
    }
}

