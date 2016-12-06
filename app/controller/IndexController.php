<?php

declare(strict_types=1);

namespace app\controller;
/**
 * Class IndexController
 *
 * @author Benny Van der Stee
 * @package app\controller
 */
class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->render('index.html.twig');
    }
}
