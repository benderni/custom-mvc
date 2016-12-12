<?php

declare(strict_types=1);

namespace core;

require_once __DIR__ . '/../vendor/autoload.php';

use app\config\Router;
use app\controller\ErrorController;
use app\controller\IndexController;

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
        self::config();
        self::dispatch();
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
     * Config
     */
    private static function config()
    {

    }

    /**
     * Dispatch the request
     */
    private static function dispatch()
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $request = explode('/', $requestUri);

            $router = new Router();
            $action = 'index';
            if (array_key_exists('1', $request) && !empty($request[1])) {
                $action = $request[1];
            }

            if (!$router->isAllowed('index', $action)) {
                $controller = new ErrorController();
                $controller->errorAction('40X');
                return;
            }

            $controller = new IndexController();
            $controllerAction = $action . 'Action';
            $controller->$controllerAction();
        } catch (\Exception $exc) {
            $controller = new ErrorController();
            $controller->errorAction('50X');
            return;
        }
    }
}
