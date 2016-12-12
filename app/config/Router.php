<?php

declare(strict_types=1);

namespace app\config;
/**
 * Class Router
 *
 * @author Benny Van der Stee
 * @package app\config
 */
class Router
{
    /**
     * A configuration array with all allowed routes in.
     *
     * @var array
     */
    private $routes = [
        'index' => ['index', 'about', 'contact'],
    ];

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Check if a route is allowed
     *
     * @param string $controller
     * @param string $action
     *
     * @return bool
     */
    public function isAllowed(string $controller, string $action)
    {
        return array_key_exists($controller, $this->getRoutes())
            && in_array($action, $this->getRoutes()[$controller]);
    }
}
