<?php

namespace HMVC;

use HMVC\Abstraction\Printable;

abstract class View implements Printable
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
