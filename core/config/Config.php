<?php

declare(strict_types=1);

namespace core\config;
/**
 * Class Config
 *
 * @author Benny Van der Stee
 * @package core\config
 */
class Config
{
    /**
     * An array of all allowed REQUEST_METHODS
     *
     * @var array
     */
    protected static $allowedMethods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
    ];

    /**
     * Config constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getAllowedMethods(): array
    {
        return $this->allowedMethods;
    }
}
