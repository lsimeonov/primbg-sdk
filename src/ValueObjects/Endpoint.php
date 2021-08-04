<?php


namespace Stellion\Primbg\ValueObjects;

/**
 * Class Endpoint
 * @package Stellion\Primbg\ValueObjects
 */
class Endpoint
{
    /**
     * @var string
     */
    private $endpoint;

    public function __construct(string $endpoint)
    {
        $this->endpoint = rtrim($endpoint, '/');
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}