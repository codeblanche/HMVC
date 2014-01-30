<?php

namespace HMVC\Abstraction;

interface Identifiable
{
    /**
     * Get the fully qualified name of the class. As of php 5.5 you can use static ::class property.
     *
     * @return string
     */
    public static function className();
}
