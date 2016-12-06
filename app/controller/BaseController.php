<?php

declare(strict_types=1);

namespace app\controller;

use Twig_Loader_Filesystem;
use Twig_Environment;

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
     * AbstractView constructor.
     *
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig = null)
    {
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
