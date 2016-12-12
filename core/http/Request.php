<?php

declare(strict_types=1);

namespace core\http;

use Exception;

/**
 * Class Request
 *
 * @author Benny Van der Stee
 * @package core
 */
class Request
{
    /**
     * A list of allowed REQUEST_METHODS
     * Currently only get methods are allowed
     *
     * @var array
     */
    protected $allowedMethods = [
        'GET'
    ];
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $uri;
    /**
     * @var string
     */
    protected $query;
    /**
     * @var string
     */
    protected $pathInfo;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        if (!in_array($this->getMethod(), $this->getAllowedMethods())) {
            throw new Exception('Request method not allowed');
        }
    }

    /**
     * @return array
     */
    public function getAllowedMethods(): array
    {
        return $this->allowedMethods;
    }

    /**
     * @param array $allowedMethods
     */
    public function setAllowedMethods(array $allowedMethods)
    {
        $this->allowedMethods = $allowedMethods;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        if (null === $this->method) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        }

        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        if (null === $this->uri) {
            $this->uri = $_SERVER['REQUEST_URI'];
        }

        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        if (null === $this->query) {
            $this->query = $_SERVER['QUERY_STRING'];
        }

        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getPathInfo(): string
    {
        if (null === $this->pathInfo) {
            $this->pathInfo = $_SERVER['PATH_INFO'];
        }
        return $this->pathInfo;
    }

    /**
     * @param string $pathInfo
     */
    public function setPathInfo(string $pathInfo)
    {
        $this->pathInfo = $pathInfo;
    }
}
