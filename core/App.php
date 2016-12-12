<?php

declare(strict_types=1);

namespace core;

require_once __DIR__ . '/../vendor/autoload.php';

use app\config\Router;
use app\config\Config;
use app\controller\ErrorController;
use app\controller\IndexController;
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
            $requestUri = $_SERVER['REQUEST_URI'];
            $request = explode('/', $requestUri);

            $router = new Router();
            $action = 'index';
            if (array_key_exists('1', $request) && !empty($request[1])) {
                $action = $request[1];
            }

            if (!$router->isAllowed('index', $action)) {
                $controller = new ErrorController($request);
                $controller->errorAction('404');
                return;
            }

            $controller = new IndexController($request);
            $controllerAction = $action . 'Action';
            $controller->$controllerAction();
        } catch (RequestException $exc) {
            $controller = new ErrorController($request);
            $controller->errorAction('40x');
            return;
        }
    }
}
