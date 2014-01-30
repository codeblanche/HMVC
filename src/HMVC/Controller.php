<?php

namespace HMVC;

use HMVC\Abstraction\AbstractIdentifiable;
use HMVC\Collection\PluginCollection;
use Web\Request\Request;
use Web\Response\Response;
use Web\Route\Router;
use Web\Web;

abstract class Controller extends AbstractIdentifiable
{
    /**
     * @var Web
     */
    protected $web;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var PluginCollection
     */
    protected $plugins;

    /**
     * @var bool
     */
    private $running = false;

    /**
     * @var array
     */
    private $params = array();

    /**
     * @param \Web\Web $web
     * @param Model    $model
     * @param View     $view
     */
    function __construct(Web $web, Model $model, View $view)
    {
        $this->web      = $web;
        $this->request  = $web->getRequest();
        $this->response = $web->getResponse();
        $this->router   = $web->getRouter();
        $this->model    = $model;
        $this->view     = $view;
        $this->plugins  = new PluginCollection();
    }

    /**
     * Run the controller
     *
     * @param array $params
     *
     * @return View|string
     */
    final public function run($params = array())
    {
        $this->running = true;
        $this->params  = $params;

        /** @var $plugin Controller */
        foreach ($this->plugins as $name => $plugin) {
            $this->view->addPlugin($plugin->run($params), $name);
        }

        return $this->execute($params);
    }

    /**
     * Execute the controller
     *
     * @param array $params
     *
     * @return View|string
     */
    abstract protected function execute($params);

    /**
     * Add a plugin for use by this controller.
     *
     * @param Controller $plugin
     * @param string     $name
     *
     * @return $this
     */
    protected function registerPlugin(Controller $plugin, $name = '')
    {
        if (empty($name)) {
            $this->plugins->append($plugin);
        }
        else {
            $this->plugins->$name = $plugin;
        }

        /*
         * Allow late registration of plugins
         */
        
        if ($this->running) {
            $this->view->addPlugin($plugin->run($this->params), $name);
        }

        return $this;
    }
}
