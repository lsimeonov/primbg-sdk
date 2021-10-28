<?php
declare(strict_types=1);

namespace Stellion\Primbg\Requests;

interface RequestInterface
{
    public function getPayload(): array;
}