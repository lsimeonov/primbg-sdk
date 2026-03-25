<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Traits;


use Illuminate\Support\Str;
use Stellion\Primbg\Interfaces\AllowNullIdInterface;

trait FromArrayTrait
{
    /**
     * @param array $array
     */
    protected function fromArray(array $array = [])
    {
        foreach ($array as $k => $v) {
            $setter = 'set' . ucfirst(Str::camel($k));
            if ($v === '__NULL__') {
                $v = null;
            }
            if (method_exists($this, $setter)) {
                $value = $v;
                if (isset($this->objectConvertMap[$k])) {
                    // Value is array of objects to be converted
                    if (is_array($value) && $this->isArrayOfObjects($value)) {
                        $value = array_filter(array_map(function ($item) use ($k) {
                            $newObject = new $this->objectConvertMap[$k]($item);
                            if (method_exists($newObject, 'getId')) {
                                if (!$newObject->getId()) {
                                    return null;
                                }
                            }
                            return $newObject;
                        }, $value));
                        // Value is array of objects with scalar values and this is allowed
                    } elseif (isset($this->allowFlatArray) && in_array($k, $this->allowFlatArray) && is_array($value)) {
                        $value = array_map(function ($item) use ($k) {
                            return new $this->objectConvertMap[$k]($item);
                        }, $value);
                        // Value is a single object
                    } else {
                        $value = new $this->objectConvertMap[$k]($v ?? []);
                        if (!$value instanceof AllowNullIdInterface && method_exists($value, 'getId')) {
                            if (!$value->getId()) {
                                continue;
                            }
                        }
                    }
                }
                if (isset($this->castMap[$k])) {
                    settype($value, $this->castMap[$k]);
                }

                $value = $this->normalizeSetterValue($setter, $value);
                $this->$setter($value);
            }
        }
    }

    /**
     * Normalize scalar API payload values based on setter type-hint.
     *
     * Prim API may return numeric identifiers as strings ("123"), while
     * many model setters are strictly typed as int/?int.
     *
     * @param string $setter
     * @param mixed $value
     * @return mixed
     */
    private function normalizeSetterValue(string $setter, $value)
    {
        try {
            $method = new \ReflectionMethod($this, $setter);
        } catch (\ReflectionException $e) {
            return $value;
        }

        $parameters = $method->getParameters();
        if (count($parameters) !== 1) {
            return $value;
        }

        $type = $parameters[0]->getType();
        if (!$type instanceof \ReflectionNamedType) {
            return $value;
        }

        if ($type->getName() !== 'int' || !is_string($value)) {
            return $value;
        }

        $trimmed = trim($value);
        if ($trimmed === '' && $type->allowsNull()) {
            return null;
        }

        if (preg_match('/^-?\d+$/', $trimmed) === 1) {
            return (int) $trimmed;
        }

        return $value;
    }

    private function isArrayOfObjects(array $arr): bool
    {
        if (count($arr) == 0) {
            return false;
        }

        foreach ($arr as $item) {
            if (!is_array($item)) {
                return false;
            }
        }
        return true;
    }
}
