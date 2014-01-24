<?php

namespace HMVC\Collection;

use ArrayIterator;

class PluginCollection extends ArrayIterator
{
    public function __construct($array = array(), $flags = 1)
    {
        parent::__construct($array, $flags);
    }
}
