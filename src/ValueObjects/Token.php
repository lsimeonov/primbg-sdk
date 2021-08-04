<?php


namespace Stellion\Primbg\ValueObjects;

/**
 * Class Token
 * @package Stellion\Primbg\ValueObjects
 */
class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * Token constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}