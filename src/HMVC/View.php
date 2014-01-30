<?php

namespace HMVC;

use HMVC\Abstraction\AbstractIdentifiable;
use HMVC\Abstraction\Printable;
use HMVC\Collection\PluginCollection;

abstract class View extends AbstractIdentifiable implements Printable
{
    /**
     * @var PluginCollection
     */
    protected $plugins;

    /**
     * Default constructor
     */
    function __construct()
    {
        $this->plugins = new PluginCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Add a plugin for use by this view.
     *
     * @param View   $plugin
     * @param string $name
     *
     * @return $this
     */
    public function addPlugin(View $plugin, $name = '')
    {
        if (empty($name)) {
            $this->plugins->append($plugin);
        }
        else {
            $this->plugins->$name = $plugin;
        }

        return $this;
    }
}
