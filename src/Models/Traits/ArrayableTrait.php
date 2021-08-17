<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Traits;

use Illuminate\Support\Str;
use ReflectionClass;
use Stellion\Primbg\Interfaces\AllowNullIdInterface;
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
            if (is_object($value)) {
                if ($value instanceof Arrayable) {
                    // Remove if no id is set we skip it.
                    if(!$value instanceof AllowNullIdInterface && method_exists($value, 'getId')){
                        if(!$value->getId()){
                            continue;
                        }
                    }
                    $a[$name] = $value->toArray();
                } elseif (method_exists($value, '__toString')) {
                    $a[$name] = $value->__toString();
                }
            } elseif (is_array($value)) {
                $a[$name] = array_map(function ($v) {
                    if ($v instanceof Arrayable) {
                        return $v->toArray();
                    }
                    return $v;
                }, $value);

            } else {
                $a[$name] = $value;
            }

        }

        return $a;
    }
}
