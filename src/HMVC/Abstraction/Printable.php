<?php

namespace HMVC\Abstraction;

interface Printable 
{
    /**
     * @return string
     */
    public function toString();

    /**
     * @return string
     */
    public function __toString();
} 
