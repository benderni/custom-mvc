<?php

declare(strict_types=1);

namespace core;

require_once __DIR__ . '/../vendor/autoload.php';

use app\config\Router;
use app\config\Config;
use app\controller\ErrorController;
use app\controller\Factory as ControllerFactory;
use core\http\Request;
use core\exception\http\RequestException;

/**
 * Class App
 *
 * @author Benny Van der Stee
 * @package core
 */
class App
{
    /**
     * Run the framework
     */
    public static function run()
    {
        self::init();
        self::dispatch(self::config());
    }

    /**
     * Initialise the framework
     */
    private static function init()
    {
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT', getcwd() . DS);
        define('APP', ROOT . '../app' . DS);
        define('CORE', ROOT . '../core' . DS);
        define('CACHE', ROOT . '../var' . DS . 'cache' . DS);
        define('VIEW', APP . 'view' . DS);
        define('TEMPLATES', VIEW . 'templates' . DS);
    }

    /**
     * @return Config
     */
    private static function config()
    {
        return new Config();
    }

    /**
     * Dispatch the request
     *
     * @param Config $config
     */
    private static function dispatch(Config $config)
    {
        try {
            $request = new Request($config);

            $router = new Router();

            if (!$router->isAllowed($request->getControllerName(), $request->getControllerAction())) {
                $controller = new ErrorController($request);
                $controller->errorAction('404');
                return;
            }

            $controller = ControllerFactory::create($request);
            $controllerAction = $request->getControllerAction() . 'Action';
            $controller->$controllerAction();
        } catch (RequestException $exc) {
            $controller = new ErrorController($request);
            $controller->errorAction('40x');
            return;
        }
    }
}
