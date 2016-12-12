<?php

declare(strict_types=1);

namespace app\config;

use core\config\Config as CoreConfig;

/**
 * Class Config
 *
 * @author Benny Van der Stee
 * @package app\config
 */
class Config extends CoreConfig
{
    /**
     * An array of all allowed REQUEST_METHODS
     * Currently only get methods are allowed
     *
     * @var array
     */
    protected static $allowedMethods = [
        'GET'
    ];
}
