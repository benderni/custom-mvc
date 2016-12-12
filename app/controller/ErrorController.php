<?php

declare(strict_types=1);

namespace app\controller;
/**
 * Class IndexController
 *
 * @author Benny Van der Stee
 * @package app\controller
 */
class ErrorController extends BaseController
{
    /**
     * Error action
     *
     * @param string $type
     */
    public function errorAction(string $type)
    {
        $this->render('error' . DS . $type . '.html.twig');
    }
}
