<?php

declare(strict_types=1);

namespace core\http;

use app\config\Config;
use core\exception\http\RequestException;

/**
 * Class Request
 *
 * @author Benny Van der Stee
 * @package core
 */
class Request
{
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
     *
     * @param Config $config
     * @throws RequestException
     */
    public function __construct(Config $config)
    {
        if (!in_array($this->getMethod(), $config->getAllowedMethods())) {
            throw new RequestException('Request method not allowed');
        }
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
