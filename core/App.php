<?php

declare(strict_types=1);

namespace core;

require_once __DIR__ . '/../vendor/autoload.php';

use app\config\Routes;
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
//        $requestUri = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

        $controller = new IndexController();
        $controller->indexAction();

//        $route = new Routes();

//        print_r($requestUri);
    }
}
