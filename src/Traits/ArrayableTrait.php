<?php
declare(strict_types=1);

namespace Stellion\Primbg\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Trait ArrayableTrait
 * @package Stellion\Primbg\Traits
 */
trait ArrayableTrait
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $a = [];
        $r = new ReflectionClass($this);

        $props = $r->getProperties();

        foreach ($props as $prop) {
            $name = Str::snake($prop->getName());
            $getter = 'get'.ucfirst($prop->getName());
            $a[$name] = $this->$getter();
        }

        return $a;
    }
}