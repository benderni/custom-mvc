<?php

declare(strict_types=1);

namespace app\controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use core\http\Request;

/**
 * Class BaseController
 *
 * @author Benny Van der Stee
 * @package app\controller
 */
class BaseController
{
    /**
     * @var Twig_Environment
     */
    protected $twig;
    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractView constructor.
     *
     * @param Request $request
     * @param Twig_Environment $twig
     */
    public function __construct(Request $request, Twig_Environment $twig = null)
    {
        $this->setRequest($request);
        $this->setTwig($twig);

        if (null === $twig) {
            $loader = new Twig_Loader_Filesystem([VIEW, TEMPLATES]);
            $this->setTwig(new Twig_Environment($loader, [
                'cache' => CACHE,
            ]));
        }
    }

    /**
     * @return Twig_Environment
     */
    protected function getTwig(): Twig_Environment
    {
        return $this->twig;
    }

    /**
     * @param Twig_Environment $twig
     */
    protected function setTwig(Twig_Environment $twig = null)
    {
        $this->twig = $twig;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $file
     * @param array $params
     *
     * @todo catch twig errors
     * @return string
     */
    protected function render(string $file, array $params = [])
    {
        echo $this->getTwig()->render($file, $params);
    }
}
