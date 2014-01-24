<?php

namespace HMVC\Abstraction;

class Identifiable 
{
    /**
     * Get the fully qualified name of the class. As of php 5.5 you can use static ::class property.
     *
     * @return string
     */
    public static function className()
    {
        if (version_compare(phpversion(), '5.5') === -1) {
            return get_called_class();
        }

        /** @noinspection PhpLanguageLevelInspection */

        return self::class;
    }
} 
