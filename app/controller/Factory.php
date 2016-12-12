<?php

declare(strict_types=1);

namespace app\controller;

use core\http\Request;

/**
 * Class Factory
 *
 * @author Benny Van der Stee
 * @package app\controller
 */
class Factory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function create(Request $request)
    {
        $controller = __NAMESPACE__ . '\\' . ucfirst($request->getControllerName()) . 'Controller';

        return new $controller($request);
    }
}
