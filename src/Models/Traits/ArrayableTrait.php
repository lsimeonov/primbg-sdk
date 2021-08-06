<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Traits;

use Illuminate\Support\Str;
use ReflectionClass;
use Stellion\Primbg\Interfaces\Arrayable;

/**
 * Trait ArrayableTrait
 * @package Stellion\Primbg\Traits
 */
trait ArrayableTrait
{
    protected $excludedProperties = [
        'objectConvertMap',
        'excludedProperties',
        'castMap'
    ];

    /**
     * @return array
     */
    public function toArray(): array
    {
        $a = [];
        $r = new ReflectionClass($this);

        $props = $r->getProperties();

        foreach ($props as $prop) {
            if (in_array($prop->getName(), $this->excludedProperties)) {
                continue;
            }
            $name = Str::snake($prop->getName());
            $getter = 'get' . ucfirst($prop->getName());
            $value = $this->$getter();
            if (is_object($value) && $value instanceof Arrayable) {
                $a[$name] = $value->toArray();
            } else {
                $a[$name] = $value;
            }
        }

        return $a;
    }
}
